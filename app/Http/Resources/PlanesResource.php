<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'nama_pesawat' => $this->nama_pesawat,
            // 'owner' => $this->owner['username'],
            'image' => $this->image,
            'created_at' => date_format($this->created_at, 'Y/M/D H:i:s'),
        ];
    }
}
