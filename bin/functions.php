<?php
error_reporting( E_ALL );

$root = dirname( dirname( __FILE__ ) );

if ( isset( $_SERVER['SERVER_NAME'] ) ) {
	die( 'not allow with www' );
}

if ( ! is_file( $root . '/etc/config.php' ) ) {
	echo 'ERROR!', PHP_EOL;
	echo 'Please create `config.php` file with WordPress location!',PHP_EOL;
	echo 'You can copy `config.example.php`.',PHP_EOL,PHP_EOL;
	die;
}

require $root . '/etc/config.php';
require $wordpress_path . '/wp-load.php';
require_once( ABSPATH . 'wp-admin/includes/image.php' );

global $import_config;

$import_config = array();

$config_file = $root . '/etc/local.config.json';
if ( is_file( $config_file ) ) {
	$import_config = json_decode( file_get_contents( $config_file ), true );
}
if ( ! is_file( $root . '/etc/config.json' ) ) {
	echo 'ERROR!', PHP_EOL;
	echo 'Please create `config.json` file with files location!',PHP_EOL;
	die;
}

$import_config = wp_parse_args(
	$import_config,
	json_decode( file_get_contents( $root . '/etc/config.json' ), true )
);

function show_debug() {
	return false;
}

function get_person_by_name( $name ) {
	global $persons, $person_post_type_name;
	$post_title = person_clear_name( $name );
	if ( isset( $persons[ $post_title ] ) ) {
		return $persons[ $post_title ];
	}
	$is_person = check_is_person( $post_title );
	if ( ! $is_person ) {
		return $name;
	}
	if ( empty( $post_title ) ) {
		return $post_title;
	}
	$person = get_page_by_title( $post_title, OBJECT, $person_post_type_name );
	if ( empty( $person ) ) {
		$args = array(
			'post_status' => 'publish',
			'post_type'   => $person_post_type_name,
			'post_title'  => $post_title,
		);
		if ( preg_match( '/\d/', $post_title ) ) {
			echo 'DIE: get_person_by_name';
			print_r( array( $name, $args ) );
			die;
		}
		$post_ID                = wp_insert_post( $args );
		$persons[ $post_title ] = get_post( $post_ID, OBJECT );
	} else {
		$persons[ $post_title ] = $person;
	}
	return $persons[ $post_title ];
}

function person_clear_name( $name ) {
	$name      = preg_replace( '/[  \t]+/', ' ', $name );
	$name      = preg_replace( '/[  \t]+/', ' ', $name );
	$name      = preg_replace( '/[\d\s\h\v\'\-`"\,\.–]+$/', '', $name );
	$re        = '/[\d\' `\,\.\(\)\‘]+$/';
	$name      = trim( preg_replace( $re, '', $name ) );
	$is_person = check_is_person( $name );
	if ( $is_person ) {
		$name = trim( preg_replace( '/[A-Z]{2,3}$/', '', $name ) );
		$name = trim( preg_replace( $re, '', $name ) );
		$name = preg_replace( '/ /', ' ', $name );
	}
	return trim( apply_filters( 'iworks_fleet_result_clear_person_name', $name ) );
}

function add_century_to_date( $year ) {
	$year = intval( $year );
	if ( 1900 < $year ) {
		if ( 54 < $year ) {
			$year += 100;
		}
		$year += 1900;
	}
	return sprintf( '%d-01-01', $year );
}

function add_more_owners( $users_ids, $date_from, $date_to, $order = false ) {
	if ( empty( $users_ids ) ) {
		return;
	}
	return wp_parse_args(
		array(
			'first'     => 'first' === $order,
			'current'   => 'current' === $order,
			'users_ids' => $users_ids,
			'date_from' => $date_from,
			'date_to'   => $date_to,
		),
		array(
			'current'   => false,
			'first'     => false,
			'users_ids' => array(),
			'date_from' => '',
			'date_to'   => '',
			'kind'      => 'person',
		)
	);
}

function person( $raw, $person, $date_from = '', $order = false, $date_to = '' ) {
	if ( empty( $date_from ) && preg_match( '/(\d{2})$/', $raw, $matches ) ) {
		$year      = intval( $matches[1] );
		$date_from = add_century_to_date( $year );
	}
	return wp_parse_args(
		array(
			'first'     => 'first' === $order,
			'current'   => 'current' === $order,
			'users_ids' => array( $person->ID ),
			'date_from' => $date_from,
			'date_to'   => $date_to,
		),
		array(
			'current'   => false,
			'first'     => false,
			'users_ids' => array(),
			'date_from' => '',
			'date_to'   => '',
			'kind'      => 'person',
		)
	);
}

