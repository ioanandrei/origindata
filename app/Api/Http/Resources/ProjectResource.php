<?php

namespace App\Api\Http\Resources;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        /** @var Project $entity */
        $entity = $this->resource;

        return [
            'id'         => $entity->id,
            'name'       => $entity->name,
            'company_id' => $entity->company_id,
        ];
    }
}
