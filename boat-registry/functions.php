<?php

function get_person_by_name( $post_title ) {
	global $persons, $person_post_type_name;
	if ( 5 > strlen( $post_title ) ) {
		return null;
	}
	$post_title = person_clear_name( $post_title );
	if ( isset( $persons[ $post_title ] ) ) {
		return $persons[ $post_title ];
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
	$name      = trim( preg_replace( '/[\d\' `\,\.\)\(]+$/', '', $name ) );
	$is_person = check_is_person( $name );
	if ( $is_person ) {
		$name = trim( preg_replace( '/[A-Z]{2,3}$/', '', $name ) );
		$name = trim( preg_replace( '/[\d\' `\,\.\(\)]+$/', '', $name ) );
	}
	switch ( $name ) {
		case 'St. Vincents Gulf 505 Association AUS':
			return 'St. Vincents Gulf 505 Association';
		case 'Tom Bojland':
			return 'Tom Bøjland';
		case 'Wolfgang Stuckl':
		case 'Wolfgang Stueckl':
		case 'Wolfgang Stuekl':
			return 'Wolfgang Stückl';
		case 'Y. Pajot':
			return 'Yves Pajot';
		case 'Jean -Baptiste Dupont':
			return 'Jean-Baptiste Dupont';
		case 'Dave Eberhart':
			return 'Dave Eberhardt';
	}
	return $name;
}



function person( $raw, $person, $date_from = '', $order = false ) {
	if ( empty( $date_from ) && preg_match( '/ \\d{2}$/', $raw, $matches ) ) {
		$year = intval( $matches[1] );
		if ( 54 < $year ) {
			$year += 100;
		}
		$year     += 1900;
		$date_from = sprintf( '%d-01-01', $year );
	}
	return wp_parse_args(
		array(
			'first'     => 'first' === $order,
			'current'   => 'current' === $order,
			'user_id'   => $person->ID,
			'date_from' => $date_from,
		),
		array(
			'current'   => false,
			'first'     => false,
			'users_ids' => array(),
			'date_from' => '',
			'date_to'   => '',
		)
	);
}


function check_is_person( $data ) {
	switch ( $data ) {
		case 'St. George\'s School Sailing Club':
		case 'St. Johns Jr. College':
		case 'St. Vincents Gulf 505 Association':
		case 'Sawanaka Corinthian Yacht Club':
		case 'Burnham-Sharpe Co.':
		case 'Sailing club in Washington State':
		case 'School in Queen Anne':
		case 'some New England sailing academy.':
		case 'US Coastguard Academy':
		case 'Wansborough family':
		case 'Web Institute':
		case 'Team Pegasus':
		case 'Krywood Composites':
			return false;
	}
	return true;
}

