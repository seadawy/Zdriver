<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Device;
use App\Models\User;

class Driver extends User
{
    use HasFactory;
    protected $table = 'driver';
    protected $fillable = ['name', 'email', 'password', 'company_id', 'role', 'phone', 'gender', 'address', 'image', 'score', 'device_id'];
    public function device(): HasOne
    {
        return $this->hasOne(Device::class);
    }
}
