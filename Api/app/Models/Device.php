<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use app\Model\Driver;

class Device extends Model
{
    use HasFactory;
    protected $table = 'devices';
    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }
}
