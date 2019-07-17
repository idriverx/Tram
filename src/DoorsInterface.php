<?php

namespace App;

interface DoorsInterface
{
    public function open();

    public function close();

    public function isDoorsAreOpen();
}