<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource
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
            'pesawat' => $this->pesawat['nama_pesawat'],
            'penyewa' => $this->penyewa['username'],
            'status' => $this->status,
            'created_at' => date_format($this->created_at, "Y-M-D H:i")
        ];
    }
}
