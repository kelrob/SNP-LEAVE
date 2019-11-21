<?php

namespace App\Models\Holidays;

use Illuminate\Database\Eloquent\Model;

class PublicHolidays extends Model
{
    protected $table = 'public_holiday';
    protected $primaryKey = 'id';
}