function add_organization( $raw, $person, $date_from = '', $order = false ) {
	$person = person_clear_name( $person );
	return wp_parse_args(
		array(
			'first'        => 'first' === $order,
			'current'      => 'current' === $order,
			'organization' => $person,
			'date_from'    => $date_from,
		),
		array(
			'current'   => false,
			'first'     => false,
			'date_from' => '',
			'date_to'   => '',
			'kind'      => 'organization',
		)
	);
}

function check_is_person( $data ) {
	if ( 7 > strlen( $data ) ) {
		if ( show_debug() ) {
			echo PHP_EOL,'short: ',$data,PHP_EOL;
		}
		return false;
	}
	if ( ! preg_match( '/ /', $data ) ) {
		if ( show_debug() ) {
			echo PHP_EOL,'no-space: ',$data,PHP_EOL;
		}
		return false;
	}
	switch ( $data ) {
		case 'Alexandria Wooden Boat Society':
		case 'Avocado Sail Training Association':
		case 'Brothers Sparv':
		case 'Burnham-Sharpe Co':
		case 'Burnham-Sharpe Co.':
		case 'Eklund Brothers':
		case 'Elkington Brothers':
		case 'German Class Assn':
		case 'Grosheny brothers':
		case 'Indiana University':
		case 'Indiana University Yacht Club':
		case 'Krywood Composites':
		case 'Larchmont Yacht Club':
		case 'LES 4 VE':
		case 'Moss-Lovshin family':
		case 'Orange Coast College':
		case 'owner in Devon':
		case 'Pegasus Racing':
		case 'Pettipaug Jr. Sailing Academy':
		case 'Redwood City':
		case 'Sailing club in Washington State':
		case 'Sawanaka Corinthian Yacht Club':
		case 'School in Queen Anne':
		case 'Schwaebisch Hall':
		case 'some New England sailing academy':
		case 'some New England sailing academy.':
		case 'St. George\'s School Sailing Club':
		case 'St. Johns Jr. College':
		case 'St. Vincents Gulf 505 Association':
		case 'Team Eskimo':
		case 'Team Pegasus':
		case 'US Coastguard Academy':
		case 'WA 505 Association':
		case 'Wansborough family':
		case 'Web Institute':
			return false;
	}
	return true;
}

function handle_serie_taxonomy( $serie, &$series, &$post_array, $parent = 0 ) {
	$field = 'iworks_fleet_serie';
	echo $serie,PHP_EOL;
	if ( preg_match( '@/@', $serie ) ) {
		foreach ( preg_split( '@/@', $serie ) as $el ) {
			$parent = handle_serie_taxonomy( $el, $series, $post_array, $parent );
		}
	} else {
		$serie = trim( $serie );
		if ( isset( $series[ $serie ] ) && is_object( $series[ $serie ] ) ) {
			$post_array['tax_input'][ $field ][] = $series[ $serie ]->term_id;
			return $series[ $serie ]->term_id;
		} else {
			$series[ $serie ] = wp_insert_term( $serie, $field, array( 'parent' => $parent ) );
			$series[ $serie ] = get_term_by( 'name', $serie, $field );
			if ( is_object( $series[ $serie ] ) ) {
				$post_array['tax_input'][ $field ][] = $series[ $serie ]->term_id;
				return $series[ $serie ]->term_id;
			} else {
				print_r( array( $serie, $series ) );
				echo 'DIE: handle_serie_taxonomy';
				die;
			}
		}
	}
}

function get_country_from_code( $code ) {
	if ( function_exists( 'iworks_fleet_get_contries' ) ) {
		$countries = iworks_fleet_get_contries();
		foreach ( $countries as $one ) {
			if ( $one['code'] === $code ) {
				return $one['en'];
			}
		}
	}
	return $code;
}

function int505_import_fix_year( $year, $pointer = 'begin' ) {
	if ( empty( $year ) ) {
		return $year;
	}
	/**
	 * date from 1900-01-01 (excel format)
	 */
	if ( preg_match( '/^\d{5}$/', $year ) ) {
		return date(
			'Y-m-d',
			strtotime(
				sprintf(
					'1900-01-01 + %d days',
					$year
				)
			)
		);
	}
	if ( preg_match( '/^\d{4}\-\d{2}\-\d{2}$/', $year ) ) {
		return $year;
	}
	if ( preg_match( '/^\d+$/', $year ) ) {
		$year = intval( $year );
	}
	if ( 1900 > $year ) {
		if ( 56 > $year ) {
			$year += 100;
		}
		$year += 1900;
	}
	if ( 'end' === $pointer ) {
		return sprintf( '%d-12-31', $year );
	}
	return sprintf( '%d-01-01', $year );
}

