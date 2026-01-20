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
            'full_name'      => $this->FullName,
            // 'first_name'     => $this->FirstName,
            // 'middle_name'    => $this->MiddleName,
            // 'last_name'      => $this->LastName,
            // 'suffix'         => $this->Suffix,
            'address'        => $this->Full_Address,
            'gender'         => $this->Gender,
            'birth_date'     => $this->BirthDate,
            'contact_number' => $this->ContactNumbers,
            'email'          => $this->EmailAddress,
            // 'created_at'     => $this->created_at,
            // 'updated_at'     => $this->updated_at,
            
            'spouse' => $this->whenLoaded('spouse', function () {
                return $this->spouse
                    ? [
                        'full_name' => $this->spouse->FullName,
                        // 'first_name'=> $this->spouse->FirstName,
                        // 'middle_name'=> $this->spouse->MiddleName,
                        // 'last_name' => $this->spouse->LastName,
                        // 'suffix'    => $this->spouse->Suffix,
                        'gender'    => $this->spouse->Gender,
                        'birth_date'=> $this->spouse->BirthDate,
                        'contact_number' => $this->spouse->ContactNumbers,
                        'email'     => $this->spouse->EmailAddress,
                        'address' => $this->spouse->FullAddress,
                        // 'created_at'=> $this->spouse->created_at,
                        // 'updated_at'=> $this->spouse->updated_at,
                    ]
                    : null;
            }),
        ];
    }
}
