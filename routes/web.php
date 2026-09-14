<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/books');
Route::apiResource('books', BookController::class)->except(['show']);
