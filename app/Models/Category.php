<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Facades\App;
use App\Enums\StatusEnum;

class Category extends Model
{
    //
    use HasFactory;
    use HasTranslations;
    protected $fillable =[
        'full_name',
        'slug',
        'status',
    ];
    public function Areas(){
        return $this->hasMany(Product::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class);
    }
     public $translatable = ['full_name'];
      protected $appends = ['translated_name'];
       protected function getSlugFrom(): string
    {
        return 'name->en';
    }


    public function getTranslatedNameAttribute()
    {
        return $this->getTranslation('name', App::getLocale());
    }

    protected $casts = [
        'status' =>StatusEnum::class 
    ];

}