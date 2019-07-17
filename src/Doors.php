<?php

namespace App;

class Doors implements DoorsInterface
{
    const DOORS_COUNT = 3;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var bool
     */
    private $doorsAreOpen = false;

    /**
     * Doors constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @throws \Exception
     */
    public function open()
    {
        if (!$this->isDoorsAreOpen()) {
            $this->doorsAreOpen = true;
            $this->logger->log("Doors are open");
            return true;
        } else {
            throw new \Exception("You can't open doors while doors are open.");
        }
    }

    /**
     * In tram we have only 3 doors usually. I think, it's not need to do array with "middle door", "front door" etc,
     * use number of doors instead.
     * @param int $numberDoorToOpen
     * @throws \Exception
     */
    public function openOnlyOneDoor(int $numberDoorToOpen)
    {
        if ($this->isDoorNumberCorrect($numberDoorToOpen) && !$this->isDoorsAreOpen()) {
            $this->doorsAreOpen = true;
            $this->logger->log("Door $numberDoorToOpen is open");
        } else {
            throw new \Exception("Tram contains only " . self::DOORS_COUNT . ' doors');
        }
    }

    /**
     * @param int $numberDoorToOpen
     * @throws \Exception
     */
    public function closeOnlyOneDoor(int $numberDoorToOpen)
    {
        if ($this->isDoorNumberCorrect($numberDoorToOpen) && $this->isDoorsAreOpen()) {
            $this->doorsAreOpen = false;
            $this->logger->log("Door $numberDoorToOpen is closed");
        } else {
            throw new \Exception("Tram contains only " . self::DOORS_COUNT . ' doors');
        }
    }

    /**
     * @throws \Exception
     */
    public function close()
    {
        if ($this->isDoorsAreOpen()) {
            $this->doorsAreOpen = false;
            $this->logger->log("Doors are closed");
        } else {
            throw new \Exception("You can't close doors while doors are close now");
        }
    }

    /**
     * @return bool
     */
    public function isDoorsAreOpen(): bool
    {
        return $this->doorsAreOpen;
    }

    /**
     * @param int $numberDoorToOpen
     * @return bool
     */
    private function isDoorNumberCorrect(int $numberDoorToOpen): bool
    {
        return $numberDoorToOpen > 0 && $numberDoorToOpen <= self::DOORS_COUNT;
    }
}