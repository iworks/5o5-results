<?php

class iworks_5o5_upload_fixer {

	private $person_post_type_name = 'iworks_fleet_person';

	private $sailors = array(
		array(
			'Achterberg' => 'Frieder Achterberg',
			'Stückl'     => 'Wolfgang Stückl',
		),
		array(
			'Achterberg' => 'Frieder Achterberg',
			'Stueckl'    => 'Wolfgang Stückl',
		),
		array(
			'Alexander' => 'Earle Alexander',
			'Gregg'     => 'Ian Gregg',
		),
		array(
			'Amthor' => 'Henry Amthor',
			'Roney'  => 'Dustin Romey',
		),
		array(
			'Andersson'  => 'Peter Andersson',
			'Thörnström' => 'Per-Eric Thörnström',
		),
		array(
			'Anton'   => 'Jürgen Anton',
			'Denecke' => 'Ulf Denecke',
		),
		array(
			'Barry' => 'Ewen Barry',
			'Dwyer' => 'Charles Dwyer',
		),
		array(
			'Barry'   => 'Matthew Barry',
			'Barrows' => 'Thomas Barrows',
		),
		array(
			'Bart'  => 'Bart Cédric',
			'Marti' => 'Marti Ueli',
		),
		array(
			'Berry'  => 'Jim Berry',
			'Barnes' => 'David Barnes',
		),
		array(
			'Bird'  => 'Tim Bird',
			'Nurse' => 'Richard Nurse',
		),
		array(
			'Birkner' => 'Nicola Birkner',
			'Stenger' => 'Angela Stenger',
		),
		array(
			'Bixby'  => 'Ethan Bixby',
			'Boothe' => 'Erik Boothe',
		),
		array(
			'Boeger' => 'Tim Böger',
			'Jess'   => 'Holger Jess',
		),
		array(
			'Boehm' => 'Stefan Böhm',
			'Roos'  => 'Gerald Roos',
		),
		array(
			'Bogacki' => 'Morten Bogacki',
			'Dehne'   => 'Lars Derschotte Dehne',
		),
		array(
			'Böhm' => 'Stefan Böhm',
			'Roos' => 'Gerald Roos',
		),
		array(
			'Boite'     => 'Philippe Boite',
			'Grossmann' => 'Erwan Grossmann',
		),
		array(
			'Conrads' => 'Edward Conrads',
			'Haines'  => 'Brian Haines',
		),
		array(
			'Cox'  => 'Ryan Cox',
			'Park' => ' Stuart Park',
		),
		array(
			'Cronin'    => 'Sam Cronin',
			'Whitbread' => 'Kevin Whitbread',
		),
		array(
			'Cuneo'  => 'Bill Cuneo',
			'Warlow' => 'John Warlow',
		),
		array(
			'Czeninga' => 'Daniel Czeninga',
			'Lietz'    => 'Martin Lietz',
		),
		array(
			'Daisenberger'   => 'Micki Daisenberger',
			'Lautenschlager' => 'Florian Lautenschlager',
		),
		array(
			'Daisenberger' => 'Micky Daisenberger',
			'Bolduan'      => 'Tobias Bolduan',
		),
		array(
			'Dasenbrook' => 'Norbert Dasenbrook',
			'Meier'      => 'Sven Meier',
		),
		array(
			'De Kergariou' => 'Hervé de Kergariou',
			'Gèron'        => 'Basile Géron',
		),
		array(
			'Dechauffour' => 'Valentin Dechauffour',
			'Gendry'      => 'Pierre Gendry',
		),
		array(
			'Ehlers' => 'Hansjörg Ehlers',
			'Afken'  => 'Thomas Afken',
		),
		array(
			'Feuerhake'  => 'Jürgen Feuerhake',
			'Nehrenberg' => 'Anne Nehrenberg',
		),
		array(
			'Fitzpatrick' => 'Annie Fitzpatrick',
			'Pittack'     => 'Christian Pittack',
		),
		array(
			'Gambardella' => 'Marco Gambardella',
			'Candela'     => 'Roberto Candela',
		),
		array(
			'Giesler' => 'Stefan Giesler',
			'Böhm'    => 'Frank Böhm',
		),
		array(
			'Gnadeberg' => 'Thure Gnadeberg',
			'Tellen'    => 'Aron Tellen',
		),
		array(
			'Goult'   => 'Martin Goult',
			'Russell' => 'Gordon Russell',
		),
		array(
			'Ham'      => 'Warwick Ham',
			'Robinson' => 'Ryan Robinson',
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
			'Hansgen'  => 'Dirk Hänsgen',
			'Rupprich' => 'Frank Rupprich',
		),
		array(
			'Hauschild' => 'Martha Hauschild',
			'Heyder'    => 'Michael Heyder',
		),
		array(
			'Higgins'  => 'Malcolm Higgins',
			'Johnston' => 'Nick Johnston',
		),
		array(
			'Higgins' => 'Sandy Higgins',
			'Marsh'   => 'Paul Marsh',
		),
		array(
			'Hodgson' => 'Martin Hodgson',
			'Miles'   => 'Adrian Miles',
		),
		array(
			'Hofmann'     => 'Jan-Philipp Hofmann',
			'Brockerhoff' => 'Felix Björn Brockerhoff',
		),
		array(
			'Holzapfel' => 'Alexander Holzapfel',
			'Worm'      => 'Stefan Worm',
		),
		array(
			'Houriet' => 'Catherine Houriet',
			'Donze'   => 'Gil Donzé',
		),
		array(
			'Houriet' => 'Catherine Houriet',
			'Donzé'   => 'Gil Donzé',
		),
		array(
			'Hunger' => 'Wolfgang Hunger',
			'Jess'   => 'Holger Jess',
		),
		array(
			'Hunger'  => 'Wolfgang Hunger',
			'Kleiner' => 'Julien Kleiner',
		),
		array(
			'Hyysalo' => 'Sampsa Hyysalo',
			'Kääpä'   => 'Lauri Kääpä',
		),
		array(
			'Hyysalo' => 'Sampsa Hyysalo',
			'Salonen' => 'Antti Salonen',
		),
		array(
			'Johansson' => 'Johan Johansson',
			'Ekberg'    => 'Anders Ekberg',
		),
		array(
			'Kellner' => 'Christian Kellner',
			'Scholer' => 'Martin Schöler',
		),
		array(
			'Kellner' => 'Christian Kellner',
			'Schöler' => 'Martin Schöler',
		),
		array(
			'Key'     => 'Ramsay Key',
			'Buttner' => 'Andrew Buttner',
		),
		array(
			'Klaas'           => 'Kyle Klaas',
			'Von Gruenewaldt' => 'Robert von Gruenewaldt',
		),
		array(
			'Kwee'    => 'Steve Kwee',
			'Spötter' => 'Thorsten Spötter',
		),
		array(
			'Lankenau' => 'Lars Lankenau',
			'Schipler' => 'Anna Dorothea Schipler',
		),
		array(
			'Largier'       => 'James Largier',
			'Hutton-Squire' => 'Richard Hutton-Squire',
		),
		array(
			'Lawner'     => 'Tord Lawner',
			'Gustavsson' => 'Tomas Gustavsson',
		),
		array(
			'Lehmann' => 'Claas Lehmann',
			'Oehme'   => 'Leon Oehme',
		),
		array(
			'Lindfors' => 'Kaj Lindfors',
			'Halonen'  => 'Johan Halonen',
		),
		array(
			'Lott'   => 'Nigel Lott',
			'Franks' => 'Bob Franks',
		),
		array(
			'Lutz'      => 'Lutz Kandzia',
			'Deutscher' => 'Martin Deutscher',
		),
		array(
			'Marti'   => 'Ueli Marti',
			'Schürch' => 'Res Schürch',
		),
		array(
			'Menge' => 'Katharina Menge',
			'Kühne' => 'Jens Kühne',
		),
		array(
			'Mittermayer' => 'Georg Mittermayer',
			'Barteldt'    => 'Dirk Barteldt',
		),
		array(
			'Moore'   => 'Tyler Moore',
			'Ewenson' => 'Geoff Ewenson',
		),
		array(
			'Moore'   => 'Tyler Moore',
			'Falsone' => 'Jesse Falsone',
		),
		array(
			'Napier'  => 'Rob Napier',
			'Pearson' => 'Malcolm \'Pip\' Pearson',
		),
		array(
			'Neidhart' => 'Elisabeth Neidhart',
			'Gougeon'  => 'Matthieu Gougeon',
		),
		array(
			'Nicholas' => 'Peter Nicholas',
			'Payne'    => 'Luke Payne',
		),
		array(
			'Nieminen' => 'Jukka Nieminen',
			'Salonen'  => 'Antti Salonen',
		),
		array(
			'Petermann' => 'Gilles Petermann',
			'Grob'      => 'Laurent Grob',
		),
		array(
			'Pinnell' => 'Ian Pinnell',
			'Shelton' => 'Dave Shelton',
		),
		array(
			'Plattner' => 'Hasso Plattner',
			'Alarie'   => 'Peter Alarie',
		),
		array(
			'Pleßmann' => 'Ulf Pleßmann',
			'Rix'      => 'Hans-Heinrich Rix',
		),
		array(
			'Raita'   => 'Raimo Raita',
			'Nurmela' => 'Juha Nurmela',
		),
		array(
			'Rasenack' => 'Bernd Rasenack',
			'Brückner' => 'Stefan Brückner',
		),
		array(
			'Robinson' => 'Jeffrey Robinson',
			'Penfold'  => 'Bryce Penfold',
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
			'Ross'     => 'Aaron Ross',
			'Waterman' => 'Rob Waterman',
		),
		array(
			'Schlomka'  => 'Jans-Peter Schlomka',
			'Wihlfahrt' => 'Urs Wihlfahrt',
		),
		array(
			'Schneidewind' => 'Ralf Schneidewind',
			'Schürmann'    => 'Oliver Schürmann',
		),
		array(
			'Schomäker' => 'Meike Schomäker',
			'Jess'      => 'Holger Jess',
		),
		array(
			'Schomaker' => 'Meiki Schomaeker',
			'Gorge'     => 'Rainer Görge',
		),
		array(
			'Schultz'    => 'Hendrik Schultz',
			'Oberländer' => 'Ute Oberländer',
		),
		array(
			'Schweiger' => 'Stephan Schweiger',
			'Koch'      => 'Thorsten Koch',
		),
		array(
			'Scutcher'  => 'Terry Scutcher',
			'Diebitsch' => 'Christian Diebitsch',
		),
		array(
			'Sell'   => 'Jan Sell',
			'Gewinn' => 'Wiebke Gewinn',
		),
		array(
			'Steffen' => 'Henning Steffen',
			'Giesen'  => 'Tilman Giesen',
		),
		array(
			'Tasche'   => 'Lennart Tasche',
			'Frederik' => 'Frederik Tasche',
		),
		array(
			'Tennant' => 'Bob Tennant',
			'Mundell' => 'Rich Mundel',
		),
		array(
			'Thornburrow' => 'Mark Thornburrow',
			'Mead'        => 'Laurence Mead',
		),
		array(
			'Tirre' => 'Andre Tirre',
			'Wille' => 'Frank Wille',
		),
		array(
			'Troch' => 'Michael Troch',
			'Konig' => 'Eckart Konig',
		),
		array(
			'Utiger' => 'Toni Utiger',
			'Heilig' => 'Markus Heilig',
		),
		array(
			'Van Deventer' => 'Bruce Van Deventer',
			'Henderson'    => 'Jon Henderson',
		),
		array(
			'Voelckner'  => 'Nicolai Volckner',
			'Lars Dehne' => 'Lars Derschotte Dehne',
		),
		array(
			'Walters' => 'Charles Walters',
			'Cram'    => 'Dougal Cram',
		),
		array(
			'Wilts' => 'Enno Wilts',
			'Holm'  => 'Thorge Holm',
		),
		array(
			'Contag'     => 'Karsten Contag',
			'Von Walter' => 'Guido Von Walter',
		),
		array(
			'Forster' => 'Jan Forster',
			'Neuss'   => 'Marcus Neuß',
		),
		array(
			'Bleuez'    => 'Loic Bleuez',
			'Roucayrol' => 'Frederic Roucayrol',
		),
		array(
			'Kraft'      => 'Olivier Kraft',
			'Heimburger' => 'Frank Heimburger',
		),
		array(
			'Dachs'   => 'Matthias Dachs',
			'Alberts' => 'Jörn Alberts',
		),
		array(
			'Schmidt' => 'Stefan Schmidt',
			'Sjuts'   => 'Horst Sjuts',
		),
		array(
			'Genefke' => 'Hans Genefke',
			'Finn'    => 'Finn Angelo',
		),
		array(
			'Misbach'  => 'Marco Misbach',
			'Dillmann' => 'Andreas Dillmann',
		),
		array(
			'Bertallot'      => 'Kai Bertallot',
			'Reifferscheidt' => 'Jan Reifferscheidt',
		),
		array(
			'Söllner' => 'Sophie Söllner',
			'Stümpel' => 'Karsten Stümpel',
		),
		array(
			'Moore'   => 'Tyler Moore',
			'Buttner' => 'Andrew Buttner',
		),
		array(
			'Burford'  => 'Ian Burford',
			'Christie' => 'David Christie',
		),
		/*
		array(
			'' => '',
			'' => '',
		),
		 */
	);

