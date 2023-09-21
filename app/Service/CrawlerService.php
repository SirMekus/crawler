<?php
namespace App\Service;

require_once '../vendor/autoload.php';

use App\Service\Observer\Crawler as CustomCrawler;
use \Spatie\Crawler\Crawler;

class CrawlerService
{
    public $crawler;

    public function __construct()
    {
        $this->crawler = new CustomCrawler();
    }

    public function crawl($url)
    {
        Crawler::create()
        ->setCrawlObserver($this->crawler)
        ->startCrawling($url);
    }

    public function failed()
    {
        return $this->crawler->failed ? true : false;
    }
}

?>