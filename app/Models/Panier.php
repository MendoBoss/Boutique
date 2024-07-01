<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Panier extends Model
{
    use HasFactory;

    protected $guarded=[];


    public function articles(){
        return $this->belongsToMany(Article::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
