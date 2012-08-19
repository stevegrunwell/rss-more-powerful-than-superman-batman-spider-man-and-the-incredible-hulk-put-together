<?php
/**
 * Basic utility functions to help with building RSS feeds
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

require_once dirname( __FILE__ ) . '/core.php';

/**
 * Remove trailing slashes from a string
 * @param str $str A string or path to work on
 * @return str
 */
function remove_trailing_slashes( $str, $recursive=false ) {
  if ( $recursive ) {
    while ( substr( $str, -1, 1 ) === '/' ) {
      $str = substr( $str, 0, -1 );
    }
  } else {
    $str = ( substr( $str, -1, 1 ) === '/' ? substr( $str, 0, -1 ) : $str );
  }
  return $str;
}

/**
 * Return the permalink for the current feed
 * @global $_SERVER
 * @global $_GET
 * @return str
 * @uses remove_trailing_slashes()
 */
function get_feed_permalink( $feed='' ) {
  $path = remove_trailing_slashes( $_SERVER['HTTP_HOST'] . dirname( $_SERVER['REQUEST_URI'] ), true );
  $feed = ( $feed != '' ? basename( $feed ) : remove_trailing_slashes( ( isset( $_GET['feed'] ) ? $_GET['feed'] : basename( __FILE__ ) ) ) );
  return sprintf( '%s/%s', $path, $feed );
}

/** Shortcut for 'echo get_feed_permalink()' */
function feed_permalink( $feed='' ) {
  echo get_feed_permalink( $feed );
}

?>