<?php
namespace webProbe\Missions;

use webProbe\Missions\Interfaces\MissionResult;
use webProbe\Missions\Settings\MissionSetting;
use webProbe\Probes\Interfaces\Probe;
use webProbe\Probes\ProbeResult;

class BitCoinPriceLowerThanMission extends BaseMission
{

    public function __construct(MissionSetting $missionSetting, Probe $probe)
    {
        parent::__construct($missionSetting, $probe);
    }

    public function execute(): MissionResult
    {
        $probeResult = $this->probe->run();
        if ($probeResult->statusCode !== ProbeResult::OK_STATUS_CODE) {
            //TODO log the failed execution
        }

        $payload = json_decode($probeResult->payload);
        $params = $this->getSettings()->getParams();
        if ($payload->currentPrice < $params['threshold']) {
            echo "OK! ".$payload->currentPrice." ".$params['threshold'];
        } else {
            echo "the price is to high! ".$payload->currentPrice." ".$params['threshold'];
        }

        return new MissionResult(); //TODO populate this
    }
}