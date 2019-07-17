<?php

namespace App;

interface LoggerInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function log(string $message);
}