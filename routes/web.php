<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeliveryController;

Route::resource('deliveries', DeliveryController::class)->except('show');
