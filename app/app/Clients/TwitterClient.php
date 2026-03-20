<?php

namespace App\Clients;

use Illuminate\Support\Facades\Http;

class TwitterClient
{
    protected string $baseUrl = 'https://api.twitter.com/2';

    public function fetchTweets(string $username): array
    {
        // 1. get the user id
        $userResponse = Http::withToken(config('services.twitter.token'))
            ->withoutVerifying()
            ->get("{$this->baseUrl}/users/by/username/{$username}");

        if (!$userResponse->successful()) {
            return [];
        }

        $userId = $userResponse->json()['data']['id'];

        // 2. get tweets
        $tweetsResponse = Http::withToken(config('services.twitter.token'))
            ->withoutVerifying()
            ->get("{$this->baseUrl}/users/{$userId}/tweets", [
                'max_results' => 10,
            ]);

        if (!$tweetsResponse->successful()) {
            return [];
        }

        return collect($tweetsResponse->json('data', []))
            ->pluck('text')
            ->toArray();
    }
}
