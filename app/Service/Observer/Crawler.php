<?php
namespace App\Service\Observer;

require_once '../vendor/autoload.php';

use \Spatie\Crawler\CrawlObservers\CrawlObserver;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use ValueError;
use App\Service\Extraction;

class Crawler extends CrawlObserver
{
    public $failed;

    public $response;

    public Array $emails = [];

    public Array $phones = [];
    /*
     * Called when the crawler will crawl the url.
     */
    public function willCrawl(UriInterface $url, ?string $linkText): void
    {

    }

    /*
     * Called when the crawler has crawled the given url successfully.
     */
    public function crawled(
        UriInterface $url,
        ResponseInterface $response,
        UriInterface $foundOnUrl = null,
        string $linkText = null,
    ): void
    {
        // echo 'Crawling URL: ' . urldecode($url) . ' ... ' . PHP_EOL;
        // echo 'Crawl result: ' . $response->getStatusCode() . ' - ' . $response->getReasonPhrase() . PHP_EOL;

        try
        {
            // Create a new DOMDocument
            $doc = new \DOMDocument();
            libxml_use_internal_errors(true); // Disable error reporting for malformed HTML
            $doc->loadHTML($response->getCachedBody());
            libxml_use_internal_errors(false);

            $extractor = new Extraction($doc);

            $extractor->extractEmail($this->emails);

            $extractor->extractPhone($this->phones);
        }
        catch(ValueError $error)
        {
            // $this->failed = [
            //     'status'=>false,
            //     'message'=>"There was a problem. Please try again.",
            //     'exception'=>$error->getMessage(),
            //     'url'=>urldecode($url),
            // ];
        }
    }

    /*
     * Called when the crawler had a problem crawling the given url.
     */
    public function crawlFailed(
        UriInterface $url,
        RequestException $requestException,
        ?UriInterface $foundOnUrl = null,
        ?string $linkText = null,
    ): void
    {
        $this->failed = [
            'status'=>false,
            'message'=>"Could not resolve URL. Please try again.",
            'exception'=>$requestException->getMessage(),
            'url'=>urldecode($url),
        ];
    }

    /**
     * Called when the crawl has ended.
     */
    public function finishedCrawling(): void
    {
        $emails = array_unique($this->emails);

        $phones = array_unique($this->phones);

        rearrangeIndex($emails);

        rearrangeIndex($phones);

        $this->response = [
            'emails'=>$emails,
            'phones'=>$phones,
        ];
    }
}

?>