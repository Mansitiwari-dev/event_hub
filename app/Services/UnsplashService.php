<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UnsplashService
{
    protected $accessKey;
    protected $baseUrl = 'https://api.unsplash.com';

    public function __construct()
    {
        $this->accessKey = config('services.unsplash.access_key');
    }

    public function searchPhotos($query, $perPage = 10, $page = 1)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Client-ID ' . $this->accessKey,
            'Accept-Version' => 'v1',
        ])->get("$this->baseUrl/search/photos", [
            'query' => $query,
            'per_page' => $perPage,
            'page' => $page,
        ]);

        return $response->json();
    }

    public function getRandomPhoto($query = 'event')
    {
        $response = Http::withHeaders([
            'Authorization' => 'Client-ID ' . $this->accessKey,
            'Accept-Version' => 'v1',
        ])->get("$this->baseUrl/photos/random", [
            'query' => $query,
            'orientation' => 'landscape',
        ]);

        return $response->json();
    }
}
