<?php

namespace Tests\Checker\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{

    /**
     * Проверяем, что главная страница подгружается корректно и перенаправляется на /checker/home
     */
    public function testGetMainPage()
    {
        $response = $this->get('/');

        $response->assertRedirect('/checker/home');
    }
}
