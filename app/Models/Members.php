<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $fillable = [
        'FirstName', 'MiddleName', 'LastName', 'id', 'Gender', 'BirthDate', 'Barangay', 'Sitio', 'Town', 'ContactNumber', 'Email'
    ];
}
