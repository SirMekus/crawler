<?php
require_once '../vendor/autoload.php';
require_once '../env.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crawler</title>
    <link rel="stylesheet" href="<?php echo APP_URL."node_modules/bootstrap/dist/css/bootstrap.min.css"; ?> " />
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Web Crawler</h1>

                <form data-bc="myevent" id='form' action="<?php echo APP_URL."app/crawl.php"; ?>" 
                    method="post">
                    <div class="form-group mt-3">
                            <select class="form-select" name="url">
                                <option value="https://www.vetropack.com/en">VetroPack</option>
                                <option value="https://www.kniha-jizd-zdarma.cz/cs/">Kniha-Jizd</option>
                                <option value="https://www.logbookie.eu/cs/">Logbookie</option>
                                <option value="https://www.crm-zdarma.cz/cs/">CRM-zdarma</option>
                                <option value="https://www.cez.cz/cs/">CEZ</option>
                                <option value="https://igloonet.cz/">Igloonet</option>
                                <option value="https://portal.expanzo.com/">Expanzo</option>
                            </select>
                    </div>

                    <div class="form-group mt-3">
                        <div>
                            <div>
                                <input class="btn btn-primary btn-lg w-100" type="submit" value="Submit" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo APP_URL."node_modules/mmuo/dist/mmuo.umd.js"; ?>"></script>
    <script src="<?php echo APP_URL."node_modules/axios/dist/axios.js"; ?>"></script>
    <script src="<?php echo APP_URL."node_modules/bootstrap/dist/js/bootstrap.min.js"; ?>"></script>

    <script>
        window.addEventListener("DOMContentLoaded", function () {

            mmuo.registerEventListeners()

            document.addEventListener("myevent", (event) => {
                console.log("I'm listening on a custom event");
                console.log(event);
            });


        });
    </script>

</body>

</html>