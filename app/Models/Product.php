<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
// use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Translatable\HasTranslations; 
use Illuminate\Support\Facades\App;
use App\Enums\StatusEnum;
use App\traits\sluggable;

class Product extends Model implements HasMedia 
{
    //
    use InteractsWithMedia; 
    use SoftDeletes;
    use  HasTranslations;
    use sluggable;
    
    protected $fillable =[
        'full_name',
        'description',
        'price',
        'category_id',
        'slug',
        'status',
    ];
    // protected $appends = [
    //     'formatte_price',
    // ];
    public function category(){
        return $this->belongsTo(Category::class);
    }
     public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }
    public function getTranslatedNameAttribute()
    {
        return $this->getTranslation('name', App::getLocale());
    }

    public function getTranslatedDescriptionAttribute()
    {
        return $this->getTranslation('description', App::getLocale());
    }
     protected function getSlugFrom(): string
    {
        return 'name->en';
    }
    //  public function setNameAttribute($value)
    // {
    //     $this->attributes['full_name'] = ucfirst($value);
    // }
    public $translatable = ['full_name', 'description']; 
    
    protected $appends = ['translated_name', 'translated_description'];

    Public function registerMediaCollections() : void 
    {
      $this->addMediaCollection('images');
       $this->addMediaCollection('gallery_images');
    }
    // مجموعة للصورة الرئيسية (صورة واحدة فقط)
        // $this->addMediaCollection('main_image')
        //      ->singleFile(); // تسمح بملف واحد فقط في هذه المجموعة

    // public function getFormattePriceorAttribute(){
    //     return "$". number_format('price') ;
        
    // }
    // protected function firstLetter(): Attribute

    // {

    //     return Attribute::make(

    //         get: fn (string $products) => ucfirst($products),

    //     );

    // }
    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function getNameAttribute($value)
    {
        return $this->price < 2000?$value.' - Offer':$value;
    }

    public function getPercAttribute()
    {
        return round($this->price?$this->discount * 100 / $this->price:0, 2);
    }
    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    protected $casts = [
        'status' =>StatusEnum::class 
    ];
    
}