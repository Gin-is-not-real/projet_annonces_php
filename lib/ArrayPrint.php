<?php
class ArrayPrint {
    public static function printArray($array) {
        foreach($array as $value) {
            var_dump($array . ': ' . $value . '</br>');
        }
    }
    public static function printMultiArray($array) {
        foreach($array as $subarray) {
            echo(array_search($subarray, $array) . '</br>');

            foreach($subarray as $value) {
                echo(array_search($value, $subarray) . ' : ' . $value . '</br>');
            }
        }
    }
}