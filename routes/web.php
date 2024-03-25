<?php

use App\Models\Url;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('documentacion');
});
 
$url_cortas=Url::all();
foreach($url_cortas as $url){
    Route::redirect($url->url_llave,$url->url_destino,301);
}