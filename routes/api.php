<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\Contacts;

Route::resource('contacts', Contacts::class)->only(['index', 'show', 'store', 'update']);