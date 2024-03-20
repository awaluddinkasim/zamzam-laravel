<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'tgl_penyewaan' => Carbon::parse($this->tgl_penyewaan)->isoFormat('DD MMMM YYYY'),
            'status' => $this->status,
            'keterangan' => $this->keterangan,
            'tgl_selesai' => $this->tgl_selesai ? Carbon::parse($this->tgl_selesai)->isoFormat('DD MMMM YYYY') : null,
            'total_harga' => $this->total_harga,
            'dibayar' => $this->dibayar,
            'sisa' => $this->sisa,
            'items' => OrderItemResource::collection($this->items),
            'payments' => OrderPaymentResource::collection($this->payments)
        ];
    }
}
