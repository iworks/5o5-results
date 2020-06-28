<?php

class iworks_5o5_upload_fixer{


    private $sailors = array(
        array(
            'Daisenberger' => 'Micki Daisenberger',
            'Lautenschlager' => 'Florian Lautenschlager',
        ),
        array(
            'Schomaker' =>'Meiki Schomaeker',
            'Gorge' => 'Rainer Görge',
        ),
        array(
            'Moore' => 'Tyler Moore',
            'Falsone' => 'Jesse Falsone',
        ),
        array(
            'Bixby' => 'Ethan Bixby',
            'Boothe' => 'Erik Boothe',
        ),
        array(
            'Key' => 'Ramsay Key',
            'Buttner' => 'Andrew Buttner',
        ),
        array(
            'Hyysalo' => 'Sampsa Hyysalo',
            'Salonen' => 'Antti Salonen',
        ),
        array(
            'Walters' => 'Charles Walters',
            'Cram' => 'Dougal Cram',
        ),
        array(
            'Barry' => 'Ewen Barry',
            'Dwyer' => 'Charles Dwyer',
        ),
        array(
            'Cuneo' => 'Bill Cuneo',
            'Warlow' => 'John Warlow',
        ),
        array(
            'Lott' => 'Nigel Lott',
            'Franks' => 'Bob Franks',
        ),
        array(
            'Scutcher' => 'Terry Scutcher',
            'Diebitsch' => 'Christian Diebitsch',
        ),
        array(
            'Napier' => 'Rob Napier',
            'Pearson' => 'Malcolm \'Pip\' Pearson',
        ),
        array(
            'Troch' => 'Michael Troch',
            'Konig' => 'Eckart Konig',
        ),
        array(
            'Raita' => 'Raimo Raita',
            'Nurmela' => 'Juha Nurmela',
        ),
        array(
            'Lindfors' => 'Kaj Lindfors',
            'Halonen' => 'Johan Halonen',
        ),
        array(
            'Gambardella' => 'Marco Gambardella',
            'Candela' => 'Roberto Candela',
        ),
        array(
            'Berry' => 'Jim Berry',
            'Barnes' => 'David Barnes',
        ),
        array(
            'Robinson' => 'Jeffrey Robinson',
            'Penfold' => 'Bryce Penfold',
        ),
        array(
            'Lutz' => 'Lutz Kandzia',
            'Deutscher' => 'Martin Deutscher',
        ),
        array(
            'Wilts' => 'Enno Wilts',
            'Holm' => 'Thorge Holm',
        ),
        array(
            'Hansgen' => 'Dirk Hänsgen',
            'Rupprich' => 'Frank Rupprich',
        ),
        /*
        array(
            '' => '',
            '' => '',
        ),
*/
    );


    private $person = array(
        'Howie Hamlin' => 'Howard Hamlin',
        'Paul Von Grey' => 'Paul von Grey',
        'Paul VonGrey' => 'Paul von Grey',
        'Matt Hansen' => 'Matthew Hansen',
        'Christian Dechamplain' => 'Christian DeChamplain',
        'Juergen Anton' => 'Jürgen Anton',
        'PA Hallberg' => 'Per Anders Hallberg',


    );


    public function __construct() {
        add_filter( 'iworks_fleet_result_upload_helm', array( $this, 'helm' ), 10, 2 );
        add_filter( 'iworks_fleet_result_upload_crew', array( $this, 'crew' ), 10, 2 );
        add_filter( 'iworks_fleet_result_upload_helm', array( $this, 'person' ), 11, 1 );
        add_filter( 'iworks_fleet_result_upload_crew', array( $this, 'person' ), 11, 1 );
    }

    public function person( $person ) {
        if ( isset( $this->person[ $person ] ) ) {
            return $this->person[ $person ];
        }
        return $person;
    } 

    public function helm( $helm, $crew ) {
        foreach( $this->sailors as $row ) {
            if ( isset( $row[ $helm ] ) ) {
                if ( isset( $row[ $crew ] ) ) {
                    return $row[ $helm ];
                }
                if ( in_array( $crew, $row ) ) {
                    return $row[ $helm ];
                }
            }
        }
        return $helm;
    }

    public function crew( $crew, $helm ) {
        foreach( $this->sailors as $row ) {
            if ( isset( $row[ $crew ] ) ) {
                if ( isset( $row[ $helm ] ) ) {
                    return $row[ $crew ];
                }
                if ( in_array( $helm, $row ) ) {
                    return $row[ $crew ];
                }
            }
        }
        return $crew;
    }

}

new iworks_5o5_upload_fixer;


