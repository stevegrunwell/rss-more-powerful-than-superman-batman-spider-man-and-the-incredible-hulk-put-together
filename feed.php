<?php
/**
 * Feed controller - load an individual feed (from /feeds/), capture the output buffer, and output the whole thing
 * as an RSS feed
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */


require_once dirname( __FILE__ ) . '/lib/functions.php';

if ( $feed = ( isset( $_GET['feed'] ) ? sprintf( '%s/feeds/%s.php', dirname( __FILE__ ), basename( $_GET['feed'] ) ) : false ) ) {
  ob_start();
  if ( file_exists( $feed ) ) {
    include $feed;
  }
  $xml = ob_get_contents();
  ob_end_clean();
}

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";

?><rss version="2.0"
xmlns:content="http://purl.org/rss/1.0/modules/content/"
xmlns:dc="http://purl.org/dc/elements/1.1/"
xmlns:atom="http://www.w3.org/2005/Atom">
<?php echo $xml; ?>
</rss>