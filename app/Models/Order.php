<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'commande';

    protected $fillable = [
        'statue_Co', 'id_PC', 'pric_total_Co', 'id_client'
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'id_client');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'produit_commande', 'id_Commande', 'id_Produit')
                    ->withPivot('prix_total', 'description', 'statut')
                    ->withTimestamps();
    }
}
