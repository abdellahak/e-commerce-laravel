<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'stock', 'description', 'image', 'category_id'];

    function category(){
        return $this->belongsTo(Category::class);
    }

    function commands(){
        return $this->belongsToMany(Command::class)->withPivot('quantity');
    }
}
