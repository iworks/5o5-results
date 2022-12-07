#!/usr/bin/php -d memory_limit=20480M
<?php
/**
 * posts & coments import API
 *
 * PHP version 5
 *
 * @category   WordPress_Tools
 * @package    WordPress
 * @subpackage Import
 * @author     Marcin Pietrzak <marci@iworks.pl>
 * @license    http://iworks.pl/ commercial
 * @version    SVN: $Id: import_posts.php 4872 2012-07-24 13:53:34Z illi $
 * @link       http://iworks.pl/
 *
 */

require 'functions.php';

$data_root = $root . '/data';

global $import_config;

global $wpdb;
$boat_post_type_name        = 'iworks_fleet_boat';
$taxonomy_name_manufacturer = 'iworks_fleet_boat_manufacturer';
$person_post_type_name      = 'iworks_fleet_person';
$result_post_type_name      = 'iworks_fleet_result';
$owners_field_name          = 'iworks_fleet_boat_owners';
$owners_index_field_name    = 'iworks_fleet_boot_owner_id';

$countries = array();
if ( function_exists( 'iworks_fleet_get_contries' ) ) {
	$countries = iworks_fleet_get_contries();
}

$hull_manufacturer = array();
$data              = get_terms( $taxonomy_name_manufacturer, array( 'hide_empty' => false ) );
foreach ( $data as $one ) {
	$hull_manufacturer[ $one->name ] = $one;
}

$debug = false;

$import_registry = $import_results = $import_sailors = false;

if ( sizeof( $argv ) === 1 ) {
	echo 'select parts to import:',PHP_EOL;
	echo '- all (all parts)',PHP_EOL;
	echo '- registry',PHP_EOL;
	echo '- sailors',PHP_EOL;
	echo '- results',PHP_EOL;
	exit;
}

/**
 * Setup import parts
 */
if ( in_array( 'all', $argv ) ) {
	$import_registry = $import_results = $import_sailors = true;
} else {
	if (
		in_array( 'b', $argv )
		|| in_array( 'registry', $argv )
		|| in_array( 'boats', $argv )
	) {
		$import_registry = true;
	}
	if (
		in_array( 's', $argv )
		|| in_array( 'sailors', $argv )
	) {
		$import_sailors = true;
	}
	if (
		false
		|| in_array( 'r', $argv )
		|| in_array( 'e', $argv )
		|| in_array( 'events', $argv )
		|| in_array( 'results', $argv )
	) {
		$import_results = true;
	}
}

/**
 * import sailors
 */
if ( $import_sailors && ( $handle = fopen( $data_root . '/' . $import_config['sailors'], 'r' ) ) !== false ) {
	$counter = 0;
	echo PHP_EOL,'IMPORT: ' . $import_config['sailors'],PHP_EOL;
		/**
		 * Fields:
		 *
		 *  0 Nation
		 *  1 Name
		 *  2 Birth Date - iworks_fleet_personal_birth_date
		 *  3 Club
		 *  4 Description
		 *  5 Email    - iworks_fleet_contact_email
		 *  6 Mobile   - iworks_fleet_contact_mobile
		 *  7 Website  - iworks_fleet_social_website
		 *  8 Facebook - iworks_fleet_social_facebook
		 *  9 iworks_fleet_social_instagram
		 * 10 iworks_fleet_social_twitter
		 * 11 iworks_fleet_social_endomondo
		 *
		 */
	$fields = array(
		5  => 'works_fleet_contact_email',
		6  => 'works_fleet_contact_mobile',
		7  => 'works_fleet_social_website',
		8  => 'works_fleet_social_facebook',
		9  => 'works_fleet_social_instagram',
		10 => 'works_fleet_social_twitter',
		11 => 'works_fleet_social_endomondo',
	);
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( isset( $data[1] ) && ! empty( $data[1] ) ) {
			if ( 'Nation' === $data[0] ) {
				continue;
			}
			$p = person_clear_name( $data[1] );
			if ( empty( $p ) ) {
				continue;
			}
			$post = get_page_by_title( $p, OBJECT, $person_post_type_name );
			if ( ! empty( $post ) ) {
				int505_echo_dot( $counter, 'fail' );
				$counter++;
				continue;
			}
			$post_array = array(
				'post_title'  => $p,
				'post_type'   => $person_post_type_name,
				'post_status' => 'publish',
				'meta_input'  => array(
					'iworks_fleet_personal_nation' => trim( $data[0] ),
				),
			);
			/**
			 * Birth!
			 */
			if ( isset( $data[2] ) ) {
				$value = trim( $data[2] );
				if ( preg_match( '/^\d{4}$/', $value ) ) {
					$post_array['meta_input']['iworks_fleet_personal_birth_year'] = $value;
				} else {
					$value = strtotime( $value );
					$post_array['meta_input']['iworks_fleet_personal_birth_year'] = date( 'Y', $value );
					$post_array['meta_input']['iworks_fleet_personal_birth_date'] = $value;
				}
			}
			/**
			 * get meta fields
			 */
			foreach ( $fields as $index => $meta_key ) {
				if ( ! isset( $data[ $index ] ) ) {
					continue;
				}
				$value = trim( $data[ $index ] );
				if ( empty( $value ) ) {
					continue;
				}
				$post_array['meta_input'][ $meta_key ] = $value;
			}
			$result = wp_insert_post( $post_array );
			if ( $result ) {
				int505_echo_dot( $counter );
			} else {
				int505_echo_dot( $counter, 'fail' );
			}
		} else {
			int505_echo_dot( $counter, 'fail' );
		}
		$counter++;
	}
}

