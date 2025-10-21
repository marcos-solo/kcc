<?php


use App\Http\Controllers\DonationController;

Route::post('/mpesa/callback', [DonationController::class, 'callback']);
