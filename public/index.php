<?php
require_once '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crawler</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo APP_URL . "img/pineapple.jpg"; ?>">
    <meta name="description" content="An online tool to crawl and extract contact (phone number and email) information from a website.">
    <meta name="keywords" content="Crawler, contact, investigator, extract, tools, extraction, phone number, telephonem, email address">
    <?php
    vite()
    ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class='card'>
                    <div class='card-body'>
                        <h1 class="card-title text-center fw-bold text-underline">Site Crawler</h1>
                        <hr/>
                        <form data-bc="myevent" id='form' action="<?php echo APP_URL . "app/crawl.php"; ?>" method="post">
                            <div class="form-group mt-3 pre-filled">
                                <label>Websites</label>
                                <select class="form-select" name="url">
                                    <option value="https://www.vetropack.com/en/">VetroPack</option>
                                    <option value="https://www.kniha-jizd-zdarma.cz">Kniha-Jizd</option>
                                    <option value="https://www.logbookie.eu">Logbookie</option>
                                    <option value="https://www.crm-zdarma.cz/">CRM-Zdarma</option>
                                    <option value="https://www.cez.cz">CEZ</option>
                                    <option value="https://igloonet.cz">Igloonet</option>
                                    <option value="https://portal.expanzo.com">Expanzo</option>
                                    <option value="https://www.lipsum.com">Lipsum</option>
                                </select>
                            </div>
                            <div class="form-group mt-3 manual d-none">
                                <label>Specify The URL</label>
                                <input type="url" name='url' disabled value='https://' class="form-control input-lg" placeholder="Enter URL here" />
                            </div>

                            <div class="form-group mt-3">
                                <input id='other' class="form-check-input" type="checkbox" role="switch" />Other Site(s)
                            </div>
                            <hr />

                            <div class="form-group mt-3">
                                <label>Crawl Type</label>
                                <select class="form-select" name="crawl_type">
                                    <option value="all">Crawl All URls (including external sites)</option>
                                    <option value="internal">Crawl Internal Pages Only</option>
                                    <option selected value="subdomain">Crawl Sub-Domains And Internal Pages</option>
                                </select>
                            </div>

                            <div class="form-group mt-3">
                                <input name='robot' class="form-check-input" type="checkbox" role="switch" />Ignore Robot
                            </div>

                            <div class="form-group mt-3">
                                <input name='no_follow' class="form-check-input" type="checkbox" role="switch" />Accept No-follow links
                            </div>

                            <div class="form-group mt-3">
                                <label>Crawl Limit</label>
                                <input type="number" name='limit' min='1' value='10' class="form-control input-lg" />
                                <span class='text-muted'>The number of pages to crawl. For faster result, this should be kept reasonably low.</span>
                            </div>

                            <div class="form-group mt-3">
                                <label>User Agent</label>
                                <input type="text" name='user_agent' class="form-control input-lg" />
                                <span class='text-muted'>Some pages may forbid us from crawling. You can set a user agent to spoof instead.</span>
                            </div>

                            <div class="form-group mt-3">
                                <input class="btn btn-primary btn-lg w-100" type="submit" value="Let's Crawl" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>