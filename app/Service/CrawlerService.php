<?php
namespace App\Service;

require_once '../vendor/autoload.php';

use App\Service\Observer\Crawler as CustomCrawler;
use \Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlQueues\ArrayCrawlQueue;
use Spatie\Crawler\CrawlProfiles\CrawlSubdomains;
use Spatie\Crawler\CrawlProfiles\CrawlAllUrls;
use Spatie\Crawler\CrawlProfiles\CrawlInternalUrls;
use GuzzleHttp\RequestOptions;

class CrawlerService
{
    public $crawlerObserver;

    public $crawler;

    public $response;

    public function __construct(public String $url)
    {
        $this->crawlerObserver = new CustomCrawler();

        $this->crawler = Crawler::create([
            RequestOptions::COOKIES => true,
            //RequestOptions::CONNECT_TIMEOUT => 10,
            //RequestOptions::TIMEOUT => 50,
            RequestOptions::ALLOW_REDIRECTS => true,
        ])
                                ->setDefaultScheme('https')
                                ->setCrawlObserver($this->crawlerObserver);
    }



    public function acceptNofollowLinks():CrawlerService
    {
        $this->crawler->acceptNofollowLinks();

        return $this;
    }

    public function setConcurrency(Int $value=1):CrawlerService
    {
        $this->crawler->setConcurrency($value);

        return $this;
    }

    public function setTotalCrawlLimit(Int $value=10):CrawlerService
    {
        $this->crawler->setCrawlQueue((new ArrayCrawlQueue))->setTotalCrawlLimit($value);

        return $this;
    }

    public function setCurrentCrawlLimit(Int $value=10):CrawlerService
    {
        $this->crawler->setCrawlQueue((new ArrayCrawlQueue))->setCurrentCrawlLimit($value);

        return $this;
    }

    public function setCrawlProfile($profile=null):CrawlerService
    {
        $expressionResult = match ($profile) {
            'all' => (new CrawlAllUrls()),
            'internal' => (new CrawlInternalUrls($this->url)),
            'subdomain' => (new CrawlSubdomains($this->url)),
            default => (new CrawlSubdomains($this->url)),
        };

        $this->crawler->setCrawlProfile($expressionResult);

        return $this;
    }

    public function ignoreRobots():CrawlerService
    {
        $this->crawler->ignoreRobots();

        return $this;
    }

    public function executeJavascript():CrawlerService
    {
        $this->crawler->executeJavascript();

        return $this;
    }

    public function setUserAgent($userAgent):CrawlerService
    {
        $this->crawler->setUserAgent($userAgent);

        return $this;
    }

    public function crawl()
    {
        $this->crawler->startCrawling($this->url);

        return $this->crawlerObserver->response;
    }

    public function failed()
    {
        return $this->crawlerObserver->failed;
    }
}

?>