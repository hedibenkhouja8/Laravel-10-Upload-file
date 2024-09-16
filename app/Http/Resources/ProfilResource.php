<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
         if ($request->user()) {
        return parent::toArray($request);

    }

    return [
        'id' => $this->id,
        'nom' => $this->nom,
        'prenom' => $this->prenom,
        'image' => $this->image,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}
}
