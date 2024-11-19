<?php

namespace App\Models;

use App\Models\OfficeSpace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use Hasfactory, SoftDeletes;
    protected $fillable = [
        'name',
        'photo',
        'slug',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function officeSpace(): HasMany
    {
        return $this->hasMany(OfficeSpace::class);
    }
}
