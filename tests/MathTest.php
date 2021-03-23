<?php


class MathTest extends \PHPUnit\Framework\TestCase
{
    public function testSum()
    {
        $math = new \app\services\Math();
        $result = $math->summ(5, 7);
        $this->assertIsInt($result);
        $this->assertEquals(12, $result);
    }

}