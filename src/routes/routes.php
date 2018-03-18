<?php

Route::group(['prefix' => 'api/perijinan-satu-pintu', 'middleware' => ['web']], function() {
    $controllers = (object) [
        'index'     => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@index',
        'create'    => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@create',
        'show'      => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@show',
        'store'     => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@store',
        'edit'      => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@edit',
        'update'    => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@update',
        'destroy'   => 'Bantenprov\PerijinanSatuPintu\Http\Controllers\PerijinanSatuPintuController@destroy',
    ];

    Route::get('/',             $controllers->index)->name('perijinan-satu-pintu.index');
    Route::get('/create',       $controllers->create)->name('perijinan-satu-pintu.create');
    Route::get('/{id}',         $controllers->show)->name('perijinan-satu-pintu.show');
    Route::post('/',            $controllers->store)->name('perijinan-satu-pintu.store');
    Route::get('/{id}/edit',    $controllers->edit)->name('perijinan-satu-pintu.edit');
    Route::put('/{id}',         $controllers->update)->name('perijinan-satu-pintu.update');
    Route::delete('/{id}',      $controllers->destroy)->name('perijinan-satu-pintu.destroy');
});
