<?php

use App\Models\Registrosfuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::get('paginate', function () {
    return Registrosfuid::query()->paginate();
});