/**
 * registry
 */
$counter = 0;
$rows    = array();
if ( $import_registry && ( $handle = fopen( $data_root . '/' . $import_config['boats'], 'r' ) ) !== false ) {
	echo PHP_EOL,'IMPORT: ',$import_config['boats'],PHP_EOL;
	$counter = 0;
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( 1 > intval( $data[0] ) ) {
			int505_echo_dot( $counter, 'fail' );
			$counter++;
			continue;
		}
		$post = get_page_by_title( $data[0], OBJECT, $boat_post_type_name );
		if ( empty( $post ) ) {
			int505_echo_dot( $counter );
			/*
			 *  0 Sail No
			 *  1 Year Built
			 *  2 Builder
			 *  3 Name
			 *  4 Hull material
			 *  5 Description
			 *  6 First Owner
			 *  7 Subsequent Owners
			 *  8 Last Recorded Owner
			 *  9 Fleet/Sailing Club
			 * 10 City
			 * 11 Country
			 * 12 Last Updated
			 * 13 Colors
			 * 14 Facebook
			 * 15 Instagram
			 * 16 Twitter
			 * 17 Website
			 */
			$iworks_fleet_boat_hull_number   = intval( $data[0] );
			$iworks_fleet_boat_build_year    = intval( $data[1] );
			$iworks_fleet_hull_manufacturer  = trim( $data[2] );
			$iworks_fleet_boat_name          = trim( $data[3] );
			$iworks_fleet_boat_hull_material = trim( $data[4] );
			$post_content                    = trim( $data[5] );
			$iworks_fleet_boat_nation        = trim( $data[11] );
			$iworks_fleet_boat_last_update   = trim( $data[12] );
			$iworks_fleet_social_facebook    = trim( $data[14] );
			$iworks_fleet_social_instagram   = trim( $data[15] );
			$iworks_fleet_social_twitter     = trim( $data[16] );
			$iworks_fleet_social_website     = trim( $data[17] );
			$iworks_fleet_boat_colors        = preg_split( '/[;\|]/', trim( $data[13] ) );
			if ( ! empty( $iworks_fleet_boat_colors ) ) {
				foreach ( $iworks_fleet_boat_colors as $index => $color ) {
					$iworks_fleet_boat_colors[ $index ] = int505_translate_color( $color );
				}
			}
			if ( ! is_string( $post_content ) ) {
				print_r( $post_content );
				die;
			}
			$post = array(
				'post_status'  => 'publish',
				'post_type'    => $boat_post_type_name,
				'post_title'   => $iworks_fleet_boat_hull_number,
				'post_content' => trim( $post_content ),
				'meta_input'   => array(
					'iworks_fleet_boat_hull_number' => $iworks_fleet_boat_hull_number,
				),
				'tax_input'    => array(),
			);
			/**
			 * simple meta
			 */
			foreach (
				array(
					'iworks_fleet_boat_hull_number',
					'iworks_fleet_boat_build_year',
					'iworks_fleet_boat_hull_material',
					'iworks_fleet_boat_name',
					'iworks_fleet_boat_nation',
					'iworks_fleet_boat_last_update',
					'iworks_fleet_social_facebook',
					'iworks_fleet_social_instagram',
					'iworks_fleet_social_twitter',
					'iworks_fleet_social_website',
				) as $key ) {
				if ( empty( $$key ) ) {
					continue;
				}
				if ( 'iworks_fleet_boat_last_update' === $key ) {
					$$key = strtotime( $$key );
				}
				$post['meta_input'][ $key ] = $$key;
			}
			if ( is_array( $iworks_fleet_boat_colors ) ) {
				if ( 0 < sizeof( $iworks_fleet_boat_colors ) ) {
					$color = trim( array_shift( $iworks_fleet_boat_colors ) );
					if ( ! empty( $color ) ) {
						$post['meta_input']['iworks_fleet_boat_color_top'] = $color;
					}
					if ( 0 < sizeof( $iworks_fleet_boat_colors ) ) {
						$color = trim( array_shift( $iworks_fleet_boat_colors ) );
						if ( ! empty( $color ) ) {
							$post['meta_input']['iworks_fleet_boat_color_side'] = $color;
						}
						if ( 0 < sizeof( $iworks_fleet_boat_colors ) ) {
							$color = trim( array_shift( $iworks_fleet_boat_colors ) );
							if ( ! empty( $color ) ) {
								$post['meta_input']['iworks_fleet_boat_color_bottom'] = $color;
							}
						}
					}
				}
			}
			/**
			 * Hull builder
			 */
			if ( ! empty( $iworks_fleet_hull_manufacturer ) ) {
				switch ( $iworks_fleet_hull_manufacturer ) {
					case 'Parker/Nab':
					case 'Parker kit':
					case 'Parker launcher':
					case 'Parker-hulled Lindsay':
					case 'Rondar Parker':
						$iworks_fleet_hull_manufacturer = 'Parker';
						break;
					case 'builder':
					case 'Custom homebuilt':
					case 'home-build':
					case 'home-built':
					case 'self-built':
					case 'self-constructed':
					case 'self-made':
					case 'Builder':
						$iworks_fleet_hull_manufacturer = 'home built';
						break;
					case 'Honore Marine':
					case 'Honore Marine GB':
					case 'Honor Marine':
						$iworks_fleet_hull_manufacturer = 'Honnor Marine';
						break;
					case 'Polymec kit':
						$iworks_fleet_hull_manufacturer = 'Polymec';
						break;
					case 'International & Olympic Yachts':
						$iworks_fleet_hull_manufacturer = 'International & Olympic Yachts';
						break;
					case 'new mould (Kyrwood)':
					case 'Kyrwood hull':
					case 'Krywood':
						$iworks_fleet_hull_manufacturer = 'Kyrwood';
						break;
					case 'Sydney mould':
					case 'N.S.W. mould':
					case 'Winwood':
					case 'Davies':
					case 'Glenn Dennis':
					case 'self-made (Barclay)':
					case 'Morin':
					case 'Bara':
					case 'R. Haselgrove':
					case 'Blessing':
					case 'Malcolm Goodwin':
					case 'Henderson':
					case 'Scarisbrick':
					case 'Mayberry':
					case 'Nectec Racing Boats':
					case 'Ziegelmayer':
					case 'Fisher':
					case 'Bob Fischer':
					case 'Ovi/Paris Voile':
						$iworks_fleet_hull_manufacturer = 'home built';
						$post['post_content']          .= sprintf( '<p>builder: %s</p>', $iworks_fleet_hull_manufacturer );
						break;
					case 'Barklay':
					case 'Barclay / Winwood':
						$iworks_fleet_hull_manufacturer = 'Barclay';
						break;
					case 'Clark (Seattle)':
						$iworks_fleet_hull_manufacturer = 'Clark';
						break;
					case 'Schnieder':
						$iworks_fleet_hull_manufacturer = 'Schneider';
						break;
					case 'Copland GBR':
						$iworks_fleet_hull_manufacturer = 'Copland Boats';
						break;
					case 'Fountain-Pajot':
					case 'Fountaine Pajot':
					case 'Fountaine/Pajot':
					case 'Fountaine-Pajot/Illy Brummer':
					case 'Fountaine-Pajot':
						$iworks_fleet_hull_manufacturer = 'Fountain Pajot';
						break;
					case 'Ballenger/Meller':
						$iworks_fleet_hull_manufacturer = 'Ballenger';
						break;
					case 'G;H Marine':
						$iworks_fleet_hull_manufacturer = 'G&H Marine';
						break;
					case 'Pevear/Lindsay':
					case 'Lindsay':
					case 'Lindsay/ Grey':
						$iworks_fleet_hull_manufacturer = 'Mark Lindsay Boatbuilders';
						break;
					case 'Waterat':
						$iworks_fleet_hull_manufacturer = 'Waterat Sailing Equipment';
						break;
					case 'Moore/ Van Landingham':
						$iworks_fleet_hull_manufacturer = 'Moore';
						break;
					case 'Milanes White':
					case 'Milanes&White':
					case 'Milanes':
						$iworks_fleet_hull_manufacturer = 'Milanes & White';
						break;
					case 'Rowsell & Morrison':
					case 'Rowsell; Morrison':
						$iworks_fleet_hull_manufacturer = 'Rowsell and Morrison';
						break;
					case 'Collignon':
						$iworks_fleet_hull_manufacturer = 'Collingnon (CDK)';
						break;
					case 'Rondar(epoxy)':
						$iworks_fleet_hull_manufacturer = 'Rondar';
						break;
					case 'WitchCraft':
						$iworks_fleet_hull_manufacturer = 'Witchcraft';
						break;
					case 'Young Marine Systems':
					case 'Young Marine':
					case 'YMS':
						$iworks_fleet_hull_manufacturer = 'Young Marine Services';
						break;
					case 'Otto':
					case 'Kulmar':
						$iworks_fleet_hull_manufacturer = 'Kulmar / Otto';
						break;
					case 'Fremantle':
					case 'Freemantle':
					case 'Fremantle/XSP':
						$iworks_fleet_hull_manufacturer = 'Fremantle 505';
						break;
					case 'VanMunster/ Pegasus':
					case 'Pegasus':
						$iworks_fleet_hull_manufacturer = 'Van Munster';
						break;
					case 'Segelsport Jess':
						$iworks_fleet_hull_manufacturer = 'JESS Segelsport';
						break;
					case 'Duvosion':
						$iworks_fleet_hull_manufacturer = 'Duvoisin';
						break;
					case 'P&B/ Ovington':
						$iworks_fleet_hull_manufacturer = 'P&B/Ovington';
						break;
					case 'Jess Ovington':
						$iworks_fleet_hull_manufacturer = 'Jess/Ovington';
						break;
				}
				if ( ! array_key_exists( htmlentities( $iworks_fleet_hull_manufacturer ), $hull_manufacturer ) ) {
					$hull_manufacturer[ $iworks_fleet_hull_manufacturer ] = wp_insert_term( $iworks_fleet_hull_manufacturer, $taxonomy_name_manufacturer );
				}
			}
			$post_ID = wp_insert_post( $post );
			wp_set_post_terms( $post_ID, array( $iworks_fleet_hull_manufacturer ), $taxonomy_name_manufacturer );
			/**
			 * owners
			 */
			$owners      = array();
			$owners_file = sprintf(
				'%s/owners/%05d.csv',
				$data_root,
				$iworks_fleet_boat_hull_number
			);
			if ( ( $handle_owner_file = fopen( $owners_file, 'r' ) ) !== false ) {
				if ( $debug ) {
					echo PHP_EOL,'IMPORT: ',$owners_file,PHP_EOL;
				} else {
					int505_echo_dot( $counter, 'file' );
				}
				while ( ( $owner_data = fgetcsv( $handle_owner_file, 0, ',' ) ) !== false ) {
					$names = trim( $owner_data[0] );
					if ( empty( $names ) ) {
						continue;
					}
					/**
					 * type
					 */
					$type = $date_from = $date_to = null;
					if ( isset( $owner_data[1] ) ) {
						$type = trim( $owner_data[1] );
					}
					/**
					 * dates
					 */
					if ( isset( $owner_data[2] ) ) {
						$date_from = int505_import_fix_year( trim( $owner_data[2] ) );
					}
					if ( isset( $owner_data[3] ) ) {
						$date_to = int505_import_fix_year( trim( $owner_data[3] ) );
					}
					/**
					 * owners
					 */
					$persons = preg_split( '/[;\t\,\|]/', $names );
					if ( 1 < sizeof( $persons ) ) {
						$users_ids = array();
						foreach ( $persons  as $name ) {
							$person = get_person_by_name( $name );
							if ( is_object( $person ) ) {
								add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
								$users_ids[] = $person->ID;
							}
						}
						$o = add_more_owners( $users_ids, $date_from, $date_to, $type );
						if ( ! empty( $o ) ) {
							$owners[] = $o;
						}
					} else {
						foreach ( $persons as $name ) {
							$name = trim( $name );
							if ( empty( $name ) ) {
								continue;
							}
							$person = get_person_by_name( $name );
							if ( is_object( $person ) ) {
								add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
								$owners[]    = person( $name, $person, $date_from, $type );
								$users_ids[] = $person->ID;
							} else {
								$owners[] = add_organization( $name, $person, $date_from, $type );
							}
						}
					}
				}
			} else {
				foreach ( array( 6, 7, 8 ) as $index ) {
					if ( empty( $data[ $index ] ) ) {
						continue;
					}
					$data[ $index ] = trim( $data[ $index ] );
					$data[ $index ] = preg_replace( '/\-$/', '', $data[ $index ] );
					if ( empty( $data[ $index ] ) ) {
						continue;
					}
					foreach ( preg_split( '/[;\t\,\|]/', $data[ $index ] ) as $persons ) {
						$persons = trim( $persons );
						if ( empty( $persons ) ) {
							continue;
						}
						/**
						 * set info
						 */
						$date_from = null;
						$type      = null;
						switch ( $index ) {
							case 6:
								$type = 'first';
								break;
							case 7:
								break;
							case 8:
								$type = 'current';
								break;
						}
						/**
						 * check is more than one
						 */
						$persons = preg_split( '/[\&\/]/', $persons );
						if ( 1 < sizeof( $persons ) ) {
							$users_ids = array();
							foreach ( $persons as $name ) {
								$name = trim( $name );
								$name = preg_replace( '/[\-\'`\t ]+$/', '', $name );
								$name = preg_replace( '/^[\-\'`\t ]/', '', $name );
								if ( empty( $name ) ) {
									continue;
								}
								$date_from = int505_person_get_date_from( $name );
								$date_to   = int505_person_get_date_to( $name );
								$person    = get_person_by_name( $name );
								if ( is_object( $person ) ) {
									add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
									$users_ids[] = $person->ID;
								}
							}
							$o = add_more_owners( $users_ids, $date_from, $date_to, $type );
							if ( ! empty( $o ) ) {
								$owners[] = $o;
							}
						} else {
							foreach ( $persons as $name ) {
								$name = trim( $name );
								if ( empty( $name ) ) {
									continue;
								}
								$date_from = int505_person_get_date_from( $name );
								$date_to   = int505_person_get_date_to( $name );
								$person    = get_person_by_name( $name );
								if ( is_object( $person ) ) {
									add_post_meta( $post_ID, $owners_index_field_name, $person->ID );
									$owners[] = person( $name, $person, $date_from, $type );
								} else {
									$owners[] = add_organization( $name, $person, $date_from, $type );
								}
							}
						}
					}
				}
			}
			if ( ! empty( $owners ) ) {
				add_post_meta( $post_ID, $owners_field_name, $owners, true );
			}
		} else {
			int505_echo_dot( $counter, 'fail' );
		}
		$counter++;
	}
	/**
	 * update term  counter
	 */
	$get_terms_args = array(
		'taxonomy'   => $taxonomy_name_manufacturer,
		'fields'     => 'ids',
		'hide_empty' => false,
	);
	$update_terms   = get_terms( $get_terms_args );
	wp_update_term_count_now( $update_terms, $taxonomy_name_manufacturer );
	fclose( $handle );
}

