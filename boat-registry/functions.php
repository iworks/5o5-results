<?php
error_reporting( E_ALL );

if ( isset( $_SERVER['SERVER_NAME'] ) ) {
	die( 'not allow with www' );
}

if ( ! is_file( 'config.php' ) ) {
	echo 'ERROR!', PHP_EOL;
	echo 'Please create `config.php` file with WordPress location!',PHP_EOL;
	echo 'You can copy `config.example.php`.',PHP_EOL,PHP_EOL;
	die;
}

require 'config.php';

require $wordpress_path . '/wp-load.php';

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
			print_r( [ $name, $args ] );
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
	$name      = preg_replace( '/[\d\s\h\v\'\-`"\,\.]+$/', '', $name );
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

function person( $raw, $person, $date_from = '', $order = false ) {
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
		case 'owner in Devon':
		case 'Alexandria Wooden Boat Society':
		case 'Avocado Sail Training Association':
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
		case 'Moss-Lovshin family':
		case 'Orange Coast College':
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
		case 'Wansborough family':
		case 'Web Institute':
		case 'Brothers Sparv':
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
				print_r( [ $serie, $series ] );
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

function int505_echo_dot( $counter, $type = 'success' ) {
	if ( 0 === $counter % 10 ) {
		echo ' ';
	}
	if ( 0 === $counter % 100 ) {
		echo PHP_EOL;
		if ( 0 === $counter % 1000 ) {
			echo '------------------',PHP_EOL;
		}
	}
	switch ( $type ) {
		case 'success':
			echo '.';
			break;
		case 'fail':
			echo 'x';
			break;
		default:
			echo '-';
	}
}

function int505_person_get_date( $name, $type = 'from' ) {
	$date_from = $date_to = null;
	if ( show_debug() && preg_match( '/\d/', $name ) ) {
		print_r(
			[
				$name,
				'/(\d{4}-\d{2}-\d{2})[^\d]+(\d{4}-\d{2}-\d{2})$/' => preg_match( '/(\d{4}-\d{2}-\d{2})[^\d]+(\d{4}-\d{2}-\d{2})$/', $name ),
				'/(\d{2})[^\d]+(\d{2})$/' => preg_match( '/(\d{2})[^\d]+(\d{2})$/', $name ),
				'/(\d{4})[^\d]+(\d{2})$/' => preg_match( '/(\d{4})[^\d]+(\d{2})$/', $name ),
				'/(\d{4})[^\d]+(\d{4})$/' => preg_match( '/(\d{4})[^\d]+(\d{4})$/', $name ),
				'/[^\d]+(\d{2})$/'        => preg_match( '/[^\d]+(\d{2})$/', $name ),
			]
		);
	}

	if ( preg_match( '/(\d{4}-\d{2}-\d{2})[^\d]+(\d{4}-\d{2}-\d{2})$/', $name, $matches ) ) {
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
