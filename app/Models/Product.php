<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    protected $table = 'product';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $fillable = ['Naam', 'Barcode', 'IsActief', 'Opmerkingen', 'DatumAangemaakt', 'DatumGewijzigd'];

    public function voorraad(): HasOne
    {
        return $this->hasOne(Voorraad::class, 'Productid', 'Id');
    }

    public function allergenen(): BelongsToMany
    {
        return $this->belongsToMany(Allergeen::class, 'productperallergeen', 'ProductId', 'AllergeenId')
            ->orderBy('Naam');
    }

    public function leveringen(): HasMany
    {
        return $this->hasMany(Levering::class, 'ProductId', 'Id');
    }
}
