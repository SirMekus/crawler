<?php

function rearrangeIndex(array &$array)
{
	$new_array = [];
	foreach($array as $element){
		$new_array []= $element;
	}
	$array = $new_array;
}

// Create a formatting function
function formatPhoneNumber($phoneNumber)
{
    $phoneNumber = preg_replace('/[^0-9]/','',$phoneNumber);

    if(strlen($phoneNumber) > 10) {
		if(strlen($phoneNumber) == 11 and str_starts_with($phoneNumber, '0')) {
			//do nothing as it is a Nigerian number likely
		}
		else{
			$countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);

            $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
		}
    }
    else if(strlen($phoneNumber) == 10) {
        $areaCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);

        $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    }
    else if(strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);

        $phoneNumber = $nextThree.'-'.$lastFour;
    }

    return $phoneNumber;
}

function extractEmail($string)
{
	preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
	return $matches[0][0];
}

function extractPhoneNumber($string): Array
{
	$keywords = preg_split("/[a-zA-Z,]+/", $string);

	return $keywords;
}

function getXpath(): Array
{
	return [
		'phone'=>[
            '//a[contains(@href, "tel:")]',
            '//a[contains(@text(), "Tel:")]',
            '//span[contains(@text(), "Tel:")]',
            '//span[contains(@text(), "tel:")]',
            '//p[contains(text(), "Tel:")]',
            '//p[contains(text(), "+")]',
            '//p[contains(text(), "Phone:")]',
            '//p[contains(text(), "Phone")]',
            '//li[contains(text(), "Telefon")]',
            '//li[contains(text(), "Telephone")]',
            '//p[contains(text(), "Telephone:")]',
            '//p[contains(text(), "Telephone")]',
        ],
		'email'=>[
            '//a[contains(@href, "mailto:")]',
            '//a[contains(text(), "@")]',
            '//p[contains(text(), "@")]',
            '//p[contains(text(), "Mail:")]',
            '//p[contains(text(), "Email")]',
            '//li[contains(text(), "Email:")]'
        ]
	];
}

function vite()
{
	$viteUrl = VITE_URL;

	if(APP_MODE != 'production')
	{
		echo <<<EOD
		<script type="module" src="{$viteUrl}@vite/client"></script>
        <script type="module" src="{$viteUrl}src/main.js"></script>
EOD;
	}
	else
	{
        $url = APP_URL;

		$src = rootDir()."/dist/manifest.json";
		
		if(file_exists($src))
		{
			$content = file_get_contents($src);
			
			if($content)
			{
				$manifest = json_decode($content, true);
			    $js = $manifest["src/main.js"]['file'];
			    $css = $manifest["src/main.css"]['file'];
	        }
		
		    echo <<<EOD
		    <link rel="stylesheet" href="{$url}dist/{$css}" />
		    <script type="module" src="{$url}dist/{$js}"></script>
EOD;
        }
    }
}

?>