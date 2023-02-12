<?php

namespace Tests\Feature;

use App\Domains\Item_domain;
use App\Services\Item_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ItemService_Test extends TestCase
{
    protected $item_service;
    protected $item_domain;

    public function setUp(): void
    {
        parent::setUp();

        $this->item_domain = $this->app->make(Item_domain::class);
        $this->item_service = $this->app->make(Item_service::class);
    }


    public function test_makeItemSuccess()
    {
        $category = DB::table('categories')->select('id', 'type')->first();
        $user = DB::table('users')->select('id')->first();

        $item = $this->item_domain;
        $item->category_id = 1;
        $item->user_id = $user->id;
        $item->title = 'makan malam';
        $item->period = date('M-Y', time());
        $item->date = mktime(0, 0, 0, 2, 12, 2023);
        $item->type = 'pemasukan';
        $item->value = 2400000;

        $this->item_service->transaction($item);

        $this->assertDatabaseHas('items', ['title' => $item->title]);
        $this->assertDatabaseHas('items', ['type' => $item->type]);
        $this->assertDatabaseHas('items', ['value' => $item->value]);
    }
}