function int505_echo_dot( $counter, $type = 'success', $mode = 'simple' ) {
	if ( 'detailed' === $mode && 0 === $counter % 10 ) {
		echo ' ';
	}
	if ( 'detailed' === $mode && 0 === $counter % 1000 ) {
		echo PHP_EOL,'------------------',PHP_EOL;
	}
	switch ( $type ) {
		case 'success':
			echo '.';
			break;
		case 'fail':
			echo 'x';
			break;
		case 'file':
			echo 'f';
			break;
		default:
			echo '-';
	}
}

function int505_person_get_date( $name, $type = 'from' ) {
	$date_from = $date_to = null;
	if ( show_debug() && preg_match( '/\d/', $name ) ) {
		print_r(
			array(
				$name,
				'/(\d{4}-\d{2}-\d{2})[^\d]+(\d{4}-\d{2}-\d{2})$/' => preg_match( '/(\d{4}-\d{2}-\d{2})[^\d]+(\d{4}-\d{2}-\d{2})$/', $name ),
				'/ \d{4} – \d{4}$/'       => preg_match( '/ \d{4} – \d{4}$/', $name ),
				'/ \d{4}\-\d{2}\-\d{2}$/' => preg_match( '/ \d{4}-\d{2}-\d{2}$/', $name ),
				'/(\d{2})[^\d]+(\d{2})$/' => preg_match( '/(\d{2})[^\d]+(\d{2})$/', $name ),
				'/(\d{4})[^\d]+(\d{2})$/' => preg_match( '/(\d{4})[^\d]+(\d{2})$/', $name ),
				'/(\d{4})[^\d]+(\d{4})$/' => preg_match( '/(\d{4})[^\d]+(\d{4})$/', $name ),
				'/[^\d]+(\d{2})$/'        => preg_match( '/[^\d]+(\d{2})$/', $name ),
			)
		);
	}

	if ( preg_match( '/ (\d{4}\-\d{2}\-\d{2})$/', $name, $matches ) ) {
		$date_from = $matches[1];
	} elseif ( preg_match( '/(\d{4}) – (\d{4})$/', $name, $matches ) ) {
		$date_from = int505_import_fix_year( $matches[1] );
		$date_to   = int505_import_fix_year( $matches[2], 'end' );
	} elseif ( preg_match( '/(\d{4}-\d{2}-\d{2})[^\d]+(\d{4}-\d{2}-\d{2})$/', $name, $matches ) ) {
		$date_from = $matches[1];
		$date_to   = $matches[2];
	} elseif ( preg_match( '/(\d{2})[^\d]+(\d{2})$/', $name, $matches ) ) {
		$date_from = int505_import_fix_year( $matches[1] );
		$date_to   = int505_import_fix_year( $matches[2], 'end' );
	} elseif ( preg_match( '/(\d{4})[^\d]+(\d{2})$/', $name, $matches ) ) {
		$date_from = sprintf( '%d-%d-01', $matches[1], $matches[2] );
	} elseif ( preg_match( '/(\d{4})[^\d]+(\d{4})$/', $name, $matches ) ) {
		$date_from = int505_import_fix_year( $matches[1] );
		$date_to   = int505_import_fix_year( $matches[2], 'end' );
	} elseif ( preg_match( '/(\d+)\-(\d+)$/', $name, $matches ) ) {
		$date_from = int505_import_fix_year( $matches[1] );
		$date_to   = int505_import_fix_year( $matches[2], 'end' );
		$name      = preg_replace( '/[\'`\t \d\-]+$/', '', $name );
	} elseif ( preg_match( '/[\'`\t ](\d+)$/', $name, $matches ) ) {
		$date_from = int505_import_fix_year( $matches[1] );
	} elseif ( preg_match( '/[\'`\t ](\d+)\-(\d+)\-(\d+)$/', $name, $matches ) ) {
		$date_from = sprintf( '%d-%d-%d', $matches[1], $matches[2], $matches[3] );
	} elseif ( preg_match( '/[^\d]+(\d{2})$/', $name, $matches ) ) {
		$date_from = int505_import_fix_year( $matches[1] );
	}

	if ( 'to' === $type ) {
		return $date_to;
	}

	return $date_from;
}

function int505_person_get_date_from( $name ) {
	return int505_person_get_date( $name, 'from' );
}

function int505_person_get_date_to( $name ) {
	return int505_person_get_date( $name, 'to' );
}

