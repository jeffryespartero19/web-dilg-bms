<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodTypeModel extends Model
{

    protected $table = 'maintenance_bips_blood_type';

    protected $fillable = [
        'Blood_Type', 'Encoder_ID', 'Date_Stamp',
    ];
}
