<?php

namespace App;

class Tram
{
    const STOPS_COUNT       = 3;

    /**
     * @var string
     */
    private $licensePlate;

    /**
     * @var string
     */
    private $driver;

    /**
     * @var EngineInterface
     */
    private $engine;

    /**
     * @var DoorsInterface
     */
    private $doors;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var int
     */
    private $routeNumber;

    /**
     * @var int
     */
    private $stopNumber = 0;

    /**
     * @var array
     */
    private $passengers = [];

    /**
     * @var int
     */
    private $seatsNumber;

    /**
     * Tram constructor.
     * @param string $driverName
     * @param EngineInterface $engine
     * @param DoorsInterface $doors
     * @param LoggerInterface $logger
     * @param string $licensePlate
     * @param int $seatsNumber
     * @param string $routeNumber
     * @throws \Exception
     */
    public function __construct(
        string $driverName,
        EngineInterface $engine,
        DoorsInterface $doors,
        LoggerInterface $logger,
        string $licensePlate,
        int $seatsNumber,
        string $routeNumber
    ) {
        $this->checkThatExistsTramRouteNumber($routeNumber);
        $this->driver = $driverName;
        $this->engine = $engine;
        $this->doors  = $doors;
        $this->logger = $logger;
        $this->licensePlate = $licensePlate;
        $this->seatsNumber = $seatsNumber;
        $this->routeNumber = $routeNumber;
    }

    /**
     * @param string $routeNumber
     * @throws \Exception
     */
    public function checkThatExistsTramRouteNumber(string $routeNumber)
    {
        if (!array_key_exists($routeNumber, TrainRoutes::$trainNumberToRoutes)) {
            throw new \Exception("This route number doesn't exists");
        }
    }

    public function startEngine()
    {
        $this->engine->on();
    }

    public function stopEngine()
    {
        $this->engine->off();
    }

    /**
     * @return bool
     */
    public function goNextStop()
    {
        if ($this->stopNumber < self::STOPS_COUNT) {
            if (!$this->getDoors()->isDoorsAreOpen()) {
                $this->go();
                $this->stopNumber++;
                $this->logger->log(
                    "Now we arrived to " . TrainRoutes::$trainNumberToRoutes[$this->routeNumber][$this->stopNumber-1]
                    . ' stop'
                );
                return true;
            } else {
                $this->logger->log("Doors are open, we need to close to go");
                return false;
            }
        } else {
            $this->logger->log("We've arrived to ending station");
            return false;
        }
    }

    public function go()
    {
        $this->logger->log("Now we are going to next stop!");
    }

    /**
     * @return int
     */
    public function getStopNumber(): int
    {
        return $this->stopNumber;
    }

    /**
     * Passenger is went into tram
     * @param Person $person
     * @return bool
     */
    public function addPassenger(Person $person)
    {
        if ($this->getPeopleCount() < $this->seatsNumber) {
            $this->passengers[spl_object_hash($person)] = $person;
            $this->logger->log(
                "New passenger has came! " . $person->getName() . " | Now passengers: " . $this->getPeopleCount()
            );
            return true;
        } else {
            $this->logger->log("It looks like now there's not have any empty seats");
            return false;
        }
    }

    /**
     * @param Person $person
     * @return bool
     */
    public function removePassenger(Person $person)
    {
        if ($this->getPeopleCount() > 0) {
            if (!isset($this->passengers[spl_object_hash($person)])) {
                return false;
            }
            unset($this->passengers[spl_object_hash($person)]);
            $this->logger->log("Passenger has went from tram! Now passengers: " . $this->getPeopleCount());
            return true;
        } else {
            $this->logger->log("It looks like there is empty");
            return false;
        }
    }

    /**
     * @return int
     */
    public function getPeopleCount(): int
    {
        return count($this->passengers);
    }

    /**
     * @return DoorsInterface
     */
    public function getDoors(): DoorsInterface
    {
        return $this->doors;
    }

    /**
     * @return int
     */
    public function getSeatsNumber(): int
    {
        return $this->seatsNumber;
    }

}