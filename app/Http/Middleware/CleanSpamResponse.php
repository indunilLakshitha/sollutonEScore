<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CleanSpamResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if this is a JSON/Livewire/API response
        $contentType = $response->headers->get('Content-Type', '');
        $isLivewire = $request->header('X-Livewire') !== null ||
                      $request->header('X-Livewire-Version') !== null ||
                      $request->header('X-Requested-With') === 'XMLHttpRequest' ||
                      str_contains($request->path(), 'livewire/') ||
                      str_contains($request->url(), '/livewire/');

        $isJsonResponse = str_contains($contentType, 'application/json') ||
                         $request->wantsJson() ||
                         str_contains($request->path(), 'api/');

        // Always check ALL string responses for spam (spam affects everything)
        $content = $response->getContent();

        if (is_string($content)) {
            // Check for specific spam HTML injection patterns
            $hasSpecificSpam = str_contains($content, '<div style="display:none">') ||
                              str_contains($content, 'slot gacor');

            // Check for spam injected into JSON responses (only for JSON/Livewire responses)
            $hasJsonSpam = false;
            if ($isJsonResponse || $isLivewire) {
                // Only check for JSON spam if this is supposed to be a JSON response
                // Check if content starts with HTML but should be JSON
                $hasJsonSpam = str_contains($content, '{"') &&
                              str_contains($content, '<') &&
                              !str_starts_with(trim($content), '{') &&
                              str_starts_with(trim($content), '<');
            }

            $hasSpam = $hasSpecificSpam || $hasJsonSpam;

            if ($hasSpam) {
                Log::info('CleanSpamResponse: Detected spam in response', [
                    'path' => $request->path(),
                    'isLivewire' => $isLivewire,
                    'isJson' => $isJsonResponse,
                    'contentLength' => strlen($content),
                    'contentPreview' => substr($content, 0, 200),
                    'hasSpecificSpam' => $hasSpecificSpam,
                    'hasJsonSpam' => $hasJsonSpam
                ]);

                // Remove all HTML spam patterns
                $originalLength = strlen($content);
                $content = preg_replace('/<div[^>]*style="display:none"[^>]*>.*?<\/div>\s*/is', '', $content);
                $content = preg_replace('/<a[^>]*>slot gacor<\/a>\s*/i', '', $content);
                $content = preg_replace('/<div[^>]*>.*?slot gacor.*?<\/div>\s*/is', '', $content);

                // If content should be JSON but contains HTML, extract JSON
                if (($isJsonResponse || $isLivewire) && str_contains($content, '{"')) {
                    // Try to parse as-is first
                    $decoded = json_decode($content, true);

                    if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
                        // JSON parsing failed, extract JSON from string
                        $jsonStart = strpos($content, '{"');
                        if ($jsonStart !== false) {
                            // Find the complete JSON object
                            $jsonString = $this->extractJsonFromString($content, $jsonStart);
                            if ($jsonString) {
                                $content = $jsonString;
                                Log::info('CleanSpamResponse: Extracted JSON', [
                                    'originalLength' => $originalLength,
                                    'newLength' => strlen($content)
                                ]);
                            }
                        }
                    } else {
                        Log::info('CleanSpamResponse: JSON parsed successfully after cleaning');
                    }
                }

                $response->setContent($content);
            }
        }

        return $response;
    }

    /**
     * Extract complete JSON object from string that may contain HTML
     */
    private function extractJsonFromString(string $content, int $startIndex): ?string
    {
        $braceCount = 0;
        $inString = false;
        $escapeNext = false;

        for ($i = $startIndex; $i < strlen($content); $i++) {
            $char = $content[$i];

            if ($escapeNext) {
                $escapeNext = false;
                continue;
            }

            if ($char === '\\') {
                $escapeNext = true;
                continue;
            }

            if ($char === '"') {
                $inString = !$inString;
                continue;
            }

            if (!$inString) {
                if ($char === '{') {
                    $braceCount++;
                } elseif ($char === '}') {
                    $braceCount--;
                    if ($braceCount === 0) {
                        return substr($content, $startIndex, $i - $startIndex + 1);
                    }
                }
            }
        }

        return null;
    }
}
