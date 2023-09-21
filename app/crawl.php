<?php
require_once '../vendor/autoload.php';

use App\Service\CrawlerService;

$url = request(["name"=>"url", 'method'=>'post', "message"=>"Please provide a URL to crawl"]);

//dd($url);

$crawler = new CrawlerService();

$response = $crawler->crawl($url);

if($crawler->failed())
{
    return response("There was a problem crawling the URL. Please try again or make sure you are connected to the internet.", 422);
}

dd($response);


return response("Thank you for your time. We'll be in touch shortly.");
?>