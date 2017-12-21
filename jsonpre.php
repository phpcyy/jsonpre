#!/usr/bin/env php
<?php
if(ftell(STDIN) === 0){
    $input = stream_get_contents(STDIN);
    $input = json_decode($input);
    if (json_last_error() > 0){
        echo "input is not a valid json. ";
    } else {
        echo json_encode($input,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}else{
    $argv = array_slice($argv, 1);
    if (empty($argv)) {
        echo 
"Usage: 
    jsonpre [files...]

Example:
    jsonpre config.json
    echo '{\"message\": \"Hello, 世界\"}' | jsonpre";
    }
    foreach($argv as $filename){
        if (!file_exists($filename)) {
            echo $filename, " doesn't exist" . PHP_EOL;
        }else {
            $input = file_get_contents($filename);
            $input = json_decode($input);
            if (json_last_error() > 0){
                echo "file {$filename} is not a valid json. " . PHP_EOL;
            } else {
                echo json_encode($input,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            }
        }
    }
}
