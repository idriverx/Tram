<?php


class DoorsTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeDoorOpenedWhenNowIsOpen()
    {
        $doors = new \App\Doors(new \App\FileLogger());
        $doors->open();
        $this->expectException(Exception::class);
        $doors->open();
    }
}