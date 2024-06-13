<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use app\Model\Device;

class Driver extends Model
{
    use HasFactory;
    protected $table = 'driver';
    public function driver(): HasOne
    {
        return $this->hasOne(Device::class);
    }
}
