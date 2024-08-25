<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $table = 'produit_variante';

    protected $fillable = [
        'id_produit', 'id_variante', 'valeur', 'prix'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_produit');
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class, 'id_variante');
    }
}
