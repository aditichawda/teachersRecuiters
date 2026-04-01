<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobApplyController;

Route::post('/apply-job', [JobApplyController::class, 'applyJob']);