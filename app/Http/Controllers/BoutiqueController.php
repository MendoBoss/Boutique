<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Panier;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BoutiqueController extends Controller
{
    public function index(){
        $articles=Article::all();
        return view('home',compact('articles'));
    }

    // voir une categorie
    public function showCat($id){
        $categorie=Categorie::find($id);
        $cat=Categorie::with('articles')->where('id',$id)->first();
        return view('categorie',compact('cat','categorie'));
    }
    // voir un article
    public function showOne($id){
        $article=Article::findOrFail($id);
        return view('article',compact('article'));
    }

    // panier
    public function panier(){
        $lignes =Panier::with('articles')->first();

        return view('auth.panier',compact('lignes'));
    }
    public function addPanier($id){
        $user=auth()->user();
        $panier=$user->panier;
        $panier->articles()->attach($id);
        return redirect('/panier');
    }
    public function storePanier(Request $request){
        $user=auth()->user();
        $amount=($request->total)*100;
        $lignes =Panier::with('articles')->first();
        $user->charge($amount,$request->payment_method,[ 'return_url' => route('home')]);
        $paniers=$user->panier;
        $paniers->articles()->detach();
        return redirect()->route('home')->with('info', 'Payement effectué !');
    }
    public function truncPanier(){
        return back();
    }
    // Supprimer du panier
    public function deletePanier($id){
        DB::table('article_panier')->where('article_id', $id)->delete();
        return back();
    }
    
    // Ajouter article
    public function addArticle(){
        $categories= Categorie::all();
        return view('auth.ajoutArticle',compact('categories'));
    }
    public function storeArticle(Request $request){
        $article=Article::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'content'=>$request->content,
            'price'=>$request->price,
            'stock'=>$request->stock
        ]);

        $filename= time().'.'.$request->image->extension();
        $path=$request->image->storeAs(
            'images/articles',
            $filename,
            'public'
        );
        $image = $article->images()->create([
            'path'=>$path
        ]);
        $categorie=$request->categorie;
        
        $article->categories()->attach($categorie);
        $article->save();
        // dd('ok');
        return back();
    }
    // Supprimer article
    public function deleteArticle($id){
        $article=Article::find($id);
        $article->delete();
        return back();
    }
    // Modifier article
    public function updateArticle($id){
        $categories=Categorie::all();
        $article=Article::find($id);
        // dd($article->images);
        return view('auth.updateArticle',compact('article','categories'));
    }
    public function storeUpdateArticle(Request $request){
        $article=Article::with('categories','images')->where('id',$request->id)->first();
        // Enregistrer les infos
        $article->title=$request->title;
        $article->description=$request->description;
        $article->content=$request->content;
        $article->price=$request->price;
        $article->stock=$request->stock;

        if ($request->newImage != null) {
            // Definir nom et path image
            $filename= time().'.'.$request->newImage->extension();
            $path=$request->newImage->storeAs(
                'images/articles',
                $filename,
                'public'
            );
            // Enregistrer image
            $article->images[0]->path=$path;
            $image=$article->images();
            $image->save($article->images[0]);
        }
        // Enregistrer categorie
        $article->categories()->updateExistingPivot($article->categories[0]->id,[
            'categorie_id'=>$request->categorie
        ]);
        // Sauvegarder
        $article->save();

        return back();
    }
}
