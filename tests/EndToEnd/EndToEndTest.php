<?php

use PHPUnit\Framework\TestCase;
use twittingeek\webProbe\Probes\Helpers\ScraperHelper;
use twittingeek\webProbe\Probes\Libraries\DiscoveryLibrary;
use twittingeek\webProbe\Probes\Libraries\PriceDiscoveryLibrary;

class EndToEndTest extends TestCase
{
    const URL = 'https://ape.agenas.it/Tools/Eventi.aspx';


    public function testExecuteActions() {
        $pageIdentifier = 'ctl00$cphMain$DataPager1$ctl02$ctl00';
        $actions = [
            [
                'identifier' => '#cphMain_tbDataInizio',
                'action' => 'set',
                'value' => '01/01/2020',
                'repeat' => 1,
            ],
            [
                'identifier' => '#cphMain_tbDataFine',
                'action' => 'set',
                'value' => '10/01/2020',
                'repeat' => 1,
            ],
            [
                'identifier' => '#cphMain_btnCercaAvanzata',
                'action' => 'click',
                'value' => null,
                'repeat' => 1,
            ],
            [
                'identifier' => "input[name='".$pageIdentifier."']",
                'action' => 'click',
                'value' => null,
                'repeat' => 2,
            ],
        ];
        $page = ScraperHelper::loadPage(self::URL, json_encode($actions));
        $discoveryLibrary = new DiscoveryLibrary();
        $list = $discoveryLibrary->readBetween('class="lista"','<hr>', $page->getBody(), false, true);
        var_dump($list);
    }
}