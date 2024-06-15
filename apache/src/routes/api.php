<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MusicController;
use App\Http\Controllers\Api\UserController;

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

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::group(['prefix' => 'musics'], function () {

        // Music index route
        Route::get('/', [MusicController::class, 'index'])->name('api.musics.index');
    
        // Music search route
        Route::get('/search', [MusicController::class, 'search'])->name('api.musics.search');
    
        // Music show route
        Route::get('/{id}', [MusicController::class, 'show'])->name('api.musics.show');
    
        // Music store route
        Route::post('/', [MusicController::class, 'store'])->name('api.musics.store');
    
        // Music update route
        Route::put('/{id}', [MusicController::class, 'update'])->name('api.musics.update');
    
        // Music delete route
        Route::delete('/{id}', [MusicController::class, 'destroy'])->name('api.musics.destroy');
        
    });

    Route::get('/api-endpoints', [MusicController::class, 'listApiEndpoints']); // Add this line
    // User routes
    Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('api.users.show');
    Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('api.users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');
