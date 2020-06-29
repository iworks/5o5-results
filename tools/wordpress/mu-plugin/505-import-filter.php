<?php

class iworks_5o5_upload_fixer {

	private $person_post_type_name = 'iworks_fleet_person';

	private $sailors = array(
		array(
			'Daisenberger'   => 'Micki Daisenberger',
			'Lautenschlager' => 'Florian Lautenschlager',
		),
		array(
			'Schomaker' => 'Meiki Schomaeker',
			'Gorge'     => 'Rainer Görge',
		),
		array(
			'Moore'   => 'Tyler Moore',
			'Falsone' => 'Jesse Falsone',
		),
		array(
			'Bixby'  => 'Ethan Bixby',
			'Boothe' => 'Erik Boothe',
		),
		array(
			'Key'     => 'Ramsay Key',
			'Buttner' => 'Andrew Buttner',
		),
		array(
			'Hyysalo' => 'Sampsa Hyysalo',
			'Salonen' => 'Antti Salonen',
		),
		array(
			'Walters' => 'Charles Walters',
			'Cram'    => 'Dougal Cram',
		),
		array(
			'Barry' => 'Ewen Barry',
			'Dwyer' => 'Charles Dwyer',
		),
		array(
			'Cuneo'  => 'Bill Cuneo',
			'Warlow' => 'John Warlow',
		),
		array(
			'Lott'   => 'Nigel Lott',
			'Franks' => 'Bob Franks',
		),
		array(
			'Scutcher'  => 'Terry Scutcher',
			'Diebitsch' => 'Christian Diebitsch',
		),
		array(
			'Napier'  => 'Rob Napier',
			'Pearson' => 'Malcolm \'Pip\' Pearson',
		),
		array(
			'Troch' => 'Michael Troch',
			'Konig' => 'Eckart Konig',
		),
		array(
			'Raita'   => 'Raimo Raita',
			'Nurmela' => 'Juha Nurmela',
		),
		array(
			'Lindfors' => 'Kaj Lindfors',
			'Halonen'  => 'Johan Halonen',
		),
		array(
			'Gambardella' => 'Marco Gambardella',
			'Candela'     => 'Roberto Candela',
		),
		array(
			'Berry'  => 'Jim Berry',
			'Barnes' => 'David Barnes',
		),
		array(
			'Robinson' => 'Jeffrey Robinson',
			'Penfold'  => 'Bryce Penfold',
		),
		array(
			'Lutz'      => 'Lutz Kandzia',
			'Deutscher' => 'Martin Deutscher',
		),
		array(
			'Wilts' => 'Enno Wilts',
			'Holm'  => 'Thorge Holm',
		),
		array(
			'Hansgen'  => 'Dirk Hänsgen',
			'Rupprich' => 'Frank Rupprich',
		),
		array(
			'Boeger' => 'Tim Böger',
			'Jess'   => 'Holger Jess',
		),
		array(
			'Hauschild' => 'Martha Hauschild',
			'Heyder'    => 'Michael Heyder',
		),
		array(
			'Rosen'  => 'Ebbe Rosén',
			'Wenrup' => 'Olle Wenrup',
		),
		array(
			'Voelckner'  => 'Nicolai Volckner',
			'Lars Dehne' => 'Lars Derschotte Dehne',
		),
		array(
			'Cox'  => 'Ryan Cox',
			'Park' => ' Stuart Park',
		),
		array(
			'Alexander' => 'Earle Alexander',
			'Gregg'     => 'Ian Gregg',
		),
		array(
			'Goult'   => 'Martin Goult',
			'Russell' => 'Gordon Russell',
		),
		/*
		array(
			'' => '',
			'' => '',
		),
		 */
	);


	private $person = array(
		'Andy Zinn'             => 'Andrew Zinn',
		'[AUS] Marcus Cooper'   => 'Marcus Cooper',
		'Christian Dechamplain' => 'Christian DeChamplain',
		'Dave Christie'         => 'David Christie',
		'Dave Eberhart'         => 'Dave Eberhardt',
		'Felix Brockerhoff'     => 'Felix Björn Brockerhoff',
		'Herve de Kergariou'    => 'Hervé de Kergariou',
		'Herve Dekegariou'      => 'Hervé de Kergariou',
		'Howie Hamlin'          => 'Howard Hamlin',
		'Jean -Baptiste Dupont' => 'Jean-Baptiste Dupont',
		'JeanLouis Guibbal'     => 'Jean-Louis Guibbal',
		'Jeff Robinson'         => 'Jeffrey Robinson',
		'JL Guibbal'            => 'Jean-Louis Guibbal',
		'Juergen Anton'         => 'Jürgen Anton',
		'Julian Stueckl'        => 'Julian Stückl',
		'Krister Bergstrom'     => 'Krister Bergström',
		'Lena Stueckl'          => 'Lena Stückl',
		'Malcom Higgins'        => 'Malcolm Higgins',
		'Matt Hansen'           => 'Matthew Hansen',
		'Matt Bristow'          => 'Matthew Bristow',
		'Meike Schomaeker'      => 'Meike Schomäker',
		'Meike Schomaker'       => 'Meike Schomäker',
		'Mick Babbage'          => 'Michael Babbage',
		'PA Hallberg'           => 'Per Anders Hallberg',
		'Paul Von Grey'         => 'Paul von Grey',
		'Paul VonGrey'          => 'Paul von Grey',
		'Pip Pearson'           => 'Malcolm \'Pip\' Pearson',
		'Sam (GA) Cronin'       => 'Sam Cronin',
		'Stu Park'              => 'Stuart Park',
		'Tom Bojland'           => 'Tom Bøjland',
		'Tom Gillard'           => 'Thomas Gillard',
		'Wolfgang Stuckl'       => 'Wolfgang Stückl',
		'Wolfgang Stueckl'      => 'Wolfgang Stückl',
		'Wolfgang Stuekl'       => 'Wolfgang Stückl',
		'Y. Pajot'              => 'Yves Pajot',
	);


	public function __construct() {
		add_filter( 'iworks_fleet_result_upload_helm', array( $this, 'helm' ), 10, 2 );
		add_filter( 'iworks_fleet_result_upload_crew', array( $this, 'crew' ), 10, 2 );
		add_filter( 'iworks_fleet_result_upload_helm', array( $this, 'person' ), 11, 1 );
		add_filter( 'iworks_fleet_result_upload_crew', array( $this, 'person' ), 11, 1 );
		add_filter( 'wp_insert_post_data', array( $this, 'person_before_insert' ), PHP_INT_MAX, 2 );
	}

	public function person_before_insert( $data, $post_array ) {
		if ( $this->person_post_type_name !== $data['post_type'] ) {
			return $data;
		}
		$data['post_title'] = $this->person( $data['post_title'] );
		return $data;
	}

	public function person( $person ) {
		if ( isset( $this->person[ $person ] ) ) {
			return $this->person[ $person ];
		}
		return $person;
	}

	public function helm( $helm, $crew ) {
		if ( $helm === $crew ) {
			return $helm;
		}
		foreach ( $this->sailors as $row ) {
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
		if ( $helm === $crew ) {
			return $helm;
		}
		foreach ( $this->sailors as $row ) {
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


