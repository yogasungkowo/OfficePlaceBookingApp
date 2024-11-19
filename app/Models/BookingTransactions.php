<?php

namespace App\Models;

use App\Models\OfficeSpace;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingTransactions extends Model
{
    use Hasfactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phonr_number',
        'booking_trx',
        'office_space_id',
        'total_amount',
        'duration',
        'started_at',
        'ended_at',
        'is_paid',
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
