<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Variant extends Model
{
    protected $table = 'variante';

    protected $fillable = [
        'nom_V'
    ];

    protected $dates = ['deleted_at'];

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class, 'id_variante');
    }
}
