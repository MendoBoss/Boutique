<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    protected $guarded=[];

    use HasFactory;
    
    public function article(){
        return $this->belongsTo(Article::class);
    }
}
