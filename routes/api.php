<?php

use \App\Http\Controllers\CustomerController;

Route::get('/customers', [CustomerController::class, 'getCustomersApi']);