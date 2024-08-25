<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'categorie';

    protected $fillable = [
        'nom_C', 'description_C', 'image_C'
    ];
    

    protected static function booted()
    {
        static::deleted(function ($category) {
            $category->products()->delete();
        });
        static::restoring(function ($category) {
            // Restore the related products
            $category->products()->withTrashed()->restore();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'id_Categorie');
    }
}
