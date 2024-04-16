<?php

use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\JsonController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});
//route for github login and authentication
Route::get('github/login', [GithubAuthController::class, 'redirectToGithubLogin'])->name('github.login');
Route::get('/login/github/callback', [GithubAuthController::class, 'handleGithubCallback']);


Route::get('/dashboard', function () {
    $jsonFiles = auth()->user()->jsonFiles;
    return view('dashboard',compact('jsonFiles'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // route for json file upload and export
    Route::post('upload', [JsonController::class, 'uploadJsonFile'])->name('upload.json_file');
    Route::get('export-json-to-excel', [JsonController::class, 'exportJsonFileToExcel'])->name('export.to.excel');

    // these are the default route by staterkit
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
