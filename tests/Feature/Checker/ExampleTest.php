<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{

    /**
     * Проверяем, что главная страница подгружается корректно и переадресует на /checker/home
     */
    public function testGetMainPage()
    {
        $response = $this->get('/');

        $response->assertRedirect('/checker/home');
    }
}
