<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->Id,
            'first_name'     => $this->FirstName,
            'middle_name'    => $this->MiddleName,
            'last_name'      => $this->LastName,
            'suffix'         => $this->Suffix,
            'gender'         => $this->Gender,
            'birth_date'     => $this->BirthDate,
            'sitio'          => $this->Sitio,
            'barangay'       => $this->Barangay,
            'town'           => $this->Town,
            'contact_number' => $this->ContactNumbers,
            'email'          => $this->EmailAddress,
            'full_name'      => $this->FullName,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
