<?php

namespace App\Domains;

class Transaction_domain
{
    public int $user_id;
    public int $category_id;
    public string $code;
    public string $period;
    public int $date;
    public string $type;
    public string $item;
    public int $value;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
}
