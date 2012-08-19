<?php
/**
 * Title: My sample feed
 * URL: http://example.com
 * Description: A sample feed to get you started
 *
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

$feed = 'http://example.com/rss.xml';
$xml = new SimpleXMLElement( $feed, 0, true );

/** Begin your custom feed functions here */

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
  </item>

<?php endforeach; ?>
</channel>