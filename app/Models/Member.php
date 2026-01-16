<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'CRM_MemberConsumers';
    protected $primaryKey = "Id";
    public $timestamps = true;

    protected $fillable = [
        'FirstName',
        'MiddleName',
        'LastName',
        'Suffix',
        'Gender',
        'BirthDate',
        'Sitio',
        'Barangay',
        'Town',
        'ContactNumbers',
        'EmailAddress',
    ];

    
    protected $appends = ['FullName'];

    public function getFullNameAttribute()
    {
        return trim("{$this->FirstName} {$this->MiddleName} {$this->LastName} {$this->Suffix}");
    }
}
