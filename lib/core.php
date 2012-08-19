<?php
/**
 * Core functions used by the framework - these will probably not be helpful when constructing feeds
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

/**
 * Parse feed meta information out of the feed header
 *
 * The following values are looked for:
 * - Title: The name of the feed
 * - URL: The feed author's URL
 * - Description: What makes our modified version of the URL different/better than the original?
 *
 * @param str $content The content to parse
 * @return array
 */
function parse_feed_meta( $content ) {
  $keys = array( 'title', 'url', 'description' );
  $meta = array_fill_keys( $keys, '' );

  // We'll only look at the first 2000 characters
  $content = substr( (string) $content, 0, 2000 );

  // Look for our keys
  foreach ( $keys as $k ) {
    if ( preg_match( sprintf( '/%s:\s+([^\\n\\r]+)\\n|\\r/i', $k ), $content, $value ) ) {
      $meta[$k] = trim( $value['1'] );
    }
  }
  return $meta;
}

/**
 * Load the meta information for a given filename
 * Will be empty if the file cannot be found
 *
 * @param str $file The filename to load
 * @return array The array returned by parse_feed_meta()
 * @uses parse_feed_meta()
 */
function get_feed_meta( $file ) {
  if ( file_exists( $file ) ) {
    $content = file_get_contents( $file );

  } else {
    trigger_error( sprintf( 'File does not exist: %s', $file ), E_USER_NOTICE );
    $content = '';
  }

  return parse_feed_meta( $content );
}