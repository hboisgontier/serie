<?php

namespace App\Tests;

use App\Verif\TestChaine;
use PHPUnit\Framework\TestCase;

class TestChaineTest extends TestCase
{
    public function testVerifMotClef(): void
    {
        $testChaine = new TestChaine();
        $res = $testChaine->VerifMotClef('bonjour, je suis content, il fait beau !');
        $this->assertEmpty($res);
        $res = $testChaine->VerifMotClef('buy some vIaGrA!');
        $this->assertNotEmpty($res);
        $this->assertEquals('vIaGrA', $res[1]);
    }
}
