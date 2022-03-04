<?php
/**
 * Php functions for secure inputs data.  
 * Before using $_POST or $_GET data, securize its values, for exemple on index:  
 * $_POST = valid_data_array($_POST);
*/

/**
 * Loop on the array passed in parameter, and foreach, secure value with securize_input().  
 * This function act also on array by recursivity 
 * @param {array} data to validate
 * @return array
 */
function valid_data_array($array) {
    $valided = $array;

    foreach ($valided as $key => $value) {
        $type = gettype($value);

        if($type === 'string') {
            $valided[$key] = securize_input($value);
        }
        elseif($type === 'array') {
            $valided[$key] = valid_data_array($value);
        }
    }

    return $valided;
}

/**
 * Securize the data passed on parameter with php functions stripslashes() and trim() and replace chars "<" and ">"
 * @param {string}
 * @return string
 */
function securize_input($input) {
    $sec_input = $input;

    $sec_input = trim($sec_input);
    $sec_input = stripslashes($sec_input);
    $sec_input = str_replace(['<', '>'], '%', $sec_input);

    return $sec_input;
}