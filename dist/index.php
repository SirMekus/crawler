<?php
require_once '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Crawler</title>
    <!-- <link rel="stylesheet" href="<?php echo APP_URL."node_modules/bootstrap/dist/css/bootstrap.min.css"; ?> " /> -->
    <?php
    vite()
    ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Web Crawler</h1>

                <form data-bc="myevent" id='form' action="<?php echo APP_URL."app/crawl.php"; ?>" 
                    method="post">
                    <div class="form-group mt-3 pre-filled">
                            <select class="form-select" name="url">
                                <option value="https://www.vetropack.com/en/">VetroPack</option>
                                <option value="https://www.kniha-jizd-zdarma.cz">Kniha-Jizd</option>
                                <option value="https://www.logbookie.eu">Logbookie</option>
                                <option value="https://www.crm-zdarma.cz/">CRM-zdarma</option>
                                <option value="https://www.cez.cz">CEZ</option>
                                <option value="https://igloonet.cz">Igloonet</option>
                                <option value="https://portal.expanzo.com">Expanzo</option>
                                <option value="https://www.i-runs.com">i-runs</option>
                            </select>
                    </div>
                    <div class="form-group mt-3 manual d-none">
                        <input type="url" name='url' disabled value='https://' class="form-control input-lg" placeholder="Enter URL here" />
                    </div>

                    <div class="form-group mt-3">
                        <input id='other' class="form-check-input checker" type="checkbox" role="switch" />Other
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

    <!-- <script src="<?php echo APP_URL."node_modules/mmuo/dist/mmuo.umd.js"; ?>"></script>
    <script src="<?php echo APP_URL."node_modules/axios/dist/axios.js"; ?>"></script>
    <script src="<?php echo APP_URL."node_modules/bootstrap/dist/js/bootstrap.min.js"; ?>"></script>

    <script>
        window.addEventListener("DOMContentLoaded", function () {

            mmuo.registerEventListeners()

            mmuo.on('#other', 'click', function(event){
                const checked = event.target.checked;

                const manual = document.querySelector(".manual");

                const pre_filled = document.querySelector(".pre-filled");

                manual.classList.toggle('d-none');

                pre_filled.classList.toggle('d-none');

                if(checked){
                    pre_filled.children[0].setAttribute('disabled', 'disabled');
                    manual.children[0].removeAttribute('disabled');
                }
                else{
                    manual.children[0].setAttribute('disabled', 'disabled');
                    pre_filled.children[0].removeAttribute('disabled');
                }
            })

            document.addEventListener("myevent", (event) => {
                const data = event.detail.data.message;

                setTimeout(function(){
                    const box = document.querySelector(".success")

                    box.replaceChildren();

                    let emailParagraph = document.createElement("p");
                    emailParagraph.classList.add('text-success');
                    emailParagraph.classList.add('fw-bold');
                    emailParagraph.innerHTML = `Emails Found: ${data?.emails}`
                    box.appendChild(emailParagraph);

                    let phoneParagraph = document.createElement("p");
                    phoneParagraph.classList.add('text-success');
                    phoneParagraph.classList.add('fw-bold');
                    phoneParagraph.innerHTML = `Phone Numbers Found: ${data?.phones}`
                    box.appendChild(phoneParagraph);
                }, 1000);
            });
        });
    </script> -->

</body>

</html>