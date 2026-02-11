<?php

namespace App\Http\Controllers;

use App\Services\UnsplashService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $unsplash;

    public function __construct(UnsplashService $unsplash)
    {
        $this->unsplash = $unsplash;
    }

    public function search(Request $request)
    {
        $query = $request->input('query', 'event');
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $results = $this->unsplash->searchPhotos($query, $perPage, $page);
        
        return response()->json($results);
    }

    public function random(Request $request)
    {
        $query = $request->input('query', 'event');
        $photo = $this->unsplash->getRandomPhoto($query);
        
        return response()->json($photo);
    }
}
