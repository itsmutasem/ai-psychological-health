<?php

namespace App\Http\Controllers;

use App\Clients\TwitterClient;
use App\Http\Requests\AnalysisRequest;
use App\Services\AIService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AnalysisController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function analysis(AnalysisRequest $request, TwitterClient $twitter)
    {
        $request->validated();

        // 1. Fetch tweets using your TwitterClient
        $tweets = $twitter->fetchTweets($request->username);

        if (empty($tweets)) {
            return back()->with('error', 'Unable to fetch tweets for this user.');
        }

        // 2. Send tweets to Python FastAPI for predictions
        $response = Http::post('http://127.0.0.1:8001/predict', [
            'tweets' => $tweets
        ]);

        if (!$response->successful()) {
            return back()->with('error', 'Prediction service is not responding.');
        }

        $results = $response->json(); // Contains all the health metrics

        // 3. Pass results to the view
        return view('analysis', compact('tweets', 'results'));
    }
}
