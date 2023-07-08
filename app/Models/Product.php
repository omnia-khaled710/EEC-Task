<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'title','description','price','image','quantity'
    ];

    public function pharmacies(){

        return $this->belongsToMany(Pharmacy::class)->withPivot('price');

    }
}
