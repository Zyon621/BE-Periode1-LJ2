<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Levering extends Model
{
    protected $table = 'productperleverancier';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    protected $casts = [
        'DatumLevering' => 'date',
        'DatumEerstvolgendeLevering' => 'date',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'ProductId', 'Id');
    }

    public function leverancier(): BelongsTo
    {
        return $this->belongsTo(Leverancier::class, 'LeverancierId', 'Id');
    }
}
