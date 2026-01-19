<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberSpouse extends Model
{
    protected $table = 'CRM_MemberConsumerSpouse';
    protected $primaryKey = 'Id';

    protected $keyType = 'string';       
    public $incrementing = false;         
    public $timestamps = true;

    protected $fillable = [
        'MemberConsumerId', 
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

    public function member()
    {
        return $this->belongsTo(
            Member::class,
            'MemberConsumerId',
            'Id'
        );
    }
}
