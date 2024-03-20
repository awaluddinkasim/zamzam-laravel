<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BarangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'kode' => $this->kode,
            'nama' => $this->nama,
            'harga' => $this->harga,
            'deskripsi' => $this->deskripsi,
            'kategori' => $this->kategori,
            'img' => $this->img,
            'varian' => BarangVarianResource::collection($this->varian),
        ];
    }
}
