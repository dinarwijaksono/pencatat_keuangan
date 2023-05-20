<?php

namespace Tests\Feature\Controller;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthController_Test extends TestCase
{
    public function test_renderRegister()
    {
        $view = $this->get('/Auth/register');

        $view->assertSee('REGISTER');
        $view->assertSee('username');
        $view->assertSee('password');
        $view->assertSee('konfirmasi password');
        $view->assertSee('Register');
    }


    public function test_renderLogin()
    {
        $view = $this->get('/Auth/login');

        $view->assertSee('login');
        $view->assertSee('username');
        $view->assertSee('password');
    }
}
