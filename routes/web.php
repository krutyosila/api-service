<?php

use Illuminate\Support\Facades\Route;


Route::get('/', ['uses' => 'HomeController@index']);
Route::get('/redirect', function (Request $request) {
    request()->session()->put('state', $state = Str::random(40));

    $query = http_build_query([
        'client_id' => 'client-id',
        'redirect_uri' => 'http://localhost:8000/',
        'response_type' => 'code',
        'scope' => '',
        'state' => $state,
    ]);

    return redirect('http://localhost:8000/oauth/authorize?'.$query);
});
