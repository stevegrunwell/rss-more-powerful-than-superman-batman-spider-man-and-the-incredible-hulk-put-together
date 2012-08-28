<?php
/**
 * Title: Joy of Tech
 * URL: http://www.geekculture.com/joyoftech
 * Description: Joy of Tech only includes a tiny thumbnail in their RSS feeds. This replaces it with the full comic.
 *
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

$feed = 'http://www.joyoftech.com/joyoftech/jotblog/index.xml';
$xml = new SimpleXMLElement( $feed, 0, true );

/**
 * Replace the thumbnail image with the full comic strip
 * @param str $description The item's <description> element
 * @return str A suitable replacement
 */
function replace_jot_comic( $description ) {
  $description = preg_replace( '/(width|height)="(\d+)"/i', '', $description );
  return str_replace( 'superthumb.gif"', '.gif"', $description );
}

?>

<channel>
  <title><?php echo $xml->channel->title; ?></title>
  <atom:link href="<?php feed_permalink(); ?>" rel="self" type="application/rss+xml" />
  <link><?php echo $xml->channel->link; ?></link>
  <description><?php echo $xml->channel->description; ?></description>
  <lastBuildDate><?php echo date( 'r' ); ?></lastBuildDate>
  <language><?php echo $xml->channel->language; ?></language>
<?php foreach ( $xml->channel->item as $i ) : $comic = replace_jot_comic( $i->description ); ?>

  <item>
    <title><?php echo $i->title; ?></title>
    <link><?php echo $i->link; ?></link>
    <pubDate><?php echo $i->pubDate; ?></pubDate>
    <guid><?php echo $i->guid; ?></guid>
    <description><?php echo $comic; ?></description>
    <content:encoded><![CDATA[<?php echo $comic; ?>]]></content:encoded>
  </item>

<?php endforeach; ?>
</channel>