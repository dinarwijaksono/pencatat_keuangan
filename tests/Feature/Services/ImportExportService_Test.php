<?php

namespace Tests\Feature\Services;

use App\Services\ImportExport_service;
use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class ImportExportService_Test extends TestCase
{
    protected $user;
    protected $impotExportService;

    public function setUp(): void
    {
        parent::setUp();

        $userService = $this->app->make(User_service::class);
        $request = new Request();
        $request['username'] = 'example-' . mt_rand(1, 9999);
        $request['password'] = 'this is password';
        $userService->register($request);

        $this->user = $userService->getByUsername($request->username);

        $this->impotExportService = $this->app->make(ImportExport_service::class);
    }

    public function test_setFormat()
    {
        $this->impotExportService->setFormat();

        $this->assertFileExists("public/storage/Format/format.xlsx");
    }
}
