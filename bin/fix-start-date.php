#!/usr/bin/php -d memory_limit=20480M
<?php

function d( $a ) {
    print_r($a);
}

$dates = array();

if ( ( $handle = fopen( './5o5.log' , 'r' ) ) !== false ) {
    while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
        $dates[$data[4]] = $data[5];
	}
}

$i = 0;
if ( ( $handle = fopen( './data/events-list.csv' , 'r' ) ) !== false ) {
    while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
        if ( empty( $data[0] ) ) {
            continue;
        }
        echo $data[13];
        echo ',';
        if ( empty( $data[17]) ) {
            if ( preg_match( '/([^\/]+)$/', $data[13], $matches) ) {
                if ( isset( $dates[$matches[1]] ) ) {
                    echo $dates[$matches[1]];
                }
            }

        } else {
            echo $data[17];
        }
        echo PHP_EOL;
        if ( 'exit' === $data[2]  ) {
            die;
        }
    }
}

