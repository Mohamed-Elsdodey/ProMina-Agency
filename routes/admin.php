<?php

use App\Models\City;
use App\Models\Region;
use App\Http\Controllers\Admin\{AuthController,
    CategoryController,
    DiscountListController,
    ItemsController,
    ModifiersController,
    HomeController
};
use Illuminate\Support\Facades\Route;


    ### albums

    Route::resource('albums', \App\Http\Controllers\Admin\AlbumController::class);
    Route::get('getAlbumSelect/{id}',[\App\Http\Controllers\Admin\AlbumController::class,'getAlbumSelect'])->name('admin.getAlbumSelect');

    ### albumImages
    Route::resource('images',\App\Http\Controllers\Admin\AlbumImageController::class);
    Route::get('getImagesForAlbum/{id}',[\App\Http\Controllers\Admin\AlbumImageController::class,'index'])->name('admin.getImagesForAlbum');
    Route::post('moveImagesFromAlbum/{id}',[\App\Http\Controllers\Admin\AlbumController::class,'moveImagesFromAlbum'])->name('admin.moveImagesFromAlbum');



