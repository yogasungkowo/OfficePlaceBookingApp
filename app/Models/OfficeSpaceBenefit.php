<?php

namespace App\Models;

use App\Models\OfficeSpace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSpaceBenefit extends Model
{
    use Hasfactory, SoftDeletes;

    protected $fillable = [
        'name',
        'office_space_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
    }

    public function officeSpace(): belongsTo
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}
