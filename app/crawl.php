<?php
require_once '../vendor/autoload.php';

use App\Service\CrawlerService;

$url = request(["name"=>"url", 'method'=>'post', "message"=>"Please provide a URL to crawl"]);

$robot = request(["name"=>"robot", 'method'=>'post', "nullable"=>true]);

$js = request(["name"=>"js", 'method'=>'post', "nullable"=>true]);

$noFollow = request(["name"=>"no_follow", 'method'=>'post', "nullable"=>true]);

$limit = request(["name"=>"limit", 'method'=>'post', "message"=>"Please enter the limit of pages to crawl."]);

$limit = (int)$limit > 0 ? $limit : 10;

$crawler = new CrawlerService($url);

if($robot){
    $crawler = $crawler->ignoreRobots();
}

if($js){
    $crawler = $crawler->executeJavascript();
}

if($noFollow){
    $crawler = $crawler->acceptNofollowLinks();
}

$response = $crawler->setCurrentCrawlLimit($limit)->setCrawlProfile()->crawl();

if($crawler->failed()){
    return response($crawler->failed(), 422);
}

return response([
    'emails'=>implode(', ', $response['emails']),
    'phones'=>implode(', ', $response['phones']),
]);

?>