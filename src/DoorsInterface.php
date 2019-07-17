<?php

namespace App;

interface DoorsInterface
{
    const FRONT_DOOR    = 1;
    const MIDDLE_DOOR   = 2;
    const BACK_DOOR     = 3;

    public function open();

    public function close();

    public function isDoorsAreOpen();

    public function openOnlyOneDoor(int $numberDoorToOpen);

    public function closeOnlyOneDoor(int $numberDoorToOpen);
}