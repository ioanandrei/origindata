<?php

namespace App\Api\Http\Resources;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    public function toArray(Request $request) : array
    {
        /** @var Employee $entity */
        $entity = $this->resource;

        return [
            'id'         => $entity->id,
            'first_name' => $entity->first_name,
            'last_name'  => $entity->last_name,
            'email'      => $entity->email,
            'phone'      => $entity->phone,
        ];
    }
}
