<?php

$apiToken = '100af4e620024b40bbfc49214ea66509';

$replace = str_replace('Bearer ', '', $apiToken);
echo $replace;

if($apiToken == '20210002') {
    echo true;
} else {
    echo false;
}