<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait DiscordMsgTrait
{
    use SMSTrait;

    public function sendDiscordMsg(string $msg)
    {
        $url = env('DISCORD_WEBHOOK_URL');


        Http::post($url, [
            'content' => $msg,
        ]);
    }
}
