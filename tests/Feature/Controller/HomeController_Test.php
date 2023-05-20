<?php

namespace Tests\Feature\Controller;

use App\Services\User_service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;

class HomeController_Test extends TestCase
{
    protected $userService;

    public function setUp(): void
    {
        parent::setUp();

        config(['database.default' => 'mysql-test']);

        $this->userService = $this->app->make(User_service::class);
    }

    public function test_renderHomeIndexNotWithSession()
    {
        $view = $this->get('/Home/index');

        $view->assertRedirect('/Auth/login');
    }

    public function test_renderHomeindexWithSession()
    {
        $request = new Request();
        $request['username'] = 'contoh-' . mt_rand(1, 9999);
        $request['password'] = 'rahasia';

        $this->userService->register($request);

        $view = $this->withSession(['username' => $request->username])->get('/Home/index');

        $view->assertSee('Pencatat');
        $view->assertSee('Keuangan');
        $view->assertSee('Logout');
        $view->assertSee($request->username);
        $view->assertSee('dinarwijaksono11');
    }
}
