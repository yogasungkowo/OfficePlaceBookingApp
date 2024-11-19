<?php

namespace App\Models;

use App\Models\OfficeSpace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeSpacePhoto extends Model
{
    use Hasfactory, SoftDeletes;

    protected $fillable = [
        'photo',
        'office_space_id',
    ];

    public function officeSpace(): belongsTo
    {
        return $this->belongsTo(OfficeSpace::class);
    }
}
