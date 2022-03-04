<?php
/**
 * Php functions for securize inputs data.  
 * Before using $_POST or $_GET data, securize its values 
*/

/**
 * These loop on the array in parameter, and foreach, call validations functions like value valid_security() and securize_input()
 * @param {array} data to validate
 * @return array
 */
function valid_data_array($array) {
    $valided = $array;

    foreach ($valided as $key => $value) {
        $valided[$key] = securize_input($value);
    }

    return $valided;
}


/**
 * Securize the data passed on parameter with php basic functions like htmlspecialchars(), stripslashes() and trim()
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


/**
 * Loop on an array of forbiddens expressions, like html tags <script> or <form>. If value contains one of these, return false.
 * @param {string} The data to test
 * @return bool
 */
function valid_content($value) {
    $forbiddens = ['<script', '<form', '<submit'];

    foreach ($forbiddens as $key => $pattern) {
        if(str_contains($value, $pattern)) {
            return false;
        }
        return true;
    }
}