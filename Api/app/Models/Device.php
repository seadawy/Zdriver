<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Driver;
use App\Models\TrackRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Device extends Model
{
    use HasFactory;
    protected $table = 'devices';
    protected $fillable = ['company_id', 'modelNumber'];
    public function driver(): HasOne
    {
        return $this->hasOne(Driver::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function records(): HasMany
    {
        return $this->hasMany(TrackRecord::class);
    }
}
