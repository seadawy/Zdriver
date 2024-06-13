<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Driver;
use App\Models\Company;
use App\Models\TrackRecord;

class Device extends Model
{
    use HasFactory;
    protected $table = 'devices';
    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function records(): HasMany
    {
        return $this->hasMany(TrackRecord::class);
    }
}
