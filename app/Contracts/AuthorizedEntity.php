<?php

namespace App\Contracts;

interface AuthorizedEntity
{
    public function getAuthorizationTokenNameAttribute() : string;
}
