<?php

namespace App\Models;

use App\Models\Traits\Transaltable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use Transaltable;

    protected $fillable = ['code','name', 'description', 'image','name_en','description_en'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
