<?php

namespace App;

class Engine implements EngineInterface
{
    /**
     * @var bool
     */
    private $engineWorks = false;

    /**
     * @var LoggerInterface
     */
    private $logger;

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
    public function on()
    {
        if (!$this->isEngineWorks()) {
            $this->engineWorks = true;
            $this->logger->log("Engine is on");
            return true;
        } else {
            throw new \Exception("Engine now is on, you must disable it early than will start again");
        }
    }

    /**
     * @throws \Exception
     */
    public function off()
    {
        if ($this->isEngineWorks()) {
            $this->engineWorks = false;
            $this->logger->log("Engine of off");
        } else {
            throw new \Exception("Engine now is off, you must start it early than will disable it again");
        }
    }

    /**
     * @return bool
     */
    public function isEngineWorks(): bool
    {
        return $this->engineWorks;
    }
}