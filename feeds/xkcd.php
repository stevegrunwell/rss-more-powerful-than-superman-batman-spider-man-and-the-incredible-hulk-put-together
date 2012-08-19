<?php
/**
 * Title: xkcd
 * URL: http://xkcd.com
 * Description: The original feed didn't display the "mouseover text" for each comic, forcing users to open it in the browser. We're simply adding the text underneath the comic
 *
 * @package
 */

$feed = 'http://xkcd.com/rss.xml';
$xml = new SimpleXMLElement( $feed, 0, true );

/** Begin your custom feed functions here */

/**
 * Attempt to parse the title attribute out of the xkcd content and append it to the content, wrapped in <em> tags
 * @param str $description The item's description element
 * @return str
 */
function format_xkcd( $description ) {
  if ( preg_match( '/title="([^"]+)"/i', $description, $title ) ) {
    $description .= '<br /><br /><em>' . $title['1'] . '</em>';
  }
  return $description;
}

?>

<channel>
  <title><?php echo $xml->channel->title; ?></title>
  <atom:link href="<?php feed_permalink(); ?>" rel="self" type="application/rss+xml" />
  <link><?php echo $xml->channel->link; ?></link>
  <description><?php echo $xml->channel->description; ?></description>
  <lastBuildDate><?php echo date( 'r' ); ?></lastBuildDate>
  <language><?php echo $xml->channel->language; ?></language>
<?php foreach ( $xml->channel->item as $i ) : ?>

  <item>
    <title><?php echo $i->title; ?></title>
    <link><?php echo $i->link; ?></link>
    <pubDate><?php echo $i->pubDate; ?></pubDate>
    <guid><?php echo $i->guid; ?></guid>
    <description><?php echo $i->description; ?></description>
    <content:encoded><![CDATA[<?php echo format_xkcd( $i->description ); ?>]]></content:encoded>
  </item>

<?php endforeach; ?>
</channel>