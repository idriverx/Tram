<?php


class EngineTest extends \PHPUnit\Framework\TestCase
{
    public function testIsCanEnableWhenDisabled()
    {
        $engine = new \App\Engine(new \App\FileLogger());
        $this->assertTrue($engine->on());
    }

    public function testIsEnabled()
    {
        $engine = new \App\Engine(new \App\FileLogger());
        $engine->on();
        $this->assertTrue($engine->isEngineWorks());
    }
}