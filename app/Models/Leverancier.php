<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Leverancier extends Model
{
    protected $table = 'leverancier';

    protected $primaryKey = 'Id';

    public $timestamps = false;

    public function leveringen(): HasMany
    {
        return $this->hasMany(Levering::class, 'LeverancierId', 'Id');
    }
}
