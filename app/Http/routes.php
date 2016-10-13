<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function(){
    if (Auth::guest()) return Redirect::guest('/auth/login');
    return redirect('/admin/evidencijaposlova');
});



get('admin', function(){
    return redirect('/admin/evidencijaposlova');
});

$router->group([
    'namespace' => 'Admin',
    'middleware' => 'auth',
        ], function() {
    resource('admin/evidencijaposlova', 'EvidencijaPoslovaController');
    resource('admin/materijal', 'MaterijalController', ['except' => 'show']);
    // stavkeposla
    Route::get('admin/stavkeposla/show/{id}', 'StavkePoslaController@show');
    Route::post('admin/stavkeposla/store/{id}', 'StavkePoslaController@store');
    Route::get('admin/stavkeposla/edit/{id}', 'StavkePoslaController@edit');
    Route::put('admin/stavkeposla/update/{id}', 'StavkePoslaController@update');
    Route::delete('admin/stavkeposla/destroy/{id}', 'StavkePoslaController@destroy');
    // posao materijali
    Route::get('admin/posaomaterijal/show/{id}', 'PosaoMaterijalController@show');
    Route::post('admin/posaomaterijal/create', 'PosaoMaterijalController@create');
    //Route::post('admin/posaomaterijal/store/{id}', 'PosaoMaterijalController@store');
    Route::get('admin/posaomaterijal/edit/{id}', 'PosaoMaterijalController@edit');
    Route::put('admin/posaomaterijal/update/{id}', 'PosaoMaterijalController@update');
    Route::get('admin/posaomaterijal/destroy/{id}', 'PosaoMaterijalController@destroy');
    // pdfponude
    Route::get('admin/pdfponuda/{id}', 'PdfPonudaController@ponuda');
    Route::get('admin/pdfponuda/stavke/{id}', 'PdfPonudaController@stavke');
    Route::get('admin/pdfponuda/stavkematerijali/{ev_id}/{id}', 'PdfPonudaController@stavkematerijali');
    // Projekt
    Route::get('admin/projekt', 'ProjektController@index');
    Route::get('admin/projekt/stavke/{id}', 'ProjektController@stavke');
    Route::get('admin/projekt/materijali/{id}', 'ProjektController@materijali');
     Route::get('admin/projekt/promjene/{id}', 'ProjektController@promjene');
    // predracuni
    Route::get('admin/pdfracun/{id}', 'PdfRacunController@ponuda');
    Route::get('admin/pdfracun/stavke/{id}', 'PdfRacunController@stavke');
    Route::get('admin/pdfracun/stavkematerijali/{ev_id}/{id}', 'PdfRacunController@stavkematerijali');
    Route::get('admin/pdfracun/rekapitaulacija/{id}', 'PdfRacunController@rekapitaulacija');
   
});

// Post Prijava i get odjava
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');
