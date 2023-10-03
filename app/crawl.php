<?php
require_once '../vendor/autoload.php';

use App\Service\CrawlerService;

$url = request(["name"=>"url", 'method'=>'post', "message"=>"Please provide a URL to crawl"]);

$robot = request(["name"=>"robot", 'method'=>'post', "nullable"=>true]);

$js = request(["name"=>"js", 'method'=>'post', "nullable"=>true]);

$noFollow = request(["name"=>"no_follow", 'method'=>'post', "nullable"=>true]);

$limit = request(["name"=>"limit", 'method'=>'post', "message"=>"Please enter the limit of pages to crawl."]);

$userAgent = request(["name"=>"user_agent", 'method'=>'post', "nullable"=>true]);

$crawlProfile = request(["name"=>"crawl_type", 'method'=>'post', "message"=>"Please enter the type of crawling to be carried out."]);

$limit = (int)$limit > 0 ? $limit : 10;

$crawler = new CrawlerService($url);

if($robot){
    $crawler = $crawler->ignoreRobots();
}

if($crawlProfile){
    $crawler = $crawler->setCrawlProfile($crawlProfile);
}

if($js){
    $crawler = $crawler->executeJavascript();
}

if($noFollow){
    $crawler = $crawler->acceptNofollowLinks();
}

if($userAgent){
    $crawler = $crawler->setUserAgent($userAgent);
}

$response = $crawler->setCurrentCrawlLimit($limit)->crawl();

if($crawler->failed()){
    return response($crawler->failed(), 422);
}

// $result = [];

// foreach($response as $res=>$value){
//     $result [$res]= implode(', ', $value);
// }

return response($response);

?>