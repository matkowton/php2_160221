<?php


class ProductTest extends \PHPUnit\Framework\TestCase
{
    public function testPrice()
    {
        $mock = $this->getMockBuilder(\app\models\Discount::class)
            ->setMethods(['getDiscount'])
            ->getMock();

        $mock->expects($this->any())
            ->method('getDiscount')
            ->will($this->returnValue(100));

        $product = new \app\models\records\Product($mock);
        $product->price = 500;
        $this->assertEquals(400, $product->getPrice());
    }
}