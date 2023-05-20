<?php

namespace App\Domains;

class Category_domain
{
    public int $userId;
    public string $code;
    public string $name;
    public string $type;

    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }
}
