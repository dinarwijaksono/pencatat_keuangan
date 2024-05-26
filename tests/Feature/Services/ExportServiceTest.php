<?php

namespace Tests\Feature\Services;

use App\Models\User;
use App\Services\ExportService;
use App\Services\UserService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use stdClass;
use Tests\TestCase;

class ExportServiceTest extends TestCase
{
    public $user;
    public $exportService;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(UserSeeder::class);
        $this->user = User::select('*')->where('email', env("USER_EMAIL_TEST"))->first();
        $this->actingAs($this->user);

        $this->seed(CategorySeeder::class);
        $this->seed(CategorySeeder::class);

        $this->exportService = $this->app->make(ExportService::class);
    }

    public function test_export_success(): void
    {
        $obj = new stdClass();
        $obj->date = time() * 1000;
        $obj->period = "Jan-2024";
        $obj->category_name = "Makanan";
        $obj->description = "Makan siang";
        $obj->income = 1000;
        $obj->spending = 0;

        $object = collect();
        $object->push($obj);

        $this->exportService->export($this->user->username, $object);

        $this->assertDirectoryExists(__DIR__ . '/../../../public/storage/Export');
        $this->assertFileExists(__DIR__ . '/../../../public/storage/Export/' . $this->user->username . "-transaction-export.csv");
    }
}