function int505_translate_color( $color ) {
	$colors = array(
		'aliceblue'            => '#f0f8ff',
		'antiquewhite'         => '#faebd7',
		'antiquewhite1'        => '#ffefdb',
		'antiquewhite2'        => '#eedfcc',
		'antiquewhite3'        => '#cdc0b0',
		'antiquewhite4'        => '#8b8378',
		'aquamarine1'          => '#7fffd4',
		'aquamarine2'          => '#76eec6',
		'aquamarine4'          => '#458b74',
		'azure1'               => '#f0ffff',
		'azure2'               => '#e0eeee',
		'azure3'               => '#c1cdcd',
		'azure4'               => '#838b8b',
		'beige'                => '#f5f5dc',
		'bisque1'              => '#ffe4c4',
		'bisque2'              => '#eed5b7',
		'bisque3'              => '#cdb79e',
		'bisque4'              => '#8b7d6b',
		'black'                => '#000000',
		'blanchedalmond'       => '#ffebcd',
		'blue'                 => '#0000ff',
		'blue1'                => '#0000ff',
		'blue2'                => '#0000ee',
		'blue4'                => '#00008b',
		'blueviolet'           => '#8a2be2',
		'brown'                => '#a52a2a',
		'brown1'               => '#ff4040',
		'brown2'               => '#ee3b3b',
		'brown3'               => '#cd3333',
		'brown4'               => '#8b2323',
		'burlywood'            => '#deb887',
		'burlywood1'           => '#ffd39b',
		'burlywood2'           => '#eec591',
		'burlywood3'           => '#cdaa7d',
		'burlywood4'           => '#8b7355',
		'cadetblue'            => '#5f9ea0',
		'cadetblue1'           => '#98f5ff',
		'cadetblue2'           => '#8ee5ee',
		'cadetblue3'           => '#7ac5cd',
		'cadetblue4'           => '#53868b',
		'chartreuse1'          => '#7fff00',
		'chartreuse2'          => '#76ee00',
		'chartreuse3'          => '#66cd00',
		'chartreuse4'          => '#458b00',
		'chocolate'            => '#d2691e',
		'chocolate1'           => '#ff7f24',
		'chocolate2'           => '#ee7621',
		'chocolate3'           => '#cd661d',
		'coral'                => '#ff7f50',
		'coral1'               => '#ff7256',
		'coral2'               => '#ee6a50',
		'coral3'               => '#cd5b45',
		'coral4'               => '#8b3e2f',
		'cornflowerblue'       => '#6495ed',
		'cornsilk1'            => '#fff8dc',
		'cornsilk2'            => '#eee8cd',
		'cornsilk3'            => '#cdc8b1',
		'cornsilk4'            => '#8b8878',
		'cyan1'                => '#00ffff',
		'cyan2'                => '#00eeee',
		'cyan3'                => '#00cdcd',
		'cyan4'                => '#008b8b',
		'darkgoldenrod'        => '#b8860b',
		'darkgoldenrod1'       => '#ffb90f',
		'darkgoldenrod2'       => '#eead0e',
		'darkgoldenrod3'       => '#cd950c',
		'darkgoldenrod4'       => '#8b6508',
		'darkgreen'            => '#006400',
		'darkkhaki'            => '#bdb76b',
		'darkolivegreen'       => '#556b2f',
		'darkolivegreen1'      => '#caff70',
		'darkolivegreen2'      => '#bcee68',
		'darkolivegreen3'      => '#a2cd5a',
		'darkolivegreen4'      => '#6e8b3d',
		'darkorange'           => '#ff8c00',
		'darkorange1'          => '#ff7f00',
		'darkorange2'          => '#ee7600',
		'darkorange3'          => '#cd6600',
		'darkorange4'          => '#8b4500',
		'darkorchid'           => '#9932cc',
		'darkorchid1'          => '#bf3eff',
		'darkorchid2'          => '#b23aee',
		'darkorchid3'          => '#9a32cd',
		'darkorchid4'          => '#68228b',
		'darksalmon'           => '#e9967a',
		'darkseagreen'         => '#8fbc8f',
		'darkseagreen1'        => '#c1ffc1',
		'darkseagreen2'        => '#b4eeb4',
		'darkseagreen3'        => '#9bcd9b',
		'darkseagreen4'        => '#698b69',
		'darkslateblue'        => '#483d8b',
		'darkslategray'        => '#2f4f4f',
		'darkslategray1'       => '#97ffff',
		'darkslategray2'       => '#8deeee',
		'darkslategray3'       => '#79cdcd',
		'darkslategray4'       => '#528b8b',
		'darkturquoise'        => '#00ced1',
		'darkviolet'           => '#9400d3',
		'deeppink1'            => '#ff1493',
		'deeppink2'            => '#ee1289',
		'deeppink3'            => '#cd1076',
		'deeppink4'            => '#8b0a50',
		'deepskyblue1'         => '#00bfff',
		'deepskyblue2'         => '#00b2ee',
		'deepskyblue3'         => '#009acd',
		'deepskyblue4'         => '#00688b',
		'dimgray'              => '#696969',
		'dodgerblue1'          => '#1e90ff',
		'dodgerblue2'          => '#1c86ee',
		'dodgerblue3'          => '#1874cd',
		'dodgerblue4'          => '#104e8b',
		'firebrick'            => '#b22222',
		'firebrick1'           => '#ff3030',
		'firebrick2'           => '#ee2c2c',
		'firebrick3'           => '#cd2626',
		'firebrick4'           => '#8b1a1a',
		'floralwhite'          => '#fffaf0',
		'forestgreen'          => '#228b22',
		'gainsboro'            => '#dcdcdc',
		'ghostwhite'           => '#f8f8ff',
		'gold1'                => '#ffd700',
		'gold2'                => '#eec900',
		'gold3'                => '#cdad00',
		'gold4'                => '#8b7500',
		'goldenrod'            => '#daa520',
		'goldenrod1'           => '#ffc125',
		'goldenrod2'           => '#eeb422',
		'goldenrod3'           => '#cd9b1d',
		'goldenrod4'           => '#8b6914',
		'gray'                 => '#bebebe',
		'gray1'                => '#030303',
		'gray10'               => '#1a1a1a',
		'gray11'               => '#1c1c1c',
		'gray12'               => '#1f1f1f',
		'gray13'               => '#212121',
		'gray14'               => '#242424',
		'gray15'               => '#262626',
		'gray16'               => '#292929',
		'gray17'               => '#2b2b2b',
		'gray18'               => '#2e2e2e',
		'gray19'               => '#303030',
		'gray2'                => '#050505',
		'gray20'               => '#333333',
		'gray21'               => '#363636',
		'gray22'               => '#383838',
		'gray23'               => '#3b3b3b',
		'gray24'               => '#3d3d3d',
		'gray25'               => '#404040',
		'gray26'               => '#424242',
		'gray27'               => '#454545',
		'gray28'               => '#474747',
		'gray29'               => '#4a4a4a',
		'gray3'                => '#080808',
		'gray30'               => '#4d4d4d',
		'gray31'               => '#4f4f4f',
		'gray32'               => '#525252',
		'gray33'               => '#545454',
		'gray34'               => '#575757',
		'gray35'               => '#595959',
		'gray36'               => '#5c5c5c',
		'gray37'               => '#5e5e5e',
		'gray38'               => '#616161',
		'gray39'               => '#636363',
		'gray4'                => '#0a0a0a',
		'gray40'               => '#666666',
		'gray41'               => '#696969',
		'gray42'               => '#6b6b6b',
		'gray43'               => '#6e6e6e',
		'gray44'               => '#707070',
		'gray45'               => '#737373',
		'gray46'               => '#757575',
		'gray47'               => '#787878',
		'gray48'               => '#7a7a7a',
		'gray49'               => '#7d7d7d',
		'gray5'                => '#0d0d0d',
		'gray50'               => '#7f7f7f',
		'gray51'               => '#828282',
		'gray52'               => '#858585',
		'gray53'               => '#878787',
		'gray54'               => '#8a8a8a',
		'gray55'               => '#8c8c8c',
		'gray56'               => '#8f8f8f',
		'gray57'               => '#919191',
		'gray58'               => '#949494',
		'gray59'               => '#969696',
		'gray6'                => '#0f0f0f',
		'gray60'               => '#999999',
		'gray61'               => '#9c9c9c',
		'gray62'               => '#9e9e9e',
		'gray63'               => '#a1a1a1',
		'gray64'               => '#a3a3a3',
		'gray65'               => '#a6a6a6',
		'gray66'               => '#a8a8a8',
		'gray67'               => '#ababab',
		'gray68'               => '#adadad',
		'gray69'               => '#b0b0b0',
		'gray7'                => '#121212',
		'gray70'               => '#b3b3b3',
		'gray71'               => '#b5b5b5',
		'gray72'               => '#b8b8b8',
		'gray73'               => '#bababa',
		'gray74'               => '#bdbdbd',
		'gray75'               => '#bfbfbf',
		'gray76'               => '#c2c2c2',
		'gray77'               => '#c4c4c4',
		'gray78'               => '#c7c7c7',
		'gray79'               => '#c9c9c9',
		'gray8'                => '#141414',
		'gray80'               => '#cccccc',
		'gray81'               => '#cfcfcf',
		'gray82'               => '#d1d1d1',
		'gray83'               => '#d4d4d4',
		'gray84'               => '#d6d6d6',
		'gray85'               => '#d9d9d9',
		'gray86'               => '#dbdbdb',
		'gray87'               => '#dedede',
		'gray88'               => '#e0e0e0',
		'gray89'               => '#e3e3e3',
		'gray9'                => '#171717',
		'gray90'               => '#e5e5e5',
		'gray91'               => '#e8e8e8',
		'gray92'               => '#ebebeb',
		'gray93'               => '#ededed',
		'gray94'               => '#f0f0f0',
		'gray95'               => '#f2f2f2',
		'gray97'               => '#f7f7f7',
		'gray98'               => '#fafafa',
		'gray99'               => '#fcfcfc',
		'green1'               => '#00ff00',
		'green2'               => '#00ee00',
		'green3'               => '#00cd00',
		'green4'               => '#008b00',
		'greenyellow'          => '#adff2f',
		'honeydew1'            => '#f0fff0',
		'honeydew2'            => '#e0eee0',
		'honeydew3'            => '#c1cdc1',
		'honeydew4'            => '#838b83',
		'hotpink'              => '#ff69b4',
		'hotpink1'             => '#ff6eb4',
		'hotpink2'             => '#ee6aa7',
		'hotpink3'             => '#cd6090',
		'hotpink4'             => '#8b3a62',
		'indianred'            => '#cd5c5c',
		'indianred1'           => '#ff6a6a',
		'indianred2'           => '#ee6363',
		'indianred3'           => '#cd5555',
		'indianred4'           => '#8b3a3a',
		'ivory1'               => '#fffff0',
		'ivory2'               => '#eeeee0',
		'ivory3'               => '#cdcdc1',
		'ivory4'               => '#8b8b83',
		'khaki'                => '#f0e68c',
		'khaki1'               => '#fff68f',
		'khaki2'               => '#eee685',
		'khaki3'               => '#cdc673',
		'khaki4'               => '#8b864e',
		'lavender'             => '#e6e6fa',
		'lavenderblush1'       => '#fff0f5',
		'lavenderblush2'       => '#eee0e5',
		'lavenderblush3'       => '#cdc1c5',
		'lavenderblush4'       => '#8b8386',
		'lawngreen'            => '#7cfc00',
		'lemonchiffon1'        => '#fffacd',
		'lemonchiffon2'        => '#eee9bf',
		'lemonchiffon3'        => '#cdc9a5',
		'lemonchiffon4'        => '#8b8970',
		'light'                => '#eedd82',
		'lightblue'            => '#add8e6',
		'lightblue1'           => '#bfefff',
		'lightblue2'           => '#b2dfee',
		'lightblue3'           => '#9ac0cd',
		'lightblue4'           => '#68838b',
		'lightcoral'           => '#f08080',
		'lightcyan1'           => '#e0ffff',
		'lightcyan2'           => '#d1eeee',
		'lightcyan3'           => '#b4cdcd',
		'lightcyan4'           => '#7a8b8b',
		'lightgoldenrod1'      => '#ffec8b',
		'lightgoldenrod2'      => '#eedc82',
		'lightgoldenrod3'      => '#cdbe70',
		'lightgoldenrod4'      => '#8b814c',
		'lightgoldenrodyellow' => '#fafad2',
		'lightgray'            => '#d3d3d3',
		'lightpink'            => '#ffb6c1',
		'lightpink1'           => '#ffaeb9',
		'lightpink2'           => '#eea2ad',
		'lightpink3'           => '#cd8c95',
		'lightpink4'           => '#8b5f65',
		'lightsalmon1'         => '#ffa07a',
		'lightsalmon2'         => '#ee9572',
		'lightsalmon3'         => '#cd8162',
		'lightsalmon4'         => '#8b5742',
		'lightseagreen'        => '#20b2aa',
		'lightskyblue'         => '#87cefa',
		'lightskyblue1'        => '#b0e2ff',
		'lightskyblue2'        => '#a4d3ee',
		'lightskyblue3'        => '#8db6cd',
		'lightskyblue4'        => '#607b8b',
		'lightslateblue'       => '#8470ff',
		'lightslategray'       => '#778899',
		'lightsteelblue'       => '#b0c4de',
		'lightsteelblue1'      => '#cae1ff',
		'lightsteelblue2'      => '#bcd2ee',
		'lightsteelblue3'      => '#a2b5cd',
		'lightsteelblue4'      => '#6e7b8b',
		'lightyellow1'         => '#ffffe0',
		'lightyellow2'         => '#eeeed1',
		'lightyellow3'         => '#cdcdb4',
		'lightyellow4'         => '#8b8b7a',
		'limegreen'            => '#32cd32',
		'linen'                => '#faf0e6',
		'magenta'              => '#ff00ff',
		'magenta2'             => '#ee00ee',
		'magenta3'             => '#cd00cd',
		'magenta4'             => '#8b008b',
		'maroon'               => '#b03060',
		'maroon1'              => '#ff34b3',
		'maroon2'              => '#ee30a7',
		'maroon3'              => '#cd2990',
		'maroon4'              => '#8b1c62',
		'medium'               => '#66cdaa',
		'mediumaquamarine'     => '#66cdaa',
		'mediumblue'           => '#0000cd',
		'mediumorchid'         => '#ba55d3',
		'mediumorchid1'        => '#e066ff',
		'mediumorchid2'        => '#d15fee',
		'mediumorchid3'        => '#b452cd',
		'mediumorchid4'        => '#7a378b',
		'mediumpurple'         => '#9370db',
		'mediumpurple1'        => '#ab82ff',
		'mediumpurple2'        => '#9f79ee',
		'mediumpurple3'        => '#8968cd',
		'mediumpurple4'        => '#5d478b',
		'mediumseagreen'       => '#3cb371',
		'mediumslateblue'      => '#7b68ee',
		'mediumspringgreen'    => '#00fa9a',
		'mediumturquoise'      => '#48d1cc',
		'mediumvioletred'      => '#c71585',
		'midnightblue'         => '#191970',
		'mintcream'            => '#f5fffa',
		'mistyrose1'           => '#ffe4e1',
		'mistyrose2'           => '#eed5d2',
		'mistyrose3'           => '#cdb7b5',
		'mistyrose4'           => '#8b7d7b',
		'moccasin'             => '#ffe4b5',
		'navajowhite1'         => '#ffdead',
		'navajowhite2'         => '#eecfa1',
		'navajowhite3'         => '#cdb38b',
		'navajowhite4'         => '#8b795e',
		'navyblue'             => '#000080',
		'oldlace'              => '#fdf5e6',
		'olivedrab'            => '#6b8e23',
		'olivedrab1'           => '#c0ff3e',
		'olivedrab2'           => '#b3ee3a',
		'olivedrab4'           => '#698b22',
		'orange1'              => '#ffa500',
		'orange2'              => '#ee9a00',
		'orange3'              => '#cd8500',
		'orange4'              => '#8b5a00',
		'orangered1'           => '#ff4500',
		'orangered2'           => '#ee4000',
		'orangered3'           => '#cd3700',
		'orangered4'           => '#8b2500',
		'orchid'               => '#da70d6',
		'orchid1'              => '#ff83fa',
		'orchid2'              => '#ee7ae9',
		'orchid3'              => '#cd69c9',
		'orchid4'              => '#8b4789',
		'pale'                 => '#db7093',
		'palegoldenrod'        => '#eee8aa',
		'palegreen'            => '#98fb98',
		'palegreen1'           => '#9aff9a',
		'palegreen2'           => '#90ee90',
		'palegreen3'           => '#7ccd7c',
		'palegreen4'           => '#548b54',
		'paleturquoise'        => '#afeeee',
		'paleturquoise1'       => '#bbffff',
		'paleturquoise2'       => '#aeeeee',
		'paleturquoise3'       => '#96cdcd',
		'paleturquoise4'       => '#668b8b',
		'palevioletred'        => '#db7093',
		'palevioletred1'       => '#ff82ab',
		'palevioletred2'       => '#ee799f',
		'palevioletred3'       => '#cd6889',
		'palevioletred4'       => '#8b475d',
		'papayawhip'           => '#ffefd5',
		'peachpuff1'           => '#ffdab9',
		'peachpuff2'           => '#eecbad',
		'peachpuff3'           => '#cdaf95',
		'peachpuff4'           => '#8b7765',
		'pink'                 => '#ffc0cb',
		'pink1'                => '#ffb5c5',
		'pink2'                => '#eea9b8',
		'pink3'                => '#cd919e',
		'pink4'                => '#8b636c',
		'plum'                 => '#dda0dd',
		'plum1'                => '#ffbbff',
		'plum2'                => '#eeaeee',
		'plum3'                => '#cd96cd',
		'plum4'                => '#8b668b',
		'powderblue'           => '#b0e0e6',
		'purple'               => '#a020f0',
		'rebeccapurple'        => '#663399',
		'purple1'              => '#9b30ff',
		'purple2'              => '#912cee',
		'purple3'              => '#7d26cd',
		'purple4'              => '#551a8b',
		'red1'                 => '#ff0000',
		'red2'                 => '#ee0000',
		'red3'                 => '#cd0000',
		'red4'                 => '#8b0000',
		'rosybrown'            => '#bc8f8f',
		'rosybrown1'           => '#ffc1c1',
		'rosybrown2'           => '#eeb4b4',
		'rosybrown3'           => '#cd9b9b',
		'rosybrown4'           => '#8b6969',
		'royalblue'            => '#4169e1',
		'royalblue1'           => '#4876ff',
		'royalblue2'           => '#436eee',
		'royalblue3'           => '#3a5fcd',
		'royalblue4'           => '#27408b',
		'saddlebrown'          => '#8b4513',
		'salmon'               => '#fa8072',
		'salmon1'              => '#ff8c69',
		'salmon2'              => '#ee8262',
		'salmon3'              => '#cd7054',
		'salmon4'              => '#8b4c39',
		'sandybrown'           => '#f4a460',
		'seagreen1'            => '#54ff9f',
		'seagreen2'            => '#4eee94',
		'seagreen3'            => '#43cd80',
		'seagreen4'            => '#2e8b57',
		'seashell1'            => '#fff5ee',
		'seashell2'            => '#eee5de',
		'seashell3'            => '#cdc5bf',
		'seashell4'            => '#8b8682',
		'sienna'               => '#a0522d',
		'sienna1'              => '#ff8247',
		'sienna2'              => '#ee7942',
		'sienna3'              => '#cd6839',
		'sienna4'              => '#8b4726',
		'skyblue'              => '#87ceeb',
		'skyblue1'             => '#87ceff',
		'skyblue2'             => '#7ec0ee',
		'skyblue3'             => '#6ca6cd',
		'skyblue4'             => '#4a708b',
		'slateblue'            => '#6a5acd',
		'slateblue1'           => '#836fff',
		'slateblue2'           => '#7a67ee',
		'slateblue3'           => '#6959cd',
		'slateblue4'           => '#473c8b',
		'slategray'            => '#708090',
		'slategray1'           => '#c6e2ff',
		'slategray2'           => '#b9d3ee',
		'slategray3'           => '#9fb6cd',
		'slategray4'           => '#6c7b8b',
		'snow1'                => '#fffafa',
		'snow2'                => '#eee9e9',
		'snow3'                => '#cdc9c9',
		'snow4'                => '#8b8989',
		'springgreen1'         => '#00ff7f',
		'springgreen2'         => '#00ee76',
		'springgreen3'         => '#00cd66',
		'springgreen4'         => '#008b45',
		'steelblue'            => '#4682b4',
		'steelblue1'           => '#63b8ff',
		'steelblue2'           => '#5cacee',
		'steelblue3'           => '#4f94cd',
		'steelblue4'           => '#36648b',
		'tan'                  => '#d2b48c',
		'tan1'                 => '#ffa54f',
		'tan2'                 => '#ee9a49',
		'tan3'                 => '#cd853f',
		'tan4'                 => '#8b5a2b',
		'thistle'              => '#d8bfd8',
		'thistle1'             => '#ffe1ff',
		'thistle2'             => '#eed2ee',
		'thistle3'             => '#cdb5cd',
		'thistle4'             => '#8b7b8b',
		'tomato1'              => '#ff6347',
		'tomato2'              => '#ee5c42',
		'tomato3'              => '#cd4f39',
		'tomato4'              => '#8b3626',
		'turquoise'            => '#40e0d0',
		'turquoise1'           => '#00f5ff',
		'turquoise2'           => '#00e5ee',
		'turquoise3'           => '#00c5cd',
		'turquoise4'           => '#00868b',
		'violet'               => '#ee82ee',
		'violetred'            => '#d02090',
		'violetred1'           => '#ff3e96',
		'violetred2'           => '#ee3a8c',
		'violetred3'           => '#cd3278',
		'violetred4'           => '#8b2252',
		'wheat'                => '#f5deb3',
		'wheat1'               => '#ffe7ba',
		'wheat2'               => '#eed8ae',
		'wheat3'               => '#cdba96',
		'wheat4'               => '#8b7e66',
		'white'                => '#ffffff',
		'whitesmoke'           => '#f5f5f5',
		'yellow1'              => '#ffff00',
		'yellow2'              => '#eeee00',
		'yellow3'              => '#cdcd00',
		'yellow4'              => '#8b8b00',
		'yellowgreen'          => '#9acd32',
	);
	$c      = strtolower( trim( $color ) );
	$c      = preg_replace( '/[ \t\r\n]+/', '', $c );
	if ( isset( $colors[ $c ] ) ) {
		return $colors[ $c ];
	}
	if ( show_debug() ) {
		echo $color,PHP_EOL;
	}
	return $color;
}

