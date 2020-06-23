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

if ( isset( $_SERVER['SERVER_NAME'] ) ) {
	die( 'not allow with www' );
}

$_SERVER['HTTP_HOST'] = 'int505';

error_reporting( E_ALL );

require '../wp-load.php';

global $wpdb;
$boat_post_type_name             = 'iworks_fleet_boat';
$taxonomy_name_manufacturer = 'iworks_fleet_boat_manufacturer';
$person_post_type_name     = 'iworks_fleet_person';


$hull_manufacturer = array();
$data = get_terms( $taxonomy_name_manufacturer, array( 'hide_empty' => false, ) );
foreach( $data as $one ) {
    $hull_manufacturer[ $one->name ] = $one;
}

$persons = array();

function get_person_by_name( $post_title ) {
    global $persons, $person_post_type_name;
    if ( !isset( $persons[ $post_title ] ) ) {
        $post = get_page_by_title( $post_title, OBJECT, $person_post_type_name );
        l($post);
        die;
    }
}



$rows = array();
if (($handle = fopen("registry.csv", "r")) !== FALSE) {
    while ( ($data = fgetcsv($handle, 0, ",") ) !== FALSE ) {
        if ( 1 > intval( $data[0] ) ) {
            continue;
        }
        $post = get_page_by_title( $data[0], OBJECT, $boat_post_type_name );
        if ( empty( $post ) ) {
            echo '.';
            $post = array(
                'post_status' => 'publish',
                'post_type' => $boat_post_type_name,
                'post_title' => $data[0],
                'post_content' => $data[3],
                'meta_input' => array(),
                'tax_input' => array(),
            );
            if ( 0 < intval( $data[1] ) ) {
                $post['meta_input']['iworks_fleet_boat_build_year'] = intval( $data[1] );
            }
            /**
             * Hull builder
             */
            $hull = trim( $data[2] );

            if ( !empty( $hull ) ) {
                switch( $hull ) {
                case 'Parker/Nab':
                case 'Parker kit':
                case 'Parker launcher':
                case 'Parker-hulled Lindsay':
                case 'Rondar Parker':
                    $hull = 'Parker';
                    break;
                case 'builder':
                case 'Custom homebuilt':
                case 'home-build':
                case 'home-built':
                case 'self-built':
                case 'self-constructed':
                case 'self-made':
                case 'Builder':
                    $hull = 'home built';
                    break;
                case 'Honore Marine':
                case 'Honore Marine GB':
                case 'Honor Marine':
                    $hull = 'Honnor Marine';
                    break;
                case 'Polymec kit':
                    $hull = 'Polymec';
                    break;
                case 'International & Olympic Yachts':
                    $hull = 'International & Olympic Yachts';
                    break;
                case 'new mould (Kyrwood)':
                case 'Kyrwood hull':
                case 'Krywood':
                    $hull = 'Kyrwood';
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
                    $hull = 'home built';
                    $post['post_content'] .= sprintf( '<p>builder: %s</p>', $hull );
                    break;
                case 'Barklay':
                case 'Barclay / Winwood':
                    $hull = 'Barclay';
                    break;
                case 'Clark (Seattle)':
                    $hull = 'Clark';
                    break;
                case 'Schnieder':
                    $hull = 'Schneider';
                    break;
                case 'Copland GBR':
                    $hull = 'Copland Boats';
                    break;
                case 'Fountain-Pajot':
                case 'Fountaine Pajot':
                case 'Fountaine/Pajot':
                case 'Fountaine-Pajot/Illy Brummer':
                case 'Fountaine-Pajot':
                    $hull = 'Fountain Pajot';
                    break;
                case 'Ballenger/Meller':
                    $hull = 'Ballenger';
                    break;
                case 'G;H Marine':
                    $hull = 'G&H Marine';
                    break;
                case 'Pevear/Lindsay':
                case 'Lindsay':
                case 'Lindsay/ Grey':
                    $hull = 'Mark Lindsay Boatbuilders';
                    break;
                case 'Waterat':
                    $hull = 'Waterat Sailing Equipment';
                    break;
                case 'Moore/ Van Landingham':
                    $hull = 'Moore';
                    break;
                case 'Milanes White':
                case 'Milanes&White':
                case 'Milanes':
                    $hull = 'Milanes & White';
                    break;
                case 'Rowsell & Morrison':
                case 'Rowsell; Morrison':
                    $hull = 'Rowsell and Morrison';
                    break;
                case 'Collignon':
                    $hull = 'Collingnon (CDK)';
                    break;
                case 'Rondar(epoxy)':
                    $hull = 'Rondar';
                    break;
                case 'WitchCraft':
                    $hull = 'Witchcraft';
                    break;
                case 'Young Marine Systems':
                case 'Young Marine':
                case 'YMS':
                    $hull = 'Young Marine Services';
                    break;
                case 'Otto':
                case 'Kulmar':
                    $hull = 'Kulmar / Otto';
                    break;
                case 'Fremantle':
                case 'Freemantle':
                case 'Fremantle/XSP':
                    $hull = 'Fremantle 505';
                    break;
                case 'VanMunster/ Pegasus':
                case 'Pegasus':
                    $hull = 'Van Munster';
                    break;
                case 'Segelsport Jess':
                    $hull = 'JESS Segelsport';
                    break;
                case 'Duvosion':
                    $hull = 'Duvoisin';
                    break;
                case 'P&B/ Ovington':
                    $hull = 'P&B/Ovington';
                    break;
                case 'Jess Ovington':
                    $hull = 'Jess/Ovington';
                    break;
                }
                if ( !array_key_exists( htmlentities( $hull ), $hull_manufacturer ) ) {
                    $hull_manufacturer[ $hull ] = wp_insert_term( $hull, $taxonomy_name_manufacturer );
                }
            }
            $post_ID = wp_insert_post( $post );
            //wp_set_post_terms( $post_ID, array( $hull ), $taxonomy_name_manufacturer );
            /**
             * first owner
             */
            if ( ! empty( $data[4] ) ) {
                print_r( $data[4] );
                $person = get_person_by_name( $data[4] );
die;
            }



        }


    }

    /**
     * update term  counter
     */
    $get_terms_args = array(
        'taxonomy' => $taxonomy_name_manufacturer,
        'fields' => 'ids',
        'hide_empty' => false,
    );

    $update_terms = get_terms($get_terms_args);
    wp_update_term_count_now($update_terms, $update_taxonomy);



    fclose($handle);
}

