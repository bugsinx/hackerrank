<?php

/*
 * Complete the 'isBalanced' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts STRING s as parameter.
 */

function isBalanced($s) {
    // Write your code here
    
    $string_length=strlen($s); 
    
    if($string_length % 2 > 0) {
        return "NO"; //Has to be 2 multiple so everything it's properly closed
    }
    
    $string=str_split($s);
    
    $stack=array();
    
    foreach($string as $char) {
        if( in_array($char,["{","(","["]) ) {
            array_push($stack,$char);
        }
        else {
            if(empty($stack)) {
                return "NO";
            }
            $last_bracket = array_pop($stack);
            switch($last_bracket) {
                case "{":
                    if($char != "}") {
                        return "NO";
                    }
                break;
                case "[":
                    if($char != "]") {
                        return "NO";
                    }                
                break;
                case "(":
                    if($char != ")") {
                        return "NO";
                    }                
                break;                                
            }
        }
    }
    
    if(empty($stack)) {
        return "YES";
    }
    return "NO";
    

}

$fptr = fopen(getenv("OUTPUT_PATH"), "w");

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $s = rtrim(fgets(STDIN), "\r\n");

    $result = isBalanced($s);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
