<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tanggal_upload' => Carbon::parse($this->created_at)->isoFormat('DD MMMM YYYY'),
            'nominal' => $this->nominal,
            'bukti_pembayaran' => $this->bukti_pembayaran,
        ];
    }
}
