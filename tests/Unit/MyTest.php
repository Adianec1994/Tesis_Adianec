<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Traits\MakeBateriasTrait;
use Tests\ApiTestTrait;

class MyTest extends TestCase
{
    use MakeBateriasTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /*Test create baterias*/
    public function test_create_baterias()
    {
        $baterias = $this->fakeBateriasData();
        $this->response = $this->json('POST', '/api/baterias', $baterias);

        $this->assertApiResponse($baterias);
    }

    /*Test calculo potencia instalada*/
    /*public function testCalcularPotencia ()
    {
        $number1 = 0.788;
        $number2 = 0.88;
        $number3 = 0.75;

        $suma =new Sum();
        $result = $suma->execute ($number1, $number2, $number3);

        $this->assertEquals (2.418, $result);
    }*/

}
