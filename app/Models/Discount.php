<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\StatusEnum;
use App\TypeEnum;

class Discount extends Model
{
    //
    protected $fillable = [
        'title',
        'start_date',
        'end_date'
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
    protected $casts = [
        'status' => StatusEnum::class,
        'type' => TypeEnum::class
    ];
    
}