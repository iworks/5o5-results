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
		array(
			'Boehm' => 'Stefan Böhm',
			'Roos'  => 'Gerald Roos',
		),
		array(
			'Tennant' => 'Bob Tennant',
			'Mundell' => 'Rich Mundel',
		),
		array(
			'Neidhart' => 'Elisabeth Neidhart',
			'Gougeon'  => 'Matthieu Gougeon',
		),
		array(
			'Schomäker' => 'Meike Schomäker',
			'Jess'      => 'Holger Jess',
		),
		array(
			'Fitzpatrick' => 'Annie Fitzpatrick',
			'Pittack'     => 'Christian Pittack',
		),
		array(
			'Van Deventer' => 'Bruce Van Deventer',
			'Henderson'    => 'Jon Henderson',
		),
		array(
			'Boite'     => 'Philippe Boite',
			'Grossmann' => 'Erwan Grossmann',
		),
		array(
			'Daisenberger' => 'Micky Daisenberger',
			'Bolduan'      => 'Tobias Bolduan',
		),
		array(
			'Kellner' => 'Christian Kellner',
			'Schöler' => 'Martin Schöler',
		),
		array(
			'Holzapfel' => 'Alexander Holzapfel',
			'Worm'      => 'Stefan Worm',
		),
		array(
			'Kwee'    => 'Steve Kwee',
			'Spötter' => 'Thorsten Spötter',
		),
		array(
			'Dechauffour' => 'Valentin Dechaffour',
			'Gendry'      => 'Pierre Gendry',
		),
		array(
			'Hyysalo' => 'Sampsa Hyysalo',
			'Kääpä'   => 'Lauri Kääpä',
		),
		array(
			'Higgins' => 'Sandy Higgins',
			'Marsh'   => 'Paul Marsh',
		),
		array(
			'Higgins'  => 'Malcolm Higgins',
			'Johnston' => 'Nick Johnston',
		),
		array(
			'Pinnell' => 'Ian Pinnell',
			'Shelton' => 'Dave Shelton',
		),
		array(
			'Ross'     => 'Aaron Ross',
			'Waterman' => 'Rob Waterman',
		),
		array(
			'Klaas'           => 'Kyle Klaas',
			'Von Gruenewaldt' => 'Robert von Gruenewaldt',
		),
		array(
			'Cronin'    => 'Sam Cronin',
			'Whitbread' => 'Kevin Whitbread',
		),
		array(
			'De Kergariou' => 'Hervé de Kergariou',
			'Gèron'        => 'Basile Géron',
		),
		array(
			'Johansson' => 'Johan Johansson',
			'Ekberg'    => 'Anders Ekberg',
		),
		array(
			'Schneidewind' => 'Ralf Schneidewind',
			'Schürmann'    => 'Oliver Schürmann',
		),
		array(
			'Nicholas' => 'Peter Nicholas',
			'Payne'    => 'Luke Payne',
		),
		array(
			'Bogacki' => 'Morten Bogacki',
			'Dehne'   => 'Lars Derschotte Dehne',
		),
		array(
			'Hamlin' => 'Howard Hamlin',
			'Zinn'   => 'Andy Zinn',
		),
		array(
			'Hamström' => 'Jari Hamström',
			'Laurila'  => 'Tuomas Laurila',
		),
		array(
			'Petermann' => 'Gilles Petermann',
			'Grob'      => 'Laurent Grob',
		),
		array(
			'Marti'   => 'Ueli Marti',
			'Schürch' => 'Res Schürch',
		),
		array(
			'Thornburrow' => 'Mark Thornburrow',
			'Mead'        => 'Laurence Mead',
		),
		array(
			'Bart'  => 'Bart Cédric',
			'Marti' => 'Marti Ueli',
		),
		array(
			'Bird'  => 'Tim Bird',
			'Nurse' => 'Richard Nurse',
		),
		array(
			'Lawner'     => 'Tord Lawner',
			'Gustavsson' => 'Tomas Gustavsson',
		),
		array(
			'Rasenack' => 'Bernd Rasenack',
			'Brückner' => 'Stefan Brückner',
		),
		array(
			'Gnadeberg' => 'Thure Gnadeberg',
			'Tellen'    => 'Aron Tellen',
		),
		/*
		array(
			'' => '',
			'' => '',
		),
		 */
	);


	private $person = array(
		'Owen Tudor'              => 'Tudor Owen',
		'Tom Bruton'              => 'Thomas Bruton',
		'Dougar Cram'             => 'Dougal Cram',
		'Charles Walter'          => 'Charles Walters',
		'Jan Siekierzynski'       => 'Jan Siekierzyński',
		'Anika Kebreau'           => 'Anika Kébreau',
		'Aaron Tellen'            => 'Aron Tellen',
		'Bussenius Roger'         => 'Roger Bussenius',
		'Bussenius Robert'        => 'Robert Bussenius',
		'Ute Stuempel'            => 'Ute Stümpel',
		'Karsten Stuempel'        => 'Karsten Stümpel',
		'Tomas Gustavsson'        => 'Tomas Gustafsson',
		'Birgitte Søgaard'        => 'Birgitte Søgård',
		'Ciferri Enrico'          => 'Enrico Ciferri',
		'Natali Gabriele'         => 'Gabriele Natali',
		'Michael van Wonterghem'  => 'Michael Wonterghem',
		'Fabiola van Wonterghem'  => 'Fabiola Wonterghem',
		'Nikolaj Buhl'            => 'Nikolaj Hoffmann Buhl',
		'Ueli Marti'              => 'Marti Ueli',
		'Oliver Schurmann'        => 'Oliver Schürmann',
		'Ralf Schneiderwind'      => 'Ralf Schneidewind',
		'Alain Karajian'          => 'Alain Karadjian',
		'Andy Zinn'               => 'Andrew Zinn',
		'[AUS] Marcus Cooper'     => 'Marcus Cooper',
		'Beier Frank'             => 'Frank Beier',
		'Ben Glass'               => 'Benjamin Glass',
		'Ben Illiffe'             => 'Ben Iliffe',
		'Bernadette Dekegariou'   => 'Bernadette de Kergariou',
		'Biederer Jens'           => 'Jens Biederer',
		'Boeger Finn'             => 'Finn Böger',
		'Bohm Stefan'             => 'Stefan Böhm',
		'Bourdon Stephen'         => 'Steve Bourdow',
		'Brad Clarke'             => 'Bradley Clarke',
		'Brockerhoff Felix'       => 'Felix Björn Brockerhoff',
		'Buhl Henrik'             => 'Henrik Buhl',
		'Burford Ian'             => 'Ian Burford',
		'Carl Smith'              => 'Carl Smit',
		'Carl Smith'              => 'Carl Smit',
		'Cedric Bart'             => 'Bart Cédric',
		'Charles Hanson'          => 'Charles Hansen',
		'Charlie Walters'         => 'Charles Walters',
		'Christian Dechamplain'   => 'Christian DeChamplain',
		'Christie David'          => 'David Christie',
		'Crazy John McLean'       => 'John Mclean',
		'Daniel Czeniga'          => 'Daniel Czeninga',
		'Dasenbrook Norbert'      => 'Norbert Dasenbrook',
		'Dave Christie'           => 'David Christie',
		'Dave Eberhart'           => 'Dave Eberhardt',
		'de Jamonieres'           => 'Nicolas des Jamonières',
		'Deb Ashby'               => 'Deborah Ashby',
		'Des Jamonieres'          => 'Nicolas des Jamonières',
		'Nicolas Des Jamonières'  => 'Nicolas des Jamonières',
		'Doug Hagan'              => 'Douglas Hagan',
		'Doug Watson'             => 'Douglas Watson',
		'Dunne Reeve'             => 'Reeve Dunn',
		'Felix Brockerhoff'       => 'Felix Björn Brockerhoff',
		'Finn Boeger'             => 'Finn Böger',
		'Finn Boger'              => 'Finn Böger',
		'Frank Bach'              => 'Frank Bach',
		'Friederichs Hartwig'     => 'Hartwig Friedrichs',
		'Garreth Williams'        => 'Gareth Williams',
		'Gil Donze'               => 'Gil Donzé',
		'Gillard Thomas'          => 'Thomas Gillard',
		'de Kergariou Anne Marie' => 'Anna Marie de Kergariou',
		'de Kergariou Guillaume'  => 'Guillaume de Kergariou',
		'James Spikesley'         => 'James Spikesly',
		'Guillaume De Kergariou'  => 'Guillaume de Kergariou',
		'Hamlin Howard'           => 'Howard Hamlin',
		'Hans Heinrich Rix'       => 'Hans-Heinrich Rix',
		'Hansen Matt'             => 'Matthew Hansen',
		'Hartwig Friedrichs'      => 'Hartwig Friedrichs',
		'Hauschild Anna'          => 'Anna Hauschild',
		'Heini Rix'               => 'Hans-Heinrich Rix',
		'de Kergariou Herve'      => 'Hervé de Kergariou',
		'Herve de Kergariou'      => 'Hervé de Kergariou',
		'Hervé De Kergariou'      => 'Hervé de Kergariou',
		'Herve Dekegariou'        => 'Hervé de Kergariou',
		'Higgins Malcolm'         => 'Malcolm Higgins',
		'Hodgson Martin'          => 'Martin Hodgson',
		'Hofmann Jan-Philipp'     => 'Jan-Philipp Hofmann',
		'Hofmann Nils Henning'    => 'Nils-Henning Hofmann',
		'Holt Mike'               => 'Mike Holt',
		'Holzapfel Alexander'     => 'Alexander Holzapfel',
		'Howie Hamlin'            => 'Howard Hamlin',
		'Hyde Richard'            => 'Richard Hyde',
		'Ian Mcgillivray'         => 'Ian Mc Gillivray',
		'James McGillivray'       => 'James Mc Gillivray',
		'Jan Saugmann DEN'        => 'Jan Saugmann',
		'Jan Sauqmann'            => 'Jan Saugmann',
		'Jan-Philipp Hofman'      => 'Jan-Philipp Hofmann',
		'Jean -Baptiste Dupont'   => 'Jean-Baptiste Dupont',
		'JeanLouis Guibbal'       => 'Jean-Louis Guibbal',
		'Jeff Robinson'           => 'Jeffrey Robinson',
		'Jim Mcgillivray'         => 'Jim Mc Gillivray',
		'JL Guibbal'              => 'Jean-Louis Guibbal',
		'John Mclean CRAZY*'      => 'John Mclean',
		'Johnson Nick'            => 'Nick Johnston',
		'Jorgen Bojsen-Møller'    => 'Jørgen Bojsen-Møller',
		'Juergen Anton'           => 'Jürgen Anton',
		'Julian Stueckl'          => 'Julian Stückl',
		'Kindermann Johannes'     => 'Johannes Kindermann',
		'Koechlin Stefan'         => 'Stefan Köchlin',
		'Krister Bergstrom'       => 'Krister Bergström',
		'Lena Stueckl'            => 'Lena Stückl',
		'Lenz Jan-Hendrik'        => 'Jan-Hendrik Lenz',
		'Lindsey Gilbert'         => 'Lindsay Gilbert',
		'Malcom Higgins'          => 'Malcolm Higgins',
		'Marcus Cooper AUS'       => 'Marcus Cooper',
		'Mark Upton Brown'        => 'Mark Upton-Brown',
		'Martin ten Hove'         => 'Martin Ten Hove',
		'Matt Bristow'            => 'Matthew Bristow',
		'Matt Hansen'             => 'Matthew Hansen',
		'Matt Hansen'             => 'Matthew Hansen',
		'Mattihieu Guibbal'       => 'Matthieu Guibbal',
		'Mcgillivray Ian'         => 'Ian Mc Gillivray',
		'Mcgillivray Jim'         => 'Jim Mc Gillivray',
		'Meier (SKBUe)'           => 'Sven Meier',
		'Meike Schomaeker'        => 'Meike Schomäker',
		'Micky Daisenberger'      => 'Micki Daisenberger',
		'Meike Schomaker'         => 'Meike Schomäker',
		'Menge Katharina'         => 'Katharina Menge',
		'Michal Olko'             => 'Michał Olko',
		'Mick Babbage'            => 'Michael Babbage',
		'Mike Priddle'            => 'Michael Priddle',
		'Miles Adrian'            => 'Adrian Miles',
		'Mittermayer Georg'       => 'Georg Mittermayer',
		'Nici Birkner'            => 'Nicola Birkner',
		'Nick Deussen'            => 'Nicholas Deussen',
		'Nikola Birkner'          => 'Nicola Birkner',
		'Nikos Desjamonieres'     => 'Nicolas des Jamonières',
		'PA Hallberg'             => 'Per-Anders Hallberg',
		'Parker Shinn'            => 'Parker Shin',
		'M Leask'                 => 'Magnus Leask',
		'Nicolai Volckner'        => 'Nicolai Völckner',
		'Lars Dehne'              => 'Lars Derschotte Dehne',
		'Toby Dale'               => 'Toby Barsley-Dale',
		'Kim13all Morrison'       => 'Kimball Morrison',
		'M Boiry'                 => 'Michel Boiry',
		'Giles Carvallo'          => 'Gilles Carvallo',
		'Carvallo Gilles'         => 'Gilles Carvallo',
		'Russ Shot'               => 'Russell Short',
		'Meiki Schomaeker'        => 'Meike Schomäker',
		'Pentti Matti'            => 'Matti Pentti',
		'Penntti Matti'           => 'Matti Pentti',
		'Rainer Goerge'           => 'Rainer Görge',
		'Carvalleo Samuel'        => 'Samuel Carvallo',
		'Rich Nurse'              => 'Richard Nurse',
		'Dave Smithwhite'         => 'David Smithwhite',
		'Christian Debitsch'      => 'Christian Diebitsch',
		'Terry Slutcher'          => 'Terry Scutcher',
		'A Williams'              => 'Andy Williams',
		'Dave Peacock'            => 'David Peacock',
		'StuartTurnbull'          => 'Stuart Turnbull',
		'Martin Gout'             => 'Martin Goult',
		'Martin Gouly'            => 'Martin Goult',
		'Paul Von Grey'           => 'Paul von Grey',
		'Paul VonGrey'            => 'Paul von Grey',
		'Penno Dirk'              => 'Dirk Penno',
		'Per Anders Hallberg'     => 'Per-Anders Hallberg',
		'Pip Pearson'             => 'Malcolm \'Pip\' Pearson',
		'Pleamann Ulf'            => 'Ulf Pleßmann',
		'Quirk Michael'           => 'Michael Quirk',
		'Rainer Gorge'            => 'Rainer Görge',
		'Rich Mundell'            => 'Rich Mundel',
		'Rix Hans-Heinrich'       => 'Hans-Heinrich Rix',
		'Roos Gerald'             => 'Gerald Roos',
		'Sam (GA) Cronin'         => 'Sam Cronin',
		'Schultz Hendrik'         => 'Hendrik Schultz',
		'Soren Overbeck'          => 'Søren Overbeck',
		'Stefan Boehm'            => 'Stefan Böhm',
		'Stefan Bohm'             => 'Stefan Böhm',
		'Stefan Kochlin'          => 'Stefan Köchlin',
		'Stefan Koechlin'         => 'Stefan Köchlin',
		'Stu Park'                => 'Stuart Park',
		'Stueckl Julian'          => 'Julian Stückl',
		'TBA'                     => '',
		'Tellen Johannes'         => 'Johannes Tellen',
		'Tennant Bob'             => 'Robert Tennant',
		'Thompson Craig'          => 'Craig Thompson',
		'Tim Bager'               => 'Tim Böger',
		'Tim Boeger'              => 'Tim Böger',
		'Tim Boger'               => 'Tim Böger',
		'Tom Bojland'             => 'Tom Bøjland',
		'Tom Gillard'             => 'Thomas Gillard',
		'Ulf Plessmann'           => 'Ulf Pleßmann',
		'Volker Goerge'           => 'Volker Görge',
		'Volker Gorge'            => 'Volker Görge',
		'Volker Niedek'           => 'Volker Niediek',
		'Von Grey'                => 'Paul von Grey',
		'Wolfgan Hunger'          => 'Wolfgang Hunger',
		'Wolfgang Dr Hunger'      => 'Wolfgang Hunger',
		'Wolfgang Stuckl'         => 'Wolfgang Stückl',
		'Wolfgang Stueckl'        => 'Wolfgang Stückl',
		'Wolfgang Stüeckl'        => 'Wolfgang Stückl',
		'Wolfgang Stuekl'         => 'Wolfgang Stückl',
		'Y. Pajot'                => 'Yves Pajot',
		'Zeiler Claudius'         => 'Claudius Zeiler',
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


