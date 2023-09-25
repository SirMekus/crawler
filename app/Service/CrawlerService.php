<?php
namespace App\Service;

require_once '../vendor/autoload.php';

use App\Service\Observer\Crawler as CustomCrawler;
use \Spatie\Crawler\Crawler;
use Spatie\Crawler\CrawlQueues\ArrayCrawlQueue;
use Spatie\Crawler\CrawlProfiles\CrawlSubdomains;
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
            RequestOptions::CONNECT_TIMEOUT => 10,
            RequestOptions::TIMEOUT => 30,
            RequestOptions::ALLOW_REDIRECTS => false,
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

    public function setCrawlProfile():CrawlerService
    {
        $this->crawler->setCrawlProfile((new CrawlSubdomains($this->url)));

        return $this;
    }

    public function ignoreRobots():CrawlerService
    {
        $this->crawler->ignoreRobots();

        return $this;
    }

    public function crawl()
    {
        $this->crawler
        // ->acceptNofollowLinks()
        // ->ignoreRobots()
        ->startCrawling($this->url);

        return $this->crawlerObserver->response;
    }

    public function failed()//:bool
    {
        return $this->crawlerObserver->failed;// ? true : false;
    }
}

?>