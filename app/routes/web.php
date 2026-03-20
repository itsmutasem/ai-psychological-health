<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;
use App\Clients\TwitterClient;

Route::get('/', [AnalysisController::class, 'index']);
Route::post('/analysis', [AnalysisController::class, 'analysis']);

Route::get('/test-http', function () {
    $response = Http::get('https://jsonplaceholder.typicode.com/posts/1');
    dd($response->json());
});

Route::get('/test-twitter', function (TwitterClient $twitter) {
    dd($twitter->fetchTweets('elonmusk'));
});
