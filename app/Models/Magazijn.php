<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Magazijn extends Model
{
    protected $table = 'magazijn';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = ['ProductId', 'VerpakkingsEenheid', 'AantalAanwezig', 'IsActief', 'Opmerking'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }
}
