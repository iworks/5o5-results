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
			'Rosén'  => 'Ebbe Rosén',
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
		array(
			'Nieminen' => 'Jukka Nieminen',
			'Salonen'  => 'Antti Salonen',
		),
		array(
			'Anton'   => 'Jürgen Anton',
			'Denecke' => 'Ulf Denecke',
		),
		array(
			'Hofmann'     => 'Jan-Philipp Hofmann',
			'Brockerhoff' => 'Felix Björn Brockerhoff',
		),
		array(
			'Lankenau' => 'Lars Lankenau',
			'Schipler' => 'Anna Dorothea Schipler',
		),
		array(
			'Lehmann' => 'Claas Lehmann',
			'Oehme'   => 'Leon Oehme',
		),
		array(
			'Schweiger' => 'Stephan Schweiger',
			'Koch'      => 'Thorsten Koch',
		),
		array(
			'Conrads' => 'Edward Conrads',
			'Haines'  => 'Brian Haines',
		),
		array(
			'Barry'   => 'Matthew Barry',
			'Barrows' => 'Thomas Barrows',
		),
		array(
			'Schlomka'  => 'Jans-Peter Schlomka',
			'Wihlfahrt' => 'Urs Wihlfahrt',
		),
		array(
			'Achterberg' => 'Frieder Achterberg',
			'Stückl'     => 'Wolfgang Stückl',
		),
		array(
			'Largier'       => 'James Largier',
			'Hutton-Squire' => 'Richard Hutton-Squire',
		),
		array(
			'Czeninga' => 'Daniel Czeninga',
			'Lietz'    => 'Martin Lietz',
		),
		array(
			'Sell'   => 'Jan Sell',
			'Gewinn' => 'Wiebke Gewinn',
		),
		array(
			'Birkner' => 'Nicola Birkner',
			'Stenger' => 'Angela Stenger',
		),
		array(
			'Böhm' => 'Stefan Böhm',
			'Roos' => 'Gerald Roos',
		),
		array(
			'Giesler' => 'Stefan Giesler',
			'Böhm'    => 'Frank Böhm',
		),
		array(
			'Pleßmann' => 'Ulf Pleßmann',
			'Rix'      => 'Hans-Heinrich Rix',
		),
		array(
			'Hodgson' => 'Martin Hodgson',
			'Miles'   => 'Adrian Miles',
		),
		array(
			'Schultz'    => 'Hendrik Schultz',
			'Oberländer' => 'Ute Oberländer',
		),
		array(
			'Dasenbrook' => 'Norbert Dasenbrook',
			'Meier'      => 'Sven Meier',
		),
		array(
			'Utiger' => 'Toni Utiger',
			'Heilig' => 'Markus Heilig',
		),
		array(
			'Mittermayer' => 'Georg Mittermayer',
			'Barteldt'    => 'Dirk Barteldt',
		),
		array(
			'Hunger'  => 'Wolfgang Hunger',
			'Kleiner' => 'Julien Kleiner',
		),
		array(
			'Hunger' => 'Wolfgang Hunger',
			'Jess'   => 'Holger Jess',
		),
		array(
			'Houriet' => 'Catherine Houriet',
			'Donzé'   => 'Gil Donzé',
		),
		array(
			'Houriet' => 'Catherine Houriet',
			'Donze'   => 'Gil Donzé',
		),
		/*
		array(
			'' => '',
			'' => '',
		),
		 */
	);


	private $person = array(
		'Charles Hanson'         => 'Charles Hansen',
		'Beier Frank'            => 'Frank Beier',
		'Gil Donze'              => 'Gil Donzé',
		'Menge Katharina'        => 'Katharina Menge',
		'Hauschild Anna'         => 'Anna Hauschild',
		'Hyde Richard'           => 'Richard Hyde',
		'Mittermayer Georg'      => 'Georg Mittermayer',
		'Biederer Jens'          => 'Jens Biederer',
		'Kindermann Johannes'    => 'Johannes Kindermann',
		'Burford Ian'            => 'Ian Burford',
		'Christie David'         => 'David Christie',
		'Meier (SKBUe)'          => 'Sven Meier',
		'Dasenbrook Norbert'     => 'Norbert Dasenbrook',
		'Nici Birkner'           => 'Nicola Birkner',
		'Hansen Matt'            => 'Matthew Hansen',
		'John Mclean CRAZY*'     => 'John Mclean',
		'Hofmann Nils Henning'   => 'Nils-Henning Hofmann',
		'Zeiler Claudius'        => 'Claudius Zeiler',
		'Schultz Hendrik'        => 'Hendrik Schultz',
		'Lenz Jan-Hendrik'       => 'Jan-Hendrik Lenz',
		'Penno Dirk'             => 'Dirk Penno',
		'Hodgson Martin'         => 'Martin Hodgson',
		'Miles Adrian'           => 'Adrian Miles',
		'Buhl Henrik'            => 'Henrik Buhl',
		'Thompson Craig'         => 'Craig Thompson',
		'Gillard Thomas'         => 'Thomas Gillard',
		'Pleamann Ulf'           => 'Ulf Pleßmann',
		'Rix Hans-Heinrich'      => 'Hans-Heinrich Rix',
		'Andy Zinn'              => 'Andrew Zinn',
		'[AUS] Marcus Cooper'    => 'Marcus Cooper',
		'Christian Dechamplain'  => 'Christian DeChamplain',
		'Dave Christie'          => 'David Christie',
		'Dave Eberhart'          => 'Dave Eberhardt',
		'Felix Brockerhoff'      => 'Felix Björn Brockerhoff',
		'Herve de Kergariou'     => 'Hervé de Kergariou',
		'Herve Dekegariou'       => 'Hervé de Kergariou',
		'Howie Hamlin'           => 'Howard Hamlin',
		'Jean -Baptiste Dupont'  => 'Jean-Baptiste Dupont',
		'JeanLouis Guibbal'      => 'Jean-Louis Guibbal',
		'Jeff Robinson'          => 'Jeffrey Robinson',
		'JL Guibbal'             => 'Jean-Louis Guibbal',
		'Juergen Anton'          => 'Jürgen Anton',
		'Julian Stueckl'         => 'Julian Stückl',
		'Krister Bergstrom'      => 'Krister Bergström',
		'Lena Stueckl'           => 'Lena Stückl',
		'Malcom Higgins'         => 'Malcolm Higgins',
		'Matt Hansen'            => 'Matthew Hansen',
		'Matt Bristow'           => 'Matthew Bristow',
		'Meike Schomaeker'       => 'Meike Schomäker',
		'Meike Schomaker'        => 'Meike Schomäker',
		'Mick Babbage'           => 'Michael Babbage',
		'PA Hallberg'            => 'Per Anders Hallberg',
		'Paul Von Grey'          => 'Paul von Grey',
		'Paul VonGrey'           => 'Paul von Grey',
		'Pip Pearson'            => 'Malcolm \'Pip\' Pearson',
		'Sam (GA) Cronin'        => 'Sam Cronin',
		'Stu Park'               => 'Stuart Park',
		'Tom Bojland'            => 'Tom Bøjland',
		'Tom Gillard'            => 'Thomas Gillard',
		'Wolfgang Stuckl'        => 'Wolfgang Stückl',
		'Wolfgang Stueckl'       => 'Wolfgang Stückl',
		'Wolfgang Stuekl'        => 'Wolfgang Stückl',
		'Y. Pajot'               => 'Yves Pajot',
		'Mark Upton Brown'       => 'Mark Upton-Brown',
		'Doug Hagan'             => 'Douglas Hagan',
		'Stefan Bohm'            => 'Stefan Böhm',
		'Stefan Boehm'           => 'Stefan Böhm',
		'Charlie Walters'        => 'Charles Walters',
		'Parker Shinn'           => 'Parker Shin',
		'Garreth Williams'       => 'Gareth Williams',
		'Nick Deussen'           => 'Nicholas Deussen',
		'Volker Goerge'          => 'Volker Görge',
		'Friederichs Hartwig'    => 'Hartwig Friedrichs',
		'Matt Hansen'            => 'Matthew Hansen',
		'Stefan Koechlin'        => 'Stefan Köchlin',
		'Wolfgang Dr Hunger'     => 'Wolfgang Hunger',
		'Hans Heinrich Rix'      => 'Hans-Heinrich Rix',
		'Ulf Plessmann'          => 'Ulf Pleßmann',
		'Finn Boeger'            => 'Finn Böger',
		'Ian Mcgillivray'        => 'Ian Mc Gillivray',
		'Jim Mcgillivray'        => 'Jim Mc Gillivray',
		'Mattihieu Guibbal'      => 'Matthieu Guibbal',
		'Jan-Philipp Hofman'     => 'Jan-Philipp Hofmann',
		'Per-Anders Hallberg'    => 'Per Anders Hallberg',
		'Heini Rix'              => 'Hans-Heinrich Rix',
		'Hervé De Kergariou'     => 'Hervé de Kergariou',
		'Guillaume De Kergariou' => 'Guillaume de Kergariou',
		'Jan Sauqmann'           => 'Jan Saugmann',
		'Wolfgang Stüeckl'       => 'Wolfgang Stückl',
		'Jorgen Bojsen-Møller'   => 'Jørgen Bojsen-Møller',
		'Rainer Gorge'           => 'Rainer Görge',
		'Volker Gorge'           => 'Volker Görge',
		'Ben Illiffe'            => 'Ben Iliffe',
		'Daniel Czeniga'         => 'Daniel Czeninga',
		'Nikola Birkner'         => 'Nicola Birkner',
		'Martin ten Hove'        => 'Martin Ten Hove',
		'Deb Ashby'              => 'Deborah Ashby',
		'Holt Mike'              => 'Mike Holt',
		'Carl Smith'             => 'Carl Smit',
		'Carl Smith'             => 'Carl Smit',
		'Higgins Malcolm'        => 'Malcolm Higgins',
		'Johnson Nick'           => 'Nick Johnston',
		'Tennant Bob'            => 'Robert Tennant',
		'Bourdon Stephen'        => 'Steve Bourdow',
		'Koechlin Stefan'        => 'Stefan Köchlin',
		'Stueckl Julian'         => 'Julian Stückl',
		'Tellen Johannes'        => 'Johannes Tellen',
		'Bohm Stefan'            => 'Stefan Böhm',
		'Roos Gerald'            => 'Gerald Roos',
		'Hofmann Jan-Philipp'    => 'Jan-Philipp Hofmann',
		'Brockerhoff Felix'      => 'Felix Björn Brockerhoff',
		'Quirk Michael'          => 'Michael Quirk',
		'Dunne Reeve'            => 'Reeve Dunn',
		'Holzapfel Alexander'    => 'Alexander Holzapfel',
		'Boeger Finn'            => 'Finn Böger',
		'Tim Boger'              => 'Tim Böger',
		'Finn Boger'             => 'Finn Böger',

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


