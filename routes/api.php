<?php

use App\Http\Controllers\Api\QuoteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Quote API Routes
Route::apiResource('quotes', QuoteController::class);

/*
This creates these endpoints automatically:
- GET    /api/quotes           → QuoteController@index    (get all quotes)
- POST   /api/quotes           → QuoteController@store    (create new quote)
- GET    /api/quotes/{id}      → QuoteController@show     (get single quote)
- PUT    /api/quotes/{id}      → QuoteController@update   (update quote)
- DELETE /api/quotes/{id}      → QuoteController@destroy  (delete quote)
*/
