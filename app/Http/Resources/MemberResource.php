<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\MemberSpouse;

class MemberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isMember = $this instanceof \App\Models\Member || isset($this->spouse);

        if ($isMember) {
            return [
                'member_id' => (string) $this->Id,
                'full_name' => $this->FullName,
                'address'   => $this->FullAddress,
                'gender'    => $this->Gender,
                'birth_date'=> $this->BirthDate,
                'contact_number' => $this->ContactNumbers,
                'email'     => $this->EmailAddress,

                'spouse' => $this->spouse ? [
                    'id'        => (string) $this->spouse->id,
                    'full_name' => $this->spouse->FullName,
                    'address'   => $this->spouse->FullAddress,
                    'gender'    => $this->spouse->Gender,
                    'birth_date'=> $this->spouse->BirthDate,
                    'contact_number' => $this->spouse->ContactNumbers,
                    'email'     => $this->spouse->EmailAddress,
                ] : null,
            ];
        } else {
            return [
                'id'        => $this->id,
                'full_name' => $this->FullName,
                'address'   => $this->FullAddress,
                'gender'    => $this->Gender,
                'birth_date'=> $this->BirthDate,
                'contact_number' => $this->ContactNumbers,
                'email'     => $this->EmailAddress,

                'spouse' => $this->member ? [
                    'id'        => (string) $this->member->Id,
                    'full_name' => $this->member->FullName,
                    'address'   => $this->member->FullAddress,
                    'gender'    => $this->member->Gender,
                    'birth_date'=> $this->member->BirthDate,
                    'contact_number' => $this->member->ContactNumbers,
                    'email'     => $this->member->EmailAddress,
                ] : null,
            ];
        }
    }
}
