<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Device;
use App\Models\User;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companys';
    protected $fillable = ['name', 'phone', 'address'];

    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
