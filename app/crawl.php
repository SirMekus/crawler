<?php
require_once '../vendor/autoload.php';

use App\Service\CrawlerService;

$url = request([
    "name"=>"url", 
    'method'=>'post', 
    "message"=>"Please provide a URL to crawl"
]);

//$url = 'https://www.lipsum.com';

$crawler = new CrawlerService($url);

$response = $crawler->setCurrentCrawlLimit()
                    ->acceptNofollowLinks()
                    ->ignoreRobots()
                    ->setCrawlProfile()
                    ->crawl();

//Created class and front-end to deal with receiving input and instantiating our crawler service
if($crawler->failed())
{
    // return response("There was a problem crawling the URL. Please try again or make sure you are connected to the internet.", 422);
    return response($crawler->failed(), 422);
}

// dd(implode(', ', $response['emails']));
//dd($response);

return response([
    'emails'=>implode(', ', $response['emails']),
    'phones'=>implode(', ', $response['phones']),
]);

?>