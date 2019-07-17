<?php

namespace App;

interface DoorsInterface
{
    public function open();

    public function close();

    public function isDoorsAreOpen();

    public function openOnlyOneDoor(int $numberDoorToOpen);

    public function closeOnlyOneDoor(int $numberDoorToOpen);
}