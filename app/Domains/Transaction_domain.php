<?php

namespace App\Domains;

class Transaction_domain
{
    public int $userId;
    public int $categoryId;
    public string $code;
    public string $period;
    public int $date;
    public string $type;
    public string $item;
    public int $value;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }
}
