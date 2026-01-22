<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NomineeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'          => $this->id,
            'first_name'  => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name'   => $this->last_name,
            'suffix'      => $this->suffix,
            'town'        => $this->town,
            'district'    => $this->district,
            'nickname'    => $this->nickname,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'image_url' => $this->image_path
                ? Storage::disk('public')->url($this->image_path)
                : null,
        ];
    }
}
