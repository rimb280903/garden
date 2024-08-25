<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'produit';

    protected $fillable = [
        'nom_P', 'description_P', 'prix_base', 'id_Categorie','image_path'
    ];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_Categorie');
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'id_produit');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'produit_commande', 'id_Produit', 'id_Commande')
                    ->withPivot('prix_total', 'description', 'statut')
                    ->withTimestamps();
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->productVariants()->delete();
        });
    }
}
