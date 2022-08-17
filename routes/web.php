<?php

use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\PersonalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillController;
use App\Models\Personal;

Route::get('/', function () {

    $resume  = Personal::all();
    return view('index', [
        'resume' => $resume
    ]);

});




Route::group(['prefix' => 'cv'], function(){
    Route::get('create/{slug}', [PersonalController::class,'create'])->name('cv.create')->whereNumber('slug');
    Route::get('create/auto', [PersonalController::class, 'autoCreate'])->name('cv.auto.create');
    Route::post('create/update/{id}', [PersonalController::class, 'update'])->name('cv.update');
    Route::get('delete/{id}', [PersonalController::class, 'delete'])->name('cv.delete');
    Route::get('download/{id}', [PersonalController::class, 'getCv'])->name('cv.download');
});


Route::group(['prefix' => 'experience'], function(){
    Route::post('create/{id}', [ExperienceController::class, 'create'])->name('experience.create');
    Route::post('update/{id}', [ExperienceController::class, 'update'])->name('experience.update');
    Route::get('get/{id}',[ExperienceController::class, 'get'] )->name('experience.get');
    Route::get('delete/{id}', [ExperienceController::class, 'delete'])->name('experience.delete');
});



Route::group(['prefix' => 'diplome'], function(){
    Route::post('create/{id}', [DiplomeController::class, 'create'])->name('diplome.create');
    Route::post('update/{id}', [DiplomeController::class, 'update'])->name('diplome.update');
    Route::get('get/{id}',[DiplomeController::class, 'get'] )->name('diplome.get');
    Route::get('delete/{id}', [DiplomeController::class, 'delete'])->name('diplome.delete');
});



Route::group(['prefix' => 'hobby'], function(){
    Route::post('create/{id}', [HobbyController::class, 'create'])->name('hobby.create');
    Route::post('update/{id}', [HobbyController::class, 'update'])->name('hobby.update');
    Route::get('get/{id}',[HobbyController::class, 'get'] )->name('hobby.get');
    Route::get('delete/{id}', [HobbyController::class, 'delete'])->name('hobby.delete');
});



Route::group(['prefix' => 'skill'], function(){
    Route::post('create/{id}', [SkillController::class, 'create'])->name('skill.create');
    Route::post('update/{id}', [SkillController::class, 'update'])->name('skill.update');
    Route::get('get/{id}',[SkillController::class, 'get'] )->name('skill.get');
    Route::get('delete/{id}', [SkillController::class, 'delete'])->name('skill.delete');
});



Route::group(['prefix' => 'language'], function(){
    Route::post('create/{id}', [LanguageController::class, 'create'])->name('language.create');
    Route::post('update/{id}', [LanguageController::class, 'update'])->name('language.update');
    Route::get('get/{id}',[LanguageController::class, 'get'] )->name('language.get');
    Route::get('delete/{id}', [LanguageController::class, 'delete'])->name('language.delete');
});



