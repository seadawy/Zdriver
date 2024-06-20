<?php

namespace App\Models;

use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Driver extends User
{
    use HasFactory;
    protected $table = 'driver';
    protected $fillable = ['user_id', 'device_id', 'score'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
