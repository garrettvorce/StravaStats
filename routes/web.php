<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Helpers\Utility;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

Auth::routes();

Route::get('/', function () {
    return Redirect::to('https://www.strava.com/oauth/authorize?client_id=23924&redirect_uri=http://stravastats.test/authorize&response_type=code&scope=public');
    return Redirect::to(env('STRAVA_AUTHORIZATION_URL') . 'client_id=' . env('STRAVA_CLIENT_ID') . env('STRAVA_REDIRECT_URI') . env('STRAVA_RESPONSE_TYPE') . env('STRAVA_SCOPE'));
});

Route::get('/authorize', function (Request $request) {
    $request = $request->only([
        'code',
        'state',
    ]);

    $client = new Client;

    $response = $client->post('https://www.strava.com/oauth/token?client_id=23924&client_secret=b6965e1165401a9ecd2ebf2a4230effd22929e21&code=' . $request['code']);

    return Utility::toArray($response);
});
