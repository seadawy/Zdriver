<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use app\Models\Device;

class TrackRecord extends Model
{
    use HasFactory;
    protected $table = 'track_record';
    protected $fillable = ['type', 'description', 'device_id'];

    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
