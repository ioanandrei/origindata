<?php

namespace App\Api\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        /** @var Company $entity */
        $entity = $this->resource;

        return [
            'id'   => $entity->id,
            'name' => $entity->name,
        ];
    }
}
