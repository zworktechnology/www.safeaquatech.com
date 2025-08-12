<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealership extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_name',
        'office_address',
        'work_area',
        'date_of_birth',
        'weeding_date',
        'phone_number',
        'whats_app',
        'interested_in'
    ];
}
