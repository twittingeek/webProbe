<?php


namespace webProbe\Probes;


use Exception;
use webProbe\Libraries\CanonicalDiscoveryLibrary;
use webProbe\Libraries\PictureDiscoveryLibrary;
use webProbe\Libraries\PriceDiscoveryLibrary;
use webProbe\Libraries\TitleDiscoveryLibrary;
use webProbe\Probes\Helpers\ScraperHelper;
use webProbe\Probes\Interfaces\Probe;
use webProbe\Probes\Settings\ProbeSetting;

class CleverWhateverProbe implements Probe
{

    /** @var ProbeSetting */
    private $probeSetting;

    public function __construct(ProbeSetting $probeSetting)
    {
        $this->probeSetting = $probeSetting;
    }

    public function run(): ProbeResult
    {
        $probeResult = new ProbeResult();
        try {
            $page = ScraperHelper::loadPage($this->probeSetting->getUrl());

            $payload = [
                'url' => $this->probeSetting->getUrl(),
                'canonical' => $this->getCanonical($page),
                'price' => $this->getPrice($page),
                'picture' => $this->getPicture($page),
                'title' => $this->getTitle($page)

            ];

            $probeResult->statusCode = ProbeResult::OK_STATUS_CODE;
            $probeResult->payload = json_encode($payload);
        } catch (Exception $exception) {
            $probeResult->statusCode = $exception->getCode();
            $probeResult->errorMessage = $exception->getMessage();
        }

        return $probeResult;
    }

    private function getPrice(string $page)
    {
        $priceDiscovery = new PriceDiscoveryLibrary($page);
        try {
            return $priceDiscovery->findPrice();
        } catch (Exception $exception) {
            throw $exception;
        }

    }

    private function getPicture(string $page)
    {
        $pictureDiscovery = new PictureDiscoveryLibrary($page);
        try {
            return $pictureDiscovery->findPicture();
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    private function getTitle(string $page)
    {
        $titleDiscovery = new TitleDiscoveryLibrary($page);
        try {
            return $titleDiscovery->findTitle();
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    private function getCanonical(string $page)
    {
        $canonicalDiscovery = new CanonicalDiscoveryLibrary($page);
        try {
            return $canonicalDiscovery->findCanonical();
        } catch (Exception $exception) {
            throw $exception;
        }

    }
}