/**
 * Import events
 */
if ( $import_results && ( $handle = fopen( $data_root . '/' . $import_config['events'], 'r' ) ) !== false ) {
	$series = array();
	echo PHP_EOL,'IMPORT: ' . $import_config['events'],PHP_EOL;
	while ( ( $data = fgetcsv( $handle, 0, ',' ) ) !== false ) {
		if ( 1 > intval( $data[0] ) ) {
			continue;
		}
		/*
		[0] => iworks_fleet_result_date_start
		[1] => iworks_fleet_result_date_end
		[2] => post_title
		[3] => iworks_fleet_result_english
		[4] => iworks_fleet_result_number_of_races
		[5] => iworks_fleet_result_number_of_competitors
		[6] => city
		[7] => iworks_fleet_result_organizer
		[8] => iworks_fleet_result_secretary
		[9] => iworks_fleet_result_arbiter
		[10] => iworks_fleet_result_wind_direction
		[11] => iworks_fleet_result_wind_power
		[12] => post_content
		[13] => file
		[14] => iworks_fleet_serie
		[15] => iworks_fleet_result_location
		[16] => country
		[17] => iworks_fleet_result_columns
		 */
		$fields = array(
			0  => 'iworks_fleet_result_date_start',
			1  => 'iworks_fleet_result_date_end',
			2  => 'post_title',
			3  => 'iworks_fleet_result_english',
			4  => 'iworks_fleet_result_number_of_races',
			5  => 'iworks_fleet_result_number_of_competitors',
			6  => 'city',
			7  => 'iworks_fleet_result_organizer',
			8  => 'iworks_fleet_result_secretary',
			9  => 'iworks_fleet_result_arbiter',
			10 => 'iworks_fleet_result_wind_direction',
			11 => 'iworks_fleet_result_wind_power',
			12 => 'post_content',
			13 => 'file',
			14 => 'iworks_fleet_serie',
			15 => 'iworks_fleet_result_location',
			16 => 'country',
			17 => 'iworks_fleet_result_date_added',
			18 => 'iworks_fleet_result_columns',
		);
		foreach ( $fields as $index => $key ) {
			$value = '';
			if ( isset( $data[ $index ] ) ) {
				$value = trim( $data[ $index ] );
				switch ( $key ) {
					case 'iworks_fleet_result_date_start':
					case 'iworks_fleet_result_date_end':
					case 'iworks_fleet_result_date_added':
						$value = strtotime( $value );
						break;
					case 'iworks_fleet_result_number_of_races':
					case 'iworks_fleet_result_number_of_competitors':
						$value = intval( $value );
						break;
				}
			}
			$$key = trim( $value );
		}
		/**
		 * check exit parsing
		 */
		if ( 'exit' === $post_title ) {
			echo 'exit detected' . PHP_EOL;
			break;
		}
		/**
		 * check file
		 */
		$file_name = $file;
		$file      = $data_root . '/results/' . $file;
		if ( ! is_file( $file ) ) {
			printf( 'NO FILE: %s - %s%s', $post_title, $file_name, PHP_EOL );
			continue;
		}
		/**
		 * Check already exists
		 */
		$args  = array(
			'posts_per_page' => -1,
			'fields'         => 'ids',
			'post_type'      => $result_post_type_name,
			'meta_query'     => array(
				'relation' => 'AND',
				array(
					'key'   => 'iworks_fleet_result_date_start',
					'value' => $iworks_fleet_result_date_start,
				),
				array(
					'key'   => 'iworks_fleet_result_date_end',
					'value' => $iworks_fleet_result_date_end,
				),
			),
		);
		$query = new WP_Query( $args );
		if ( 0 < $query->post_count ) {
			add_filter( 'iworks_fleet_result_skip_year_in_title', '__return_true' );
			foreach ( $query->posts as $post_ID ) {
				$test = preg_replace( '/&#8211;/', '-', get_the_title( $post_ID ) );
				$test = preg_replace( '/&amp;/', '&', $test );
				$test = preg_replace( '/&nbsp;/', ' ', $test );
				$test = preg_replace( '/&#8217;/', '\'', $test );
				$test = preg_replace( '/&#8222;/', '"', $test );
				$test = preg_replace( '/&#8221;/', '"', $test );
				if ( $test === $post_title ) {
					if ( $debug ) {
						echo 'SKIP: ',date( 'y-m-d', $iworks_fleet_result_date_start ), ' ',$post_title,PHP_EOL;
					}
					continue 2;
				}
			}
			remove_filter( 'iworks_fleet_result_skip_year_in_title', '__return_true' );
		}
		echo $post_title,PHP_EOL;
		echo 'FILE: ' . $file_name,PHP_EOL;
		$post_array = array(
			'post_name'   => sanitize_title(
				sprintf(
					'%s-%s',
					date( 'Y-m', $iworks_fleet_result_date_start ),
					empty( $iworks_fleet_result_english ) ? $post_title : $iworks_fleet_result_english
				)
			),
			'post_type'   => $result_post_type_name,
			'post_status' => 'publish',
			'meta_input'  => array(),
			'tax_input'   => array(
				'iworks_fleet_serie'    => array(),
				'iworks_fleet_location' => array(),
			),
		);
		foreach ( $fields as $field ) {
			if ( empty( $$field ) ) {
				continue;
			}
			if ( preg_match( '/^post_/', $field ) ) {
				$post_array[ $field ] = $$field;
				continue;
			}
			if ( preg_match( '/^iworks_/', $field ) ) {
				if ( 'iworks_fleet_serie' === $field ) {
					if ( empty( $$field ) ) {
						continue;
					}
					foreach ( explode( ',', $$field ) as $serie ) {
						handle_serie_taxonomy( $serie, $series, $post_array );
					}
					continue;
				}
				$post_array['meta_input'][ $field ] = $$field;
			}
			switch ( $field ) {
				case 'country':
					$post_array['tax_input']['iworks_fleet_location'] = get_country_from_code( $$field );
					break;
			}
		}
		if ( empty( $post_array['post_title'] ) ) {
			continue;
		}
		$post_ID = wp_insert_post( $post_array );
		/**
		 * update taxonomies
		 */
		foreach ( $post_array['tax_input'] as $taxonomy => $terms ) {
			wp_set_object_terms( $post_ID, $terms, $taxonomy );
		}
		/**
		 * try to set thumbnail
		 */
		foreach ( array( 'jpg', 'png', 'gif' ) as $extenstion ) {
			$thumbnail_file = preg_replace( '/csv$/', $extenstion, $file );
			if ( is_file( $thumbnail_file ) ) {
				$attach_id = 0;
				$filename  = basename( $thumbnail_file );
				$args      = array(
					'post_type'      => 'attachment',
					'post_status'    => 'inherit',
					'meta_key'       => '_import_name',
					'meta_value'     => $filename,
					'posts_per_page' => 1,
					'fields'         => 'ids',
				);
				$img_query = new WP_Query( $args );
				if ( ! empty( $img_query->posts ) ) {
					$attach_id = $img_query->posts[0];
				}
				/**
				 * file not exists, import it
				 */
				if ( 1 > $attach_id ) {
					$image_data = file_get_contents( $thumbnail_file );
					$upload_dir = wp_upload_dir( date( 'Y/m', $iworks_fleet_result_date_end ) );
					$thumbnail  = $upload_dir['basedir'] . '/' . $filename;
					if ( wp_mkdir_p( $upload_dir['path'] ) ) {
						$thumbnail = $upload_dir['path'] . '/' . $filename;
					}
					file_put_contents( $thumbnail, $image_data );
					$filetype   = wp_check_filetype( $thumbnail, null );
					$attachment = array(
						'guid'           => basename( $thumbnail ),
						'post_mime_type' => $filetype['type'],
						'post_title'     => $post_title,
						'post_content'   => '',
						'post_status'    => 'inherit',
					);
					$attach_id  = wp_insert_attachment( $attachment, $thumbnail, $post_ID );
					add_post_meta( $attach_id, '_import_name', basename( $thumbnail ), true );
					$attach_data = wp_generate_attachment_metadata( $attach_id, $thumbnail );
					wp_update_attachment_metadata( $attach_id, $attach_data );
				}
				set_post_thumbnail( $post_ID, $attach_id );
			}
		}

		/**
		 * import results
		 */
		if ( ( $handle2 = fopen( $file, 'r' ) ) !== false ) {
			$regatta_data = array();
			while ( ( $d = fgetcsv( $handle2, 0, ',' ) ) !== false ) {
				$regatta_data[] = $d;
			}
			fclose( $handle2 );
			if ( empty( $regatta_data ) ) {
				echo ' - EMPTY FILE!',PHP_EOL;
			} else {
				echo PHP_EOL;
				echo 'Begin import, rows: ', count( $regatta_data ) ,PHP_EOL;
				do_action( 'iworks_fleet_result_import_data', $post_ID, $regatta_data );
			}
		}
		echo PHP_EOL;
	}
}

echo PHP_EOL,PHP_EOL;
