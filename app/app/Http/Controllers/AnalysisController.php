<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalysisRequest;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function analysis(AnalysisRequest $request)
    {
        $request->validated();
        return view('analysis', compact('request'));
    }
}
