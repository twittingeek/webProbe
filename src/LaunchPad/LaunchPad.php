<?php

namespace webProbe\LaunchPad;

use webProbe\LaunchPad\Interfaces\LaunchPad as LaunchPadInterface;
use webProbe\Missions\Interfaces\Mission;

class LaunchPad implements LaunchPadInterface
{

    /** @var Mission */
    private $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function launch(): void
    {
        if ($this->verifyLaunchAuthorization()) {
            $this->getMission()->execute();
        }
    }

    public function getMission(): Mission
    {
        return $this->mission;
    }

    private function verifyLaunchAuthorization(): bool
    {
        //TODO check authorization to launch the mission
        // as first check we verify that the last execution was at least distant as
        // missionSetting->getExecutionFrequency
        $missionFrequencyAllowed = $this->getMission()->getSettings()->getExecutionFrequency();
        return true;
    }

}