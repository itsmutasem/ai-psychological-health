<?php

use App\Http\Controllers\AnalysisController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AnalysisController::class, 'index']);
Route::post('/analysis', [AnalysisController::class, 'analysis']);
