<?php


class TramTest extends \PHPUnit\Framework\TestCase
{
    public function testCanSeatWhenMaximumCountPassenger()
    {
        $tram = $this->getDefaultObject();
        for ($i = 0; $i < $tram->getSeatsNumber(); $i++) {
            $person = new \App\Person(uniqid());
            $person->boardIntoTram($tram);
        }
        $lastPerson = new \App\Person('Vladimir D');
        $this->assertFalse($lastPerson->boardIntoTram($tram));
    }

    public function testCanGoToFourStop()
    {
        $tram = $this->getDefaultObject();
        for ($i = 0; $i <= \App\Tram::STOPS_COUNT; $i++) {
            $tram->goNextStop();
        }
        $this->assertFalse($tram->goNextStop());
    }

    public function testIsRightCountPassengers()
    {
        $tram = $this->getDefaultObject();
        $igorPassenger = new \App\Person("Igor");
        $alexandraPassenger = new \App\Person("Alexandra");
        $vasilisaPassenger = new \App\Person("Vasilisa");
        $igorPassenger->boardIntoTram($tram);
        $alexandraPassenger->boardIntoTram($tram);
        $vasilisaPassenger->boardIntoTram($tram);
        $igorPassenger->wentFromTram($tram);
        $this->assertEquals(2, $tram->getPeopleCount());
    }

    public function testIsRightCountStops()
    {
        $tram = $this->getDefaultObject();
        for ($i = 0; $i <= \App\Tram::STOPS_COUNT; $i++) {
            $tram->goNextStop();
        }
        $this->assertEquals(3, $tram->getStopNumber());
    }

    public function testCanWeGoIfDoorsAreOpen()
    {
        $tram = $this->getDefaultObject();
        $tram->getDoors()->open();
        $this->assertFalse($tram->goNextStop());
    }

    public function testIsCanRemoveNotExistPassenger()
    {
        $tram = $this->getDefaultObject();
        $person = new \App\Person("Dmitry D.");
        $this->assertFalse($tram->removePassenger($person));
    }

    public function testExceptionOnWrongRouteNumber()
    {
        $this->expectException(Exception::class);
        $logger = new \App\FileLogger();
        $tram = new \App\Tram(
            "Igor Volokitin",
            new \App\Engine($logger),
            new \App\Doors($logger),
            $logger,
            'AB234',
            50,
            'Not exist'
        );
    }

    private function getDefaultObject()
    {
        $logger = new \App\FileLogger();
        return new \App\Tram(
            "Igor Volokitin",
            new \App\Engine($logger),
            new \App\Doors($logger),
            $logger,
            'AB234',
            50,
            'D44'
        );
    }

}