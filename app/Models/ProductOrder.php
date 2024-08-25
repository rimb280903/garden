<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table = 'produit_commande';

    protected $fillable = [
        'prix_total', 'description', 'id_Client', 'id_Produit', 'statut'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_Produit');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_Commande');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'id_Client');
    }
}
