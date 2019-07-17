<?php

require_once __DIR__ . '/vendor/autoload.php';

const SEATS_NUMBER = 50;

$logger = new \App\FileLogger();
$doors = new \App\Doors($logger);
$engine = new \App\Engine($logger);
$tram = new \App\Tram(
    "Igor Volokitin",
    $engine,
    $doors,
    $logger,
    "BN2991UA",
    SEATS_NUMBER,
    "D44"
);
$tram->startEngine();
$tram->getDoors()->open();
$alexandraPassenger = new \App\Person("Alexandra R.");
$valeriyaPassenger = new \App\Person("Valeriya D.");
$alexandraPassenger->boardIntoTram($tram);
$valeriyaPassenger->boardIntoTram($tram);
$tram->getDoors()->close();
$tram->goNextStop();
$tram->getDoors()->openOnlyOneDoor(2);
$alexandraPassenger->wentFromTram($tram);
$tram->getDoors()->close();
$tram->goNextStop();
$tram->getDoors()->open();
$denisPassenger = new \App\Person("Denis D.");
$tram->getDoors()->close();
$tram->goNextStop();
$tram->getDoors()->open();
$denisPassenger->wentFromTram($tram);
$valeriyaPassenger->wentFromTram($tram);
$tram->getDoors()->close();
$tram->stopEngine();
