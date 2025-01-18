<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Command extends Model
{
    use HasFactory;
    protected $fillable = ["date", "amount", "client_id"];


    function client(){
        return $this->belongsTo(Client::class);
    }

    function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    function total(){
        $total = 0;
        foreach($this->products as $product){
            $total += $product->price * $product->pivot->quantity;
        }
        return $total;
    }
}
