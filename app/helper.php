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
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
        $areaCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);

        $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
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