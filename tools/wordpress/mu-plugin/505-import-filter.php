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
			'Boeger' => 'Timon Böger',
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
			'Schlomka'  => 'Jens-Peter Schlomka',
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
			'Konig' => 'Eckart König',
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
		array(
			'Brinkbäumer'   => 'Klaus Brinkbäumer',
			'Feuchtenhofer' => 'Toralf Feuchtenhofer',
		),
		array(
			'Müller'     => 'Philipp Müller',
			'Eilenstein' => 'Malte Eilenstein',
		),
		array(
			'Kittsteiner' => 'Martin Kittsteiner',
			'Stieglitz'   => 'Oliver Stieglitz',
		),
		array(
			'Stückl'  => 'Julian Stückl',
			'Henning' => 'Basti Henning',
		),
		array(
			'Hofmann' => 'Ailyn Hofmann',
			'Brix'    => 'Florian Brix',
		),
		array(
			'Mack'        => 'Gelen Mack',
			'Johannisson' => 'Wilhelm Johanisson',
		),
		array(
			'Silvestre' => 'Christian Silvestre',
			'Vallaud'   => 'Christian Vallaud',
		),
		array(
			'Boite'     => 'Philippe Boite',
			'Fonntaine' => 'Mathieu Fountaine',
		),
		array(
			'Handel'    => 'Martin Handel',
			'Böhringer' => 'Volker Böhringer',
		),
		array(
			'Böger'   => 'Timon Böger',
			'Schöner' => 'Markus Schöner',
		),
		array(
			'Holzapfel' => 'Alexander Holzapfel',
			'Engel'     => 'Carsten Engel',
		),
		array(
			'Cragg' => 'Philip Cragg',
			'Corfu' => 'Reto Corfu',
		),
		array(
			'Des Brisay' => 'Cynthia Des Brisay',
			'Hansen'     => 'Charles Hansen',
		),
		array(
			'Jeangirard' => 'Pierre Jeangirard',
			'Crawford'   => 'Tom Crawford',
		),
		array(
			'Starks'   => 'Courtney Starks',
			'Flanagan' => 'Sugar Flanagan',
		),
		array(
			'Trainor'  => 'Brian Trainor',
			'Jennings' => 'Evan Jennings',
		),
		array(
			'Kowalski' => 'Cody Kowalski',
			'Ginther'  => 'Dan Ginther',
		),
		array(
			'Mears'  => 'Stewart Mears',
			'Tucker' => 'Richard Tucker',
		),
		array(
			'Neidhart'   => 'Elisabeth Neidhart',
			'De Monteil' => 'David De Monteil',
		),
		array(
			'Mcgale'  => 'Patrick McGale',
			'Pearson' => 'Chris Pearson',
		),
		array(
			'Olbrysch' => 'Jens Olbrysch',
			'Thies'    => 'Oliver Thies',
		),
		array(
			'Gubri'   => 'Serge Gubri',
			'Di Pede' => 'Thibault Di Pede',
		),
		array(
			'Lewns'   => 'Chris Lewis',
			'Parsons' => 'Dan Parsons',
		),
		array(
			'Owen'   => 'Tudor Owen',
			'Bruton' => 'Thomas Bruton',
		),
		array(
			'Le Morvan' => 'Bastian Le Morvan',
			'Gougeon'   => 'Matthieu Gougeon',
		),
		array(
			'Blyth'  => 'Jim Blyth',
			'Aitken' => 'Donald Aitken',
		),
		array(
			'Frédéric' => 'Frédéric Monnier',
			'Yann'     => 'Yann Plathier',
		),
		array(
			'Leroy'    => 'Philippe Leroy',
			'Guitteny' => 'Marc-Henri Guitteny',
		),
		array(
			'Martin' => 'Mike Martin',
			'Lowry'  => 'Adam Lowry',
		),
		array(
			'Cameron'  => 'Kevin Cameron',
			'Heritage' => 'Sam Heritage',
		),
		array(
			'Wyles'    => 'John Wyles',
			'Fletcher' => 'Gareth Fletcher',
		),
		array(
			'Kruse'    => 'Peter Kruse',
			'Wittemer' => 'Arne Wittemer',
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
		'Achterberg Andreas'        => 'Andreas Achterberg',
		'Achterberg Frieder'        => 'Frieder Achterberg',
		'Achterberg Jakob'          => 'Jakob Achterberg',
		'Achterberg Julia'          => 'Julia Achterberg',
		'Adam Gesin'                => 'Adam Gesing',
		'Alain Karajian'            => 'Alain Karadjian',
		'Alex Ham'                  => 'Alexander Ham',
		'Alexander Earle'           => 'Earle Alexander',
		'Alexander von Mertes'      => 'Alexander Von Mertens',
		'Amdy Smith'                => 'Andy Smith',
		'Andy Edmunds'              => 'Andy Edmonds',
		'Andy Short'                => 'Andrew Short',
		'Andy Thorp'                => 'Andrew Thorp',
		'Andy Zinn'                 => 'Andrew Zinn',
		'Anika Kebreau'             => 'Anika Kébreau',
		'Anna Hauschildt'           => 'Anna Hauschild',
		'Anne Fitspatrick'          => 'Anne Fitzpatrick',
		'Anne Marie De Kergariou'   => 'Anna Marie de Kergariou',
		'[AUS] Marcus Cooper'       => 'Marcus Cooper',
		'Bach Frank'                => 'Frank Bach',
		'Bart Cedric'               => 'Bart Cédric',
		'Basile Geron'              => 'Basile Géron',
		'Beier Frank'               => 'Frank Beier',
		'Bell Jon'                  => 'Jon Bell',
		'Ben Glass'                 => 'Benjamin Glass',
		'Ben Iliffe'                => 'Benjamin Iliffe',
		'Ben Illiffe'               => 'Benjamin Iliffe',
		'Ben McGran'                => 'Ben McGrane',
		'Ben Mcgrane'               => 'Ben McGrane',
		'Bernadette Dekegariou'     => 'Bernadette de Kergariou',
		'Betschen René'             => 'René Betschen',
		'Biederer Jens'             => 'Jens Biederer',
		'Bill Mastermann'           => 'Bill Masterman',
		'Bill Mc Kinney'            => 'Bill McKinney',
		'Birgitte Søgaard'          => 'Birgitte Søgård',
		'Birkner Nicola'            => 'Nicola Birkner',
		'Bjerke Lars'               => 'Lars Bjerke',
		'Boeger Finn'               => 'Finn Böger',
		'Boehm Stefan'              => 'Stefan Böhm',
		'Böger Finn'                => 'Finn Böger',
		'Böger Tim'                 => 'Timon Böger',
		'Bohm Stefan'               => 'Stefan Böhm',
		'Boite Philippe'            => 'Philippe Boite',
		'Bojsen-Møller Jørgen'      => 'Jørgen Bojsen-Møller',
		'Bourdon Stephen'           => 'Steve Bourdow',
		'Brad Clarke'               => 'Bradley Clarke',
		'Breitenfeldt Ralf'         => 'Ralf Breitenfeldt',
		'Brendan O\'rielly'         => 'Brendan O\'Rielly',
		'Brenet Veronique'          => 'Veronique Brenet',
		'Brockerhoff Felix'         => 'Felix Björn Brockerhoff',
		'Bruce Van Devente'         => 'Bruce Van Deventer',
		'Bruce Vandeventer'         => 'Bruce Van Deventer',
		'Bruton Tom'                => 'Thomas Bruton',
		'Buhl Henrik'               => 'Henrik Buhl',
		'Burford Ian'               => 'Ian Burford',
		'Bussenius Robert'          => 'Robert Bussenius',
		'Bussenius Roger'           => 'Roger Bussenius',
		'Calvert Johan'             => 'Johan Calvert',
		'Caminade Francois'         => 'Francois Caminade',
		'Carl Gibbons'              => 'Carl Gibbon',
		'Carl Smith'                => 'Carl Smit',
		'Carvalleo Samuel'          => 'Samuel Carvallo',
		'Carvallo Gilles'           => 'Gilles Carvallo',
		'Cedric Bart'               => 'Bart Cédric',
		'Charles Hanson'            => 'Charles Hansen',
		'Charles Walter'            => 'Charles Walters',
		'Charlie Walters'           => 'Charles Walters',
		'Charlies Dore'             => 'Charlie Dore',
		'Chris Hubbard'             => 'Christopher Hubbard',
		'Chris Pittack'             => 'Christian Pittack',
		'Christher Hubbard'         => 'Christopher Hubbard',
		'Christian Buehring-Uhle'   => 'Christian Bühring-Uhle',
		'Christian Debitsch'        => 'Christian Diebitsch',
		'Christian Dechamplain'     => 'Christian DeChamplain',
		'Christian Deibitch'        => 'Christian Diebitsch',
		'Christian Doerr'           => 'Christian Dörr',
		'Christiansen Mikkel'       => 'Mikkel Christiansen',
		'Christie David'            => 'David Christie',
		'Christopher Brady'         => 'Chris Brady',
		'Ciferri Enrico'            => 'Enrico Ciferri',
		'Clark Penny'               => 'Penny Clark',
		'Clark Russell'             => 'Russell Clark',
		'Cody Kawalski'             => 'Cody Kowalski',
		'Crazy John McLean'         => 'John McLean',
		'Curtis Hartman'            => 'Curtis Hartmann',
		'Cynthia Brisay'            => 'Cynthia Des Brisay',
		'Daniel Czeniga'            => 'Daniel Czeninga',
		'Dasenbrook Norbert'        => 'Norbert Dasenbrook',
		'Dave Brown'                => 'David Brown',
		'Dave Christie'             => 'David Christie',
		'Dave Eberhart'             => 'Dave Eberhardt',
		'Dave Peacock'              => 'David Peacock',
		'Dave Smithwhite'           => 'David Smithwhite',
		'de Jamonieres'             => 'Nicolas des Jamonières',
		'de Kergariou Anne Marie'   => 'Anna Marie de Kergariou',
		'de Kergariou Guillaume'    => 'Guillaume de Kergariou',
		'De Kergariou Guillaume'    => 'Guillaume de Kergariou',
		'De Kergariou Guillaune'    => 'Guillaume de Kergariou',
		'de Kergariou Herve'        => 'Hervé de Kergariou',
		'De Kergariou Herve'        => 'Hervé de Kergariou',
		'De Kergariou Pierre'       => 'Pierre de Kergariou',
		'Deb Ashby'                 => 'Deborah Ashby',
		'Des Jamonieres'            => 'Nicolas des Jamonières',
		'Des Jamonieres Nicolas'    => 'Nicolas des Jamonières',
		'Dirk Luebbers'             => 'Dirk Lübbers',
		'Dogulas Hagan'             => 'Douglas Hagan',
		'Donze Gil'                 => 'Gil Donzé',
		'Doug Hagan'                => 'Douglas Hagan',
		'Doug Watson'               => 'Douglas Watson',
		'Dougar Cram'               => 'Dougal Cram',
		'Dr Christian Bühring-Uhle' => 'Christian Bühring-Uhle',
		'Dunne Reeve'               => 'Reeve Dunn',
		'Ebbe Rosen'                => 'Ebbe Rosén',
		'Eckart Koenig'             => 'Eckart König',
		'Eckart Konig'              => 'Eckart König',
		'Edwards Geoff'             => 'Geoff Edwards',
		'Ekberg Anders'             => 'Anders Ekberg',
		'Eric Cobourn'              => 'Erik Coburn',
		'Eric Coburn'               => 'Erik Coburn',
		'Eric Quemard'              => 'Eric Quémard',
		'Fabiola van Wonterghem'    => 'Fabiola Wonterghem',
		'Fabiola Van Wonterghem'    => 'Fabiola Wonterghem',
		'Felix Brockerhoff'         => 'Felix Björn Brockerhoff',
		'Finn Boeger'               => 'Finn Böger',
		'Finn Boger'                => 'Finn Böger',
		'Flood Sven'                => 'Sven Flood',
		'Florian Lautenschlager'    => 'Florian Lautenschläger',
		'Floriant Stauffer'         => 'Florian Stauffer',
		'Fountaine Mathieu'         => 'Mathieu Fountaine',
		'Fowelin Jesper'            => 'Jesper Fowelin',
		'Francisco Sanguino'        => 'Frisco Sanguino',
		'Franck Heimburger'         => 'Frank Heimburger',
		'Francois De Lisle'         => 'François de Lisle',
		'Frank Rainsbrough'         => 'Frank Rainsborough',
		'Frederic Monnier'          => 'Frédéric Monnier',
		'Friederichs Hartwig'       => 'Hartwig Friedrichs',
		'Frisco Sanguino'           => 'Franscisco Sanguino-Petersen',
		'Frisco Sanguino-Petersen'  => 'Franscisco Sanguino-Petersen',
		'Gachet Claude'             => 'Claude Gachet',
		'Galen Mack'                => 'Gelen Mack',
		'Garreth Williams'          => 'Gareth Williams',
		'Gil Donze'                 => 'Gil Donzé',
		'Gil Donzé Crg'             => 'Gil Donzé',
		'Giles Carvallo'            => 'Gilles Carvallo',
		'Gillard Thomas'            => 'Thomas Gillard',
		'Gioretti Cesare'           => 'Cesare Giorgetti',
		'Gordon Russel'             => 'Gordon Russell',
		'Guillaume De Kergariou'    => 'Guillaume de Kergariou',
		'Guy Hubert'                => 'Hubert Guy',
		'Hamlin Howard'             => 'Howard Hamlin',
		'Hans Heinrich Rix'         => 'Hans-Heinrich Rix',
		'Hansen Matt'               => 'Matthew Hansen',
		'Hans-Heirich Rix'          => 'Hans-Heinrich Rix',
		'Hansjoerg Ehlers'          => 'Hansjörg Ehlers',
		'Harry Bridden'             => 'Harry Briddon',
		'Hartwig Friedrichs'        => 'Hartwig Friedrichs',
		'Hastenpflug Knut'          => 'Knut Hastenpflug',
		'Hastenpflug Tom'           => 'Tom Hastenpflug',
		'Hauschild Anna'            => 'Anna Hauschild',
		'Hauschilo Anna'            => 'Anna Hauschild',
		'Hde Monteil David'         => 'David De Monteil',
		'Heini Rix'                 => 'Hans-Heinrich Rix',
		'Henik Buhl'                => 'Henrik Buhl',
		'Herve De Kageriou'         => 'Hervé de Kergariou',
		'Herve de Kergariou'        => 'Hervé de Kergariou',
		'Herve De Kergariou'        => 'Hervé de Kergariou',
		'Hervé De Kergariou'        => 'Hervé de Kergariou',
		'Herve Dekegariou'          => 'Hervé de Kergariou',
		'Hewrik Buhl'               => 'Henrik Buhl',
		'Higgins Malcolm'           => 'Malcolm Higgins',
		'Hodgson Martin'            => 'Martin Hodgson',
		'Hoering Sebastian',
		'Hofmann Jan-Philipp'       => 'Jan-Philipp Hofmann',
		'Hofmann Nils Henning'      => 'Nils-Henning Hofmann',
		'Holt Mike'                 => 'Mike Holt',
		'Holzapfel Alexander'       => 'Alexander Holzapfel',
		'Houriet Catherine'         => 'Catherine Houriet',
		'Howie Hamlin'              => 'Howard Hamlin',
		'Hunger Wolfgang'           => 'Wolfgang Hunger',
		'Hyde Richard'              => 'Richard Hyde',
		'Ian Mcgillivray'           => 'Ian Mc Gillivray',
		'Ian Pinnel'                => 'Ian Pinnell',
		'Jacob Bojsen-Moller'       => 'Jacob Bojsen-Møller',
		'James Mcgillivray'         => 'James Mc Gillivray',
		'James McGillivray'         => 'James Mc Gillivray',
		'James Spikesley'           => 'James Spikesly',
		'Jamonieres Des Nicolas'    => 'Nicolas des Jamonières',
		'Jan Saugman'               => 'Jan Saugmann',
		'Jan Saugmann DEN'          => 'Jan Saugmann',
		'Jan Sauqmann'              => 'Jan Saugmann',
		'Jan Siekierzynski'         => 'Jan Siekierzyński',
		'Jana Hastenpflu'           => 'Jana Hastenpflug',
		'Jan-Philipp Hofman'        => 'Jan-Philipp Hofmann',
		'Jans-Peter Schlomka'       => 'Jens-Peter Schlomka',
		'Jean -Baptiste Dupont'     => 'Jean-Baptiste Dupont',
		'JeanLouis Guibbal'         => 'Jean-Louis Guibbal',
		'Jean-Philippe Chartier'    => 'Jean Philippe Chartier',
		'Jeff Robinson'             => 'Jeffrey Robinson',
		'Jens Kuehne'               => 'Jens Kühne',
		'Jess Holger'               => 'Holger Jess',
		'Jim Mcgillivray'           => 'Jim Mc Gillivray',
		'JL Guibbal'                => 'Jean-Louis Guibbal',
		'Joerg Gosche'              => 'Jörg Gosche',
		'Joern Wille'               => 'Jörn Wille',
		'Johan Rook'                => 'Johan Röök',
		'John Mclean'               => 'John McLean',
		'John Mclean CRAZY*'        => 'John McLean',
		'Johnson Nick'              => 'Nick Johnston',
		'Jorgen Bojsen-Moller'      => 'Jørgen Bojsen-Møller',
		'Jorgen Bojsen-Møller'      => 'Jørgen Bojsen-Møller',
		'Juergen Anton'             => 'Jürgen Anton',
		'Juergen Feuerhake'         => 'Jürgen Feuerhake',
		'Juergen Waldheim'          => 'Jürgen Waldheim',
		'Julian Kleiner'            => 'Julien Kleiner',
		'Julian Stueckl'            => 'Julian Stückl',
		'Jurgen Feuerhake'          => 'Jürgen Feuerhake',
		'Kaj Lindfros'              => 'Kaj Lindfors',
		'Kalie 13yrenius'           => 'Kalle Byrenius',
		'Karste Stümpel'            => 'Karsten Stümpel',
		'Karsten Stuempel'          => 'Karsten Stümpel',
		'Kergariou De Guillaume'    => 'Guillaume de Kergariou',
		'Kergariou De Herve'        => 'Hervé de Kergariou',
		'Kieran O\'leary'           => 'Kieran O\'Leary',
		'Kilburn Jack'              => 'Jack Kilburn',
		'Kim13all Morrison'         => 'Kimball Morrison',
		'Kindermann Johannes'       => 'Johannes Kindermann',
		'Koechlin Stefan'           => 'Stefan Köchlin',
		'Krister Bergstrom'         => 'Krister Bergström',
		'Kruse Peter'               => 'Peter Kruse',
		'Lars Dehne'                => 'Lars Derschotte Dehne',
		'Laurila Tuomas'            => 'Tuomas Laurila',
		'Lawner Tord'               => 'Tord Lawner',
		'Lena Stueckl'              => 'Lena Stückl',
		'Lenz Jan-Hendrik'          => 'Jan-Hendrik Lenz',
		'Leoni Meyer'               => 'Leonie Meyer',
		'Leslaw Świstelnicki'       => 'Leszek Świstelnicki',
		'Lewis Paddy'               => 'Paddy Lewis',
		'Lewns Chris'               => 'Chris Lewns',
		'Lindsey Gilbert'           => 'Lindsay Gilbert',
		'M Boiry'                   => 'Michel Boiry',
		'M Leask'                   => 'Magnus Leask',
		'Malcom Higgins'            => 'Malcolm Higgins',
		'Malte Christophersen'      => 'Malte Christophessen',
		'Marcus Cooper AUS'         => 'Marcus Cooper',
		'Mark Upton Brown'          => 'Mark Upton-Brown',
		'Mark Upton‑Brown'          => 'Mark Upton-Brown',
		'Markus Schöne'             => 'Markus Schöner',
		'Martin Gorge'              => 'Martin Görge',
		'Martin Gouly'              => 'Martin Goult',
		'Martin Gout'               => 'Martin Goult',
		'Martin Hodson'             => 'Martin Hodgson',
		'Martin Schoeler'           => 'Martin Schöler',
		'Martin ten Hove'           => 'Martin Ten Hove',
		'Mathieu Devaux'            => 'Matthieu Devaux',
		'Mats Elfs'                 => 'Mats Elf',
		'Matt Bristow'              => 'Matthew Bristow',
		'Matt Hansen'               => 'Matthew Hansen',
		'Matt Mcqueen'              => 'Matt McQueen',
		'Mattihieu Guibbal'         => 'Matthieu Guibbal',
		'Mcgillivray Ian'           => 'Ian Mc Gillivray',
		'Mcgillivray Jim'           => 'Jim Mc Gillivray',
		'Meier (SKBUe)'             => 'Sven Meier',
		'Meike Schomaeker'          => 'Meike Schomäker',
		'Meike Schomaker'           => 'Meike Schomäker',
		'Meiki Schomaeker'          => 'Meike Schomäker',
		'Menge Katharina'           => 'Katharina Menge',
		'Michael Daisenberger'      => 'Micki Daisenberger',
		'Michael M\'donnell'        => 'Michael M\'Donnell',
		'Michael O’Brien'           => 'Michael O\'Brien',
		'Michael O\'brien'          => 'Michael O\'Brien',
		'Michael Poulos'            => 'Mike Poulos',
		'Michael Quink'             => 'Mike Quirk',
		'Michael van Wonterghem'    => 'Michael Wonterghem',
		'Michael Van Wonterghem'    => 'Michael Wonterghem',
		'Michal Olko'               => 'Michał Olko',
		'Mick Babbage'              => 'Michael Babbage',
		'Mickael Duffield'          => 'Michael Duffield',
		'Micky Daisenberger'        => 'Micki Daisenberger',
		'Mike Curtin'               => 'Michael Curtin',
		'Mike Priddle'              => 'Michael Priddle',
		'Miles Adrian'              => 'Adrian Miles',
		'Mitchell Ian'              => 'Ian Mitchell',
		'Mittermayer Georg'         => 'Georg Mittermayer',
		'Morten Ramsbaek'           => 'Morten Ramsbæk',
		'Morten Ramsbak'            => 'Morten Ramsbæk',
		'Natali Gabriele'           => 'Gabriele Natali',
		'Needham Tim'               => 'Tim Needham',
		'Neidhart Elisabet'         => 'Elisabeth Neidhart',
		'Nelson Jeff'               => 'Jeff Nelson',
		'Nici Birkner'              => 'Nicola Birkner',
		'Nick Deussen'              => 'Nicholas Deussen',
		'Nick Meadow'               => 'Nicholas Meadow',
		'Nicolai Buhl'              => 'Nikolaj Hoffmann Buhl',
		'Nicolai Volckner'          => 'Nicolai Völckner',
		'Nicolas Des Jamonieres'    => 'Nicolas des Jamonières',
		'Nicolas Des Jamonières'    => 'Nicolas des Jamonières',
		'Nicolas Desjamonires'      => 'Nicolas des Jamonières',
		'Nikola Birkner'            => 'Nicola Birkner',
		'Nikolaj Buhl'              => 'Nikolaj Hoffmann Buhl',
		'Nikolaj Hoffman'           => 'Nikolaj Hoffmann Buhl',
		'Nikos Desjamonieres'       => 'Nicolas des Jamonières',
		'Nilsson Kalle'             => 'Kalle Nilsson',
		'Oliver Schurmann'          => 'Oliver Schürmann',
		'Oliver Stieglite'          => 'Oliver Stieglitz',
		'Owen Tudor'                => 'Tudor Owen',
		'PA Hallberg'               => 'Per-Anders Hallberg',
		'P-A Hallberg'              => 'Per-Anders Hallberg',
		'Parker Shinn'              => 'Parker Shin',
		'Patrick Mc Gale'           => 'Patrick McGale',
		'Patrick Mcgale'            => 'Patrick McGale',
		'Patrick McSale'            => 'Patrick McGale',
		'Paul Von Grey'             => 'Paul von Grey',
		'Paul Von Greysup'          => 'Paul von Grey',
		'Paul VonGrey'              => 'Paul von Grey',
		'Pedro Bohneberger'         => 'Pedro Bohnenberger',
		'Peirre Jeangirard'         => 'Pierre Jeangirard',
		'Penno Dirk'                => 'Dirk Penno',
		'Penntti Matti'             => 'Matti Pentti',
		'Pentti Matti'              => 'Matti Pentti',
		'Per Anders Hallberg'       => 'Per-Anders Hallberg',
		'Per-Eric Thornstrom'       => 'Per-Eric Thörnström',
		'Peter Jean-Pierre'         => 'Jean-Pierre Peter',
		'Peury Hannu'               => 'Hannu Pöyry',
		'Phil Cragg'                => 'Philip Cragg',
		'Phil Crugg'                => 'Philip Cragg',
		'Philipp Sudbrac'           => 'Philipp Sudbrack',
		'Phillip Blanchard'         => 'Philippe Blanchard',
		'Phillip Crass'             => 'Philip Cragg',
		'Phillipe Vandersteen'      => 'Philippe Vandersteen',
		'Pierre Chene Yves'         => 'Yves Chene Pierre',
		'Pierre Jean Gallo'         => 'Pierre-Jean Gallo',
		'Pierre Jean-Gallo'         => 'Pierre-Jean Gallo',
		'Pinnel Ian'                => 'Ian Pinnell',
		'Pip Pearson'               => 'Malcolm \'Pip\' Pearson',
		'Pleamann Ulf'              => 'Ulf Pleßmann',
		'Przemek Zagorski'          => 'Przemek Zagórski',
		'Quirk Michael'             => 'Michael Quirk',
		'Rainer Goerge'             => 'Rainer Görge',
		'Rainer Gorge'              => 'Rainer Görge',
		'Ralf Schneiderwind'        => 'Ralf Schneidewind',
		'Rene Betschen'             => 'René Betschen',
		'Rich Mundell'              => 'Rich Mundel',
		'Rich Nurse'                => 'Richard Nurse',
		'Ritter Hubertus'           => 'Hubertus Ritter',
		'Rix Hans-Heinrich'         => 'Hans-Heinrich Rix',
		'Rob Watermann'             => 'Rob Waterman',
		'Romey Dustin'              => 'Dustin Romey',
		'Roos Gerald'               => 'Gerald Roos',
		'Roos Maike'                => 'Maike Roos',
		'Roos Morten'               => 'Morten Roos',
		'Roos Ronald'               => 'Ronald Roos',
		'Russ Clark'                => 'Russell Clark',
		'Russ Shot'                 => 'Russell Short',
		'Sabine Dechaffour'         => 'Sabine Dechauffour',
		'Sam (GA) Cronin'           => 'Sam Cronin',
		'Saugmann Jan'              => 'Jan Saugmann',
		'Schlesiger Davina'         => 'Davina Schlesiger',
		'Schlesiger Marvin'         => 'Marvin Schlesiger',
		'Schneider Ingo'            => 'Ingo Schneider',
		'Schultz Hendrik'           => 'Hendrik Schultz',
		'Schweizer Peter'           => 'Peter Schweizer',
		'Sebastian Hoering',
		'Smit Carl'                 => 'Carl Smit',
		'Sol Marini'                => 'Soloman Marini',
		'Söllner Sophie'            => 'Sophie Söllner',
		'Soren Asboe Jorgensen'     => 'Søren Asboe Jørgensen',
		'Soren Overbeck'            => 'Søren Overbeck',
		'Ste Angela'                => 'Angela Stenger',
		'Stefan Boehm'              => 'Stefan Böhm',
		'Stefan Bohm'               => 'Stefan Böhm',
		'Stefan Kochlin'            => 'Stefan Köchlin',
		'Stefan Koechlin'           => 'Stefan Köchlin',
		'Steve Lovshin'             => 'Stephen Lovshin',
		'Stu Park'                  => 'Stuart Park',
		'StuartTurnbull'            => 'Stuart Turnbull',
		'Stueckl Julian'            => 'Julian Stückl',
		'Stueckl Wolfgang'          => 'Wolfgang Stückl',
		'Stuempel'                  => 'Stümpel',
		'TBA'                       => '',
		'Tellen Johannes'           => 'Johannes Tellen',
		'Tengblad Rasmus'           => 'Rasmus Tengblad',
		'Tennant Bob'               => 'Robert Tennant',
		'Terry Slutcher'            => 'Terry Scutcher',
		'Thies Oliver'              => 'Oliver Thies',
		'Thompson Craig'            => 'Craig Thompson',
		'Thörnström Per-Eric'       => 'Per-Eric Thörnström',
		'Thorsten Spotter'          => 'Thorsten Spötter',
		'Tim Bager'                 => 'Timon Böger',
		'Tim Boeger'                => 'Timon Böger',
		'Tim Boger'                 => 'Timon Böger',
		'Tim Böger'                 => 'Timon Böger',
		'Tim O’ Connor'             => 'Tim O\'Connor',
		'Tobi Bolduan'              => 'Tobias Bolduan',
		'Toby Dale'                 => 'Toby Barsley-Dale',
		'Tom Bojland'               => 'Tom Bøjland',
		'Tom Brunton'               => 'Thomas Bruton',
		'Tom Bruton'                => 'Thomas Bruton',
		'Tom Crawford'              => 'Thomas Crawford',
		'Tom Gillard'               => 'Thomas Gillard',
		'Tom Swiff'                 => 'Tom Swift',
		'Tomas Gustavsson'          => 'Tomas Gustafsson',
		'Tomas Jaxing-'             => 'Tomas Jaxing',
		'Treichel Timon'            => 'Timon Treichel',
		'Ueli Marti'                => 'Marti Ueli',
		'Ulf Denicke'               => 'Ulf Denecke',
		'Ulf Plessmann'             => 'Ulf Pleßmann',
		'Upton Brown Mark'          => 'Mark Upton-Brown',
		'Ute Oberlander'            => 'Ute Oberländer',
		'Ute Stuempel'              => 'Ute Stümpel',
		'Valentin Dechaffour'       => 'Valentin Dechauffour',
		'Veli Marti'                => 'Marti Ueli',
		'Volker Goerge'             => 'Volker Görge',
		'Volker Gorge'              => 'Volker Görge',
		'Volker Niedek'             => 'Volker Niediek',
		'Volker Niedick'            => 'Volker Niediek',
		'Von Grey'                  => 'Paul von Grey',
		'Von Puttkamer Thore'       => 'Thore Von Puttkamer',
		'Warwack Ham'               => 'Warwick Ham',
		'Wedge Martin'              => 'Martin Wedge',
		'Weiß Maxi'                 => 'Maximilian Weiß',
		'Wenrup / Olle'             => 'Olle Wenrup',
		'Wilhelm Johannisson'       => 'Wilhelm Johanisson',
		'Wittemer Arne'             => 'Arne Wittemer',
		'Wojtek Butkiewicz'         => 'Wojciech Butkiewicz',
		'Wolfgan Hunger'            => 'Wolfgang Hunger',
		'Wolfgang Dr Hunger'        => 'Dr Wolfgang Hunger',
		'Wolfgang Stuckl'           => 'Wolfgang Stückl',
		'Wolfgang Stuecki'          => 'Wolfgang Stückl',
		'Wolfgang Stueckl'          => 'Wolfgang Stückl',
		'Wolfgang Stüeckl'          => 'Wolfgang Stückl',
		'Wolfgang Stuekl'           => 'Wolfgang Stückl',
		'Wolgang Hunger'            => 'Wolfgang Hunger',
		'Wollenbecker Anika'        => 'Anika Wollenbecker',
		'Wollenbecker Raik'         => 'Raik Wollenbecker',
		'Wonterghem Michael'        => 'Michael Wonterghem',
		'Worm Stefan'               => 'Stefan Worm',
		'Xavier Detappe'            => 'Xavier deTappe',
		'Y. Pajot'                  => 'Yves Pajot',
		'Zeiler Claudius'           => 'Claudius Zeiler',
	);

	public function __construct() {
		add_filter( 'iworks_fleet_result_upload_helm', array( $this, 'helm' ), 10, 2 );
		add_filter( 'iworks_fleet_result_upload_crew', array( $this, 'crew' ), 10, 2 );
		add_filter( 'iworks_fleet_result_upload_helm', array( $this, 'person' ), 11, 1 );
		add_filter( 'iworks_fleet_result_upload_crew', array( $this, 'person' ), 11, 1 );
		add_filter( 'iworks_fleet_result_clear_person_name', array( $this, 'person' ), 11, 1 );
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
		$person = trim( $person );
		if ( isset( $this->person[ $person ] ) ) {
			return $this->person[ $person ];
		}
		return trim( $person );
	}

	public function helm( $helm, $crew ) {
		if ( $helm === $crew ) {
			return $helm;
		}
		$helm = trim( $helm );
		$crew = trim( $crew );
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
		return trim( $helm );
	}

	public function crew( $crew, $helm ) {
		if ( $helm === $crew ) {
			return $helm;
		}
		$helm = trim( $helm );
		$crew = trim( $crew );
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
		return trim( $crew );
	}

}

new iworks_5o5_upload_fixer;


