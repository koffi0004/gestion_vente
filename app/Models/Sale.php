<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'total_amount',
        'payment_method',
        'note',
        'canceled_at',             // ← si tu veux autoriser la mise à jour en masse
        'cancellation_reason',     // ← optionnel ici
    ];

    protected $casts = [
        'canceled_at' => 'datetime', // ← pour que Laravel gère ça comme un objet Carbon
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}