<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\StatusEnum;

class ProductSize extends Model
{
    //
    protected $fillable = [
        'title'
    ];
    protected $casts = [
        'status' => StatusEnum::class
    ];
    public function category(){
        return $this->hasMany(Product::class);
    }

}