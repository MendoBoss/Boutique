<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Panier;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    protected $guarded=[];

    use HasFactory;

    public function images(){
        return $this->hasMany(Image::class);
    }
    public function paniers(){
        return $this->belongsToMany(Panier::class);
    }
    public function categories(){
        return $this->belongsToMany(Categorie::class);
    }
}
