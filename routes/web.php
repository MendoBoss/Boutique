<?php

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoutiqueController;

// Route::get('/', function () {
//     $user=Auth::user();
//     return view('home',$user);
// });

Route::get('/',[BoutiqueController::class,'index'])->name('home');
Route::get('/article/{id}',[BoutiqueController::class,'showOne'])->name('article');
Route::get('/categorie/{id}',[BoutiqueController::class,'showCat'])->name('categorie');


Route::get('/dashboard', function () {
    $articles=Article::with('images','categories')->get();
    // dd($articles);
    return view('dashboard',compact('articles'));
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
        Route::get('/panier',[BoutiqueController::class,'panier'])->name('panier');
        Route::get('/addPanier/{id}',[BoutiqueController::class,'addPanier'])->name('addPanier');
        Route::post('/storePanier',[BoutiqueController::class,'storePanier'])->name('storePanier');
        Route::get('/deletePanier/{id}',[BoutiqueController::class,'deletePanier'])->name('deletePanier');

        Route::get('/addArticle',[BoutiqueController::class,'addArticle'])->name('addArticle');
        Route::post('/storeArticle',[BoutiqueController::class,'storeArticle'])->name('storeArticle');

        Route::get('/deleteArticle/{id}',[BoutiqueController::class,'deleteArticle'])->name('deleteArticle');
        Route::get('/updateArticle/{id}',[BoutiqueController::class,'updateArticle'])->name('updateArticle');
        Route::post('/storeUpdateArticle',[BoutiqueController::class,'storeUpdateArticle'])->name('storeUpdateArticle');
});

require __DIR__.'/auth.php';