	private $person = array(
		'A Williams'                => 'Andy Williams',
		'Aaron Tellen'              => 'Aron Tellen',
		'Achterberg Julia'          => 'Julia Achterberg',
		'Adam Gesin'                => 'Adam Gesing',
		'Alain Karajian'            => 'Alain Karadjian',
		'Alexander Earle'           => 'Earle Alexander',
		'Andy Edmunds'              => 'Andy Edmonds',
		'Andy Short'                => 'Andrew Short',
		'Andy Zinn'                 => 'Andrew Zinn',
		'Anika Kebreau'             => 'Anika Kébreau',
		'[AUS] Marcus Cooper'       => 'Marcus Cooper',
		'Beier Frank'               => 'Frank Beier',
		'Ben Glass'                 => 'Benjamin Glass',
		'Ben Illiffe'               => 'Ben Iliffe',
		'Ben McGran'                => 'Ben McGrane',
		'Ben Mcgrane'               => 'Ben McGrane',
		'Bernadette Dekegariou'     => 'Bernadette de Kergariou',
		'Biederer Jens'             => 'Jens Biederer',
		'Birgitte Søgaard'          => 'Birgitte Søgård',
		'Boeger Finn'               => 'Finn Böger',
		'Bohm Stefan'               => 'Stefan Böhm',
		'Bourdon Stephen'           => 'Steve Bourdow',
		'Brad Clarke'               => 'Bradley Clarke',
		'Breitenfeldt Ralf'         => 'Ralf Breitenfeldt',
		'Brockerhoff Felix'         => 'Felix Björn Brockerhoff',
		'Buhl Henrik'               => 'Henrik Buhl',
		'Burford Ian'               => 'Ian Burford',
		'Bussenius Robert'          => 'Robert Bussenius',
		'Bussenius Roger'           => 'Roger Bussenius',
		'Carl Gibbons'              => 'Carl Gibbon',
		'Carl Smith'                => 'Carl Smit',
		'Carvalleo Samuel'          => 'Samuel Carvallo',
		'Carvallo Gilles'           => 'Gilles Carvallo',
		'Cedric Bart'               => 'Bart Cédric',
		'Charles Hanson'            => 'Charles Hansen',
		'Charles Walter'            => 'Charles Walters',
		'Charlie Walters'           => 'Charles Walters',
		'Christian Buehring-Uhle'   => 'Christian Bühring-Uhle',
		'Christian Debitsch'        => 'Christian Diebitsch',
		'Christian Dechamplain'     => 'Christian DeChamplain',
		'Christian Deibitch'        => 'Christian Diebitsch',
		'Christie David'            => 'David Christie',
		'Ciferri Enrico'            => 'Enrico Ciferri',
		'Clark Penny'               => 'Penny Clark',
		'Clark Russell'             => 'Russell Clark',
		'Crazy John McLean'         => 'John Mclean',
		'Daniel Czeniga'            => 'Daniel Czeninga',
		'Dasenbrook Norbert'        => 'Norbert Dasenbrook',
		'Dave Christie'             => 'David Christie',
		'Dave Eberhart'             => 'Dave Eberhardt',
		'Dave Peacock'              => 'David Peacock',
		'Dave Smithwhite'           => 'David Smithwhite',
		'de Jamonieres'             => 'Nicolas des Jamonières',
		'de Kergariou Anne Marie'   => 'Anna Marie de Kergariou',
		'de Kergariou Guillaume'    => 'Guillaume de Kergariou',
		'De Kergariou Guillaune'    => 'Guillaume de Kergariou',
		'de Kergariou Herve'        => 'Hervé de Kergariou',
		'De Kergariou Herve'        => 'Hervé de Kergariou',
		'Deb Ashby'                 => 'Deborah Ashby',
		'Des Jamonieres'            => 'Nicolas des Jamonières',
		'Doug Hagan'                => 'Douglas Hagan',
		'Doug Watson'               => 'Douglas Watson',
		'Dougar Cram'               => 'Dougal Cram',
		'Dr Christian Bühring-Uhle' => 'Christian Bühring-Uhle',
		'Dunne Reeve'               => 'Reeve Dunn',
		'Edwards Geoff'             => 'Geoff Edwards',
		'Fabiola van Wonterghem'    => 'Fabiola Wonterghem',
		'Felix Brockerhoff'         => 'Felix Björn Brockerhoff',
		'Finn Boeger'               => 'Finn Böger',
		'Finn Boger'                => 'Finn Böger',
		'Florian Lautenschlager'    => 'Florian Lautenschläger',
		'Fountaine Mathieu'         => 'Mathieu Fountaine',
		'Francisco Sanguino'        => 'Frisco Sanguino',
		'Frank Bach'                => 'Frank Bach',
		'Friederichs Hartwig'       => 'Hartwig Friedrichs',
		'Garreth Williams'          => 'Gareth Williams',
		'Gil Donze'                 => 'Gil Donzé',
		'Gil Donzé Crg'             => 'Gil Donzé',
		'Giles Carvallo'            => 'Gilles Carvallo',
		'Gillard Thomas'            => 'Thomas Gillard',
		'Guillaume De Kergariou'    => 'Guillaume de Kergariou',
		'Hamlin Howard'             => 'Howard Hamlin',
		'Hans Heinrich Rix'         => 'Hans-Heinrich Rix',
		'Hansen Matt'               => 'Matthew Hansen',
		'Hans-Heirich Rix'          => 'Hans-Heinrich Rix',
		'Hansjoerg Ehlers'          => 'Hansjörg Ehlers',
		'Hartwig Friedrichs'        => 'Hartwig Friedrichs',
		'Hauschild Anna'            => 'Anna Hauschild',
		'Heini Rix'                 => 'Hans-Heinrich Rix',
		'Henik Buhl'                => 'Henrik Buhl',
		'Herve De Kageriou'         => 'Hervé de Kergariou',
		'Herve de Kergariou'        => 'Hervé de Kergariou',
		'Hervé De Kergariou'        => 'Hervé de Kergariou',
		'Herve Dekegariou'          => 'Hervé de Kergariou',
		'Higgins Malcolm'           => 'Malcolm Higgins',
		'Hodgson Martin'            => 'Martin Hodgson',
		'Hofmann Jan-Philipp'       => 'Jan-Philipp Hofmann',
		'Hofmann Nils Henning'      => 'Nils-Henning Hofmann',
		'Holt Mike'                 => 'Mike Holt',
		'Holzapfel Alexander'       => 'Alexander Holzapfel',
		'Howie Hamlin'              => 'Howard Hamlin',
		'Hyde Richard'              => 'Richard Hyde',
		'Ian Mcgillivray'           => 'Ian Mc Gillivray',
		'James Mcgillivray'         => 'James Mc Gillivray',
		'James McGillivray'         => 'James Mc Gillivray',
		'James Spikesley'           => 'James Spikesly',
		'Jan Saugmann DEN'          => 'Jan Saugmann',
		'Jan Sauqmann'              => 'Jan Saugmann',
		'Jan Siekierzynski'         => 'Jan Siekierzyński',
		'Jan-Philipp Hofman'        => 'Jan-Philipp Hofmann',
		'Jean -Baptiste Dupont'     => 'Jean-Baptiste Dupont',
		'JeanLouis Guibbal'         => 'Jean-Louis Guibbal',
		'Jeff Robinson'             => 'Jeffrey Robinson',
		'Jens Kuehne'               => 'Jens Kühne',
		'Jim Mcgillivray'           => 'Jim Mc Gillivray',
		'JL Guibbal'                => 'Jean-Louis Guibbal',
		'Joern Wille'               => 'Jörn Wille',
		'John Mclean CRAZY*'        => 'John Mclean',
		'Johnson Nick'              => 'Nick Johnston',
		'Jorgen Bojsen-Møller'      => 'Jørgen Bojsen-Møller',
		'Juergen Anton'             => 'Jürgen Anton',
		'Juergen Feuerhake'         => 'Jürgen Feuerhake',
		'Juergen Waldheim'          => 'Jürgen Waldheim',
		'Julian Stueckl'            => 'Julian Stückl',
		'Kalie 13yrenius'           => 'Kalle Byrenius',
		'Karsten Stuempel'          => 'Karsten Stümpel',
		'Kim13all Morrison'         => 'Kimball Morrison',
		'Kindermann Johannes'       => 'Johannes Kindermann',
		'Koechlin Stefan'           => 'Stefan Köchlin',
		'Krister Bergstrom'         => 'Krister Bergström',
		'Lars Dehne'                => 'Lars Derschotte Dehne',
		'Lena Stueckl'              => 'Lena Stückl',
		'Lenz Jan-Hendrik'          => 'Jan-Hendrik Lenz',
		'Leoni Meyer'               => 'Leonie Meyer',
		'Lewis Paddy'               => 'Paddy Lewis',
		'Lindsey Gilbert'           => 'Lindsay Gilbert',
		'M Boiry'                   => 'Michel Boiry',
		'M Leask'                   => 'Magnus Leask',
		'Malcom Higgins'            => 'Malcolm Higgins',
		'Malte Christophersen'      => 'Malte Christophessen',
		'Marcus Cooper AUS'         => 'Marcus Cooper',
		'Mark Upton Brown'          => 'Mark Upton-Brown',
		'Martin Gouly'              => 'Martin Goult',
		'Martin Gout'               => 'Martin Goult',
		'Martin Schoeler'           => 'Martin Schöler',
		'Martin ten Hove'           => 'Martin Ten Hove',
		'Mathieu Devaux'            => 'Matthieu Devaux',
		'Matt Bristow'              => 'Matthew Bristow',
		'Matt Hansen'               => 'Matthew Hansen',
		'Mattihieu Guibbal'         => 'Matthieu Guibbal',
		'Mcgillivray Ian'           => 'Ian Mc Gillivray',
		'Mcgillivray Jim'           => 'Jim Mc Gillivray',
		'Meier (SKBUe)'             => 'Sven Meier',
		'Meike Schomaeker'          => 'Meike Schomäker',
		'Meike Schomaker'           => 'Meike Schomäker',
		'Meiki Schomaeker'          => 'Meike Schomäker',
		'Menge Katharina'           => 'Katharina Menge',
		'Michael Daisenberger'      => 'Micki Daisenberger',
		'Michael van Wonterghem'    => 'Michael Wonterghem',
		'Michal Olko'               => 'Michał Olko',
		'Mick Babbage'              => 'Michael Babbage',
		'Micky Daisenberger'        => 'Micki Daisenberger',
		'Mike Priddle'              => 'Michael Priddle',
		'Miles Adrian'              => 'Adrian Miles',
		'Mittermayer Georg'         => 'Georg Mittermayer',
		'Natali Gabriele'           => 'Gabriele Natali',
		'Nici Birkner'              => 'Nicola Birkner',
		'Nick Deussen'              => 'Nicholas Deussen',
		'Nick Meadow'               => 'Nicholas Meadow',
		'Nicolai Volckner'          => 'Nicolai Völckner',
		'Nicolas Des Jamonieres'    => 'Nicolas des Jamonières',
		'Nicolas Des Jamonières'    => 'Nicolas des Jamonières',
		'Nicolas Desjamonires'      => 'Nicolas des Jamonières',
		'Nikola Birkner'            => 'Nicola Birkner',
		'Nikolaj Buhl'              => 'Nikolaj Hoffmann Buhl',
		'Nikos Desjamonieres'       => 'Nicolas des Jamonières',
		'Oliver Schurmann'          => 'Oliver Schürmann',
		'Owen Tudor'                => 'Tudor Owen',
		'PA Hallberg'               => 'Per-Anders Hallberg',
		'Parker Shinn'              => 'Parker Shin',
		'Paul Von Grey'             => 'Paul von Grey',
		'Paul VonGrey'              => 'Paul von Grey',
		'Penno Dirk'                => 'Dirk Penno',
		'Penntti Matti'             => 'Matti Pentti',
		'Pentti Matti'              => 'Matti Pentti',
		'Per Anders Hallberg'       => 'Per-Anders Hallberg',
		'Pip Pearson'               => 'Malcolm \'Pip\' Pearson',
		'Pleamann Ulf'              => 'Ulf Pleßmann',
		'Quirk Michael'             => 'Michael Quirk',
		'Rainer Goerge'             => 'Rainer Görge',
		'Rainer Gorge'              => 'Rainer Görge',
		'Ralf Schneiderwind'        => 'Ralf Schneidewind',
		'Rene Betschen'             => 'René Betschen',
		'Rich Mundell'              => 'Rich Mundel',
		'Rich Nurse'                => 'Richard Nurse',
		'Rix Hans-Heinrich'         => 'Hans-Heinrich Rix',
		'Roos Gerald'               => 'Gerald Roos',
		'Roos Morten'               => 'Morten Roos',
		'Russ Clark'                => 'Russell Clark',
		'Russ Shot'                 => 'Russell Short',
		'Sabine Dechaffour'         => 'Sabine Dechauffour',
		'Sam (GA) Cronin'           => 'Sam Cronin',
		'Schultz Hendrik'           => 'Hendrik Schultz',
		'Soren Overbeck'            => 'Søren Overbeck',
		'Stefan Boehm'              => 'Stefan Böhm',
		'Stefan Bohm'               => 'Stefan Böhm',
		'Stefan Kochlin'            => 'Stefan Köchlin',
		'Stefan Koechlin'           => 'Stefan Köchlin',
		'Stu Park'                  => 'Stuart Park',
		'StuartTurnbull'            => 'Stuart Turnbull',
		'Stueckl Julian'            => 'Julian Stückl',
		'Stuempel'                  => 'Stümpel',
		'TBA'                       => '',
		'Tellen Johannes'           => 'Johannes Tellen',
		'Tennant Bob'               => 'Robert Tennant',
		'Terry Slutcher'            => 'Terry Scutcher',
		'Thompson Craig'            => 'Craig Thompson',
		'Tim Bager'                 => 'Tim Böger',
		'Tim Boeger'                => 'Tim Böger',
		'Tim Boger'                 => 'Tim Böger',
		'Toby Dale'                 => 'Toby Barsley-Dale',
		'Tom Bojland'               => 'Tom Bøjland',
		'Tom Bruton'                => 'Thomas Bruton',
		'Tom Gillard'               => 'Thomas Gillard',
		'Tomas Gustavsson'          => 'Tomas Gustafsson',
		'Treichel Timon'            => 'Timon Treichel',
		'Ueli Marti'                => 'Marti Ueli',
		'Ulf Denicke'               => 'Ulf Denecke',
		'Ulf Plessmann'             => 'Ulf Pleßmann',
		'Ute Stuempel'              => 'Ute Stümpel',
		'Valentin Dechaffour'       => 'Valentin Dechauffour',
		'Veli Marti'                => 'Marti Ueli',
		'Volker Goerge'             => 'Volker Görge',
		'Volker Gorge'              => 'Volker Görge',
		'Volker Niedek'             => 'Volker Niediek',
		'Volker Niedick'            => 'Volker Niediek',
		'Von Grey'                  => 'Paul von Grey',
		'Von Puttkamer Thore'       => 'Thore Von Puttkamer',
		'Wolfgan Hunger'            => 'Wolfgang Hunger',
		'Wolfgang Dr Hunger'        => 'Wolfgang Hunger',
		'Wolfgang Stuckl'           => 'Wolfgang Stückl',
		'Wolfgang Stueckl'          => 'Wolfgang Stückl',
		'Wolfgang Stüeckl'          => 'Wolfgang Stückl',
		'Wolfgang Stuekl'           => 'Wolfgang Stückl',
		'Y. Pajot'                  => 'Yves Pajot',
		'Zeiler Claudius'           => 'Claudius Zeiler',
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


