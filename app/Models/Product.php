<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'code', 'price', 'category_id', 'description', 'image', 'hit', 'new', 'recomend'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }
    
    public function setHitAttribute($value){
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }
    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1 : 0;

    }
    public function setRecomendAttribute($value){
        $this->attributes['recomend'] = $value === 'on' ? 1 : 0;

    }

    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isNew()
    {
        return $this->new === 1;

    }
    public function isRecomend()
    {
        return $this->recomend === 1;

    }
}
