<?php

namespace App\Support;

class HtmlSanitizer
{
    /**
     * Lightweight HTML sanitizer for editor content.
     *
     * This is not as strong as a dedicated purifier library, but it prevents the most common XSS
     * by stripping dangerous tags and event-handler attributes.
     */
    public static function basic(?string $html): ?string
    {
        if ($html === null) {
            return null;
        }

        $html = trim($html);
        if ($html === '') {
            return null;
        }

        // Allow a small set of formatting tags typical for Summernote output.
        $allowed = '<p><br><b><strong><i><em><u><s><strike><ul><ol><li><blockquote><h1><h2><h3><h4><h5><h6><pre><code><span><div><a>';
        $clean = strip_tags($html, $allowed);

        // Remove script/style tags remnants (in case they slipped through).
        $clean = preg_replace('#</?(script|style)[^>]*>#i', '', $clean) ?? $clean;

        // Drop inline event handlers (onclick, onerror, ...).
        $clean = preg_replace('/\\son\\w+\\s*=\\s*(\"[^\"]*\"|\\\'[^\\\']*\\\'|[^\\s>]+)/i', '', $clean) ?? $clean;

        // Block javascript: URLs in href.
        $clean = preg_replace('/\\shref\\s*=\\s*(\"|\\\')\\s*javascript:[^\"\\\']*(\\1)/i', ' href="#"', $clean) ?? $clean;

        return trim($clean) !== '' ? $clean : null;
    }
}

