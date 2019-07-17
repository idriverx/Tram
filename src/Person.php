<?php


namespace App;

class Person
{
    /**
     * @var string
     */
    private $name;

    /**
     * Person constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param Tram $tram
     * @return bool
     */
    public function boardIntoTram(Tram $tram): bool
    {
        return $tram->addPassenger($this);
    }

    /**
     * @param Tram $tram
     * @return bool
     */
    public function wentFromTram(Tram $tram): bool
    {
        return $tram->removePassenger($this);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}