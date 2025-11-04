<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index()
    {
        $url = "https://imdb.iamidiotareyoutoo.com/search?tt=tt2250912";

        $response = Http::get($url);
        $raw = $response->json();

        // Normalize payload to what the view expects
        $movie = [
            'title' => data_get($raw, 'short.name', 'N/A'),
            'description' => data_get($raw, 'short.description', 'N/A'),
            'image' => data_get($raw, 'short.image', 'N/A'),
            'author' => data_get($raw, 'short.review.author.name', 'N/A'),
            // Leaving cast empty for now; adapt mapping if API provides a clear path
            'cast' => [],
        ];

        return view('movie', ['movie' => $movie]);
    }
}




