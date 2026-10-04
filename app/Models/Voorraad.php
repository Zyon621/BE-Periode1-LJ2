<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Voorraad extends Model
{
    protected $table = 'voorraad';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = ['Productid', 'VerpakkingsEenheidinKilogram', 'AantalAanwezig', 'IsActief', 'Opmerkingen', 'DatumAangemaakt', 'DatumGewijzigd'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'Productid', 'Id');
    }
}
