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
		$args                   = array(
			'post_status' => 'publish',
			'post_type'   => $person_post_type_name,
			'post_title'  => $post_title,
		);
		$post_ID                = wp_insert_post( $args );
		$persons[ $post_title ] = get_post( $post_ID, OBJECT );
	} else {
		$persons[ $post_title ] = $person;
	}
	return $persons[ $post_title ];
}

function person_clear_name( $name ) {
    $name = preg_replace( '/[  \t]+/', ' ', $name );
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

function add_more_owners( $users_ids, $date_from, $order = false ) {
	if ( empty( $users_ids ) ) {
		return;
	}
	return wp_parse_args(
		array(
			'first'     => 'first' === $order,
			'current'   => 'current' === $order,
			'users_ids' => $users_ids,
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
	if ( empty( $date_from ) && preg_match( '/(\d{2})$/', $raw, $matches ) ) {
		$year      = intval( $matches[1] );
		$date_from = add_century_to_date( $year );
	}
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
		case 'Burnham-Sharpe Co':
		case 'Burnham-Sharpe Co.':
		case 'Eklund Brothers':
		case 'Elkington Brothers':
		case 'Grosheny brothers':
		case 'Indiana University':
		case 'Indiana University Yacht Club':
		case 'Krywood Composites':
		case 'Larchmont Yacht Club':
		case 'Orange Coast College':
		case 'Pegasus Racing':
		case 'Pettipaug Jr. Sailing Academy':
		case 'Sailing club in Washington State':
		case 'Sawanaka Corinthian Yacht Club':
		case 'School in Queen Anne':
		case 'some New England sailing academy':
		case 'some New England sailing academy.':
		case 'St. George\'s School Sailing Club':
		case 'St. Johns Jr. College':
		case 'St. Vincents Gulf 505 Association':
		case 'Team Pegasus':
		case 'US Coastguard Academy':
		case 'Wansborough family':
		case 'Web Institute':
		case 'Redwood City':
		case 'German Class Assn':
			return false;
	}
	return true;
}

