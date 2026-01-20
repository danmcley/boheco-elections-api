<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'CRM_MemberConsumers';
    protected $primaryKey = 'Id';

    protected $keyType = 'string';       
    public $incrementing = false;         
    public $timestamps = true;
    
    protected $casts = [
        'Town' => 'integer',
    ];

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

    protected $appends = [
        'FullName', 
        'FullAddress'
    ];

    public function getFullNameAttribute()
    {
        return trim("{$this->FirstName} {$this->MiddleName} {$this->LastName} {$this->Suffix}");
    }

    public function getFullAddressAttribute()
    {
        $barangay = $this->barangayDetail?->Barangay;
        $town = $this->townDetail?->Town;
        $sitio = $this->Sitio;

        $parts = array_filter([$barangay, $sitio, $town]);

        return implode(', ', $parts);
    }


    public function spouse()
    {
        return $this->hasOne(MemberSpouse::class, 'MemberConsumerId', 'Id');
    }

    public function asSpouse()
    {
        return $this->hasOne(Member::class, 'Id', 'MemberConsumerId')->
            join('CRM_MemberConsumerSpouse', 'CRM_MemberConsumers.Id','=','CRM_MemberConsumerSpouse.MemberConsumerId');
    }

    public function townDetail()
    {
        return $this->belongsTo(Town::class, 'Town', 'id');
    }

    public function barangayDetail()
    {
        return $this->belongsTo(Barangay::class, 'Barangay', 'id');
    }
}
