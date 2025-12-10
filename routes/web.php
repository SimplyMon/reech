<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\CampaignController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('Dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('clients', ClientController::class);

    Route::resource('templates', EmailTemplateController::class);
    Route::post('templates/{template}/send', [EmailTemplateController::class, 'send'])->name('templates.send');

    Route::resource('campaigns', CampaignController::class);
});

require __DIR__ . '/auth.php';
