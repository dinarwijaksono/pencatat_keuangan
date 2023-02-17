<?php

namespace App\Domains;

class Transaction_domain
{
    public $id;
    public int $category_id;
    public int $user_id;
    public string $title = '';
    public string $period;
    public int $date;
    public string $type;
    public int $value = 0;
}
