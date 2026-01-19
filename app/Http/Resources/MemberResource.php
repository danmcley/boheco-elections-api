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
            'id'             => (string) $this->Id,
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

            'spouse' => $this->whenLoaded('spouse', function () {
                return $this->spouse
                    ? [
                        'first_name'=> $this->spouse->FirstName,
                        'middle_name'=> $this->spouse->MiddleName,
                        'last_name' => $this->spouse->LastName,
                        'suffix'    => $this->spouse->Suffix,
                        'gender'    => $this->spouse->Gender,
                        'birth_date'=> $this->spouse->BirthDate,
                        'sitio'     => $this->spouse->Sitio,
                        'barangay'  => $this->spouse->Barangay,
                        'town'      => $this->spouse->Town,
                        'contact_number' => $this->spouse->ContactNumbers,
                        'email'     => $this->spouse->EmailAddress,
                        'full_name' => $this->spouse->FullName,
                        'created_at'=> $this->spouse->created_at,
                        'updated_at'=> $this->spouse->updated_at,
                    ]
                    : null;
            }),
        ];
    }
}
