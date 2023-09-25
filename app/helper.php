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
function formatPhoneNumber($phone)
{
    $phone= "+".$phone;
    
    // Pass phone number in preg_match function
    if(preg_match(
        '/^\+[0-9]([0-9]{3})([0-9]{3})([0-9]{4})$/', 
    $phone, $value)) {
      
        // Store value in format variable
        $format = $value[1] . '-' . 
            $value[2] . '-' . $value[3];
    }
    else {
         
        // If given number is invalid
        echo "Invalid phone number <br>";
        echo $phone;
    }
      
    // Print the given format
    echo("$format" . "<br>");
}



?>