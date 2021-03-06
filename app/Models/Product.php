<?php

namespace App\Models;

use App\Models\Traits\Transaltable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{

    use SoftDeletes;
    use Transaltable;
    protected $table = 'products';

    protected $fillable = ['name', 'code', 'price', 'category_id', 'description', 'image', 'hit', 'new', 'recomend', 'count', 'name_en','description_en'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeHit($query)
    {
        return $query->where('hit', 1);
    }
    public function scopeNew($query)
    {
        return $query->where('new', 1);
    }
    public function scopeRecomend($query)
    {
        return $query->where('recomend', 1);
    }

    public function scopeOrderByPrice($query){
        return $query->orderBy('price', 'asc');
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }
    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }
    public function setRecomendAttribute($value)
    {
        $this->attributes['recomend'] = $value === 'on' ? 1 : 0;
    }

    public function isAvilable(){
        $this->trashed();
        return  !$this->trashed() && $this->count >= 1;
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
