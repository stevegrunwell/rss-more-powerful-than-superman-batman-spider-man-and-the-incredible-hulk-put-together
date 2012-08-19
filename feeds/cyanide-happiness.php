<?php
/**
 * Title: Cyanide and Happiness
 * URL: http://www.explosm.net/comics/
 * Description: The provided RSS feed doesn't have the actual comic, which is lame-sauce. The RSS feed also includes non-comic content, which I'm not as interested in. This version will grab only the comics (category == comics), load the page, parse out the comic, and return it in the feed
 *
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

$feed = 'http://feeds.feedburner.com/Explosm';
$xml = new SimpleXMLElement( $feed, 0, true );

function get_cyanide_happiness_comic( $url, $alt="" ){
  $html = file_get_contents( $url );
  return ( preg_match( '/\[img\](.+)\[\/img\]/i', $html, $matches ) ? $matches['1'] : false );
}

?>

<channel>
  <title>Cyanide and Happiness</title>
  <atom:link href="<?php feed_permalink(); ?>" rel="self" type="application/rss+xml" />
  <link><?php echo $xml->channel->link; ?></link>
  <description><?php echo $xml->channel->description; ?></description>
  <lastBuildDate><?php echo date( 'r' ); ?></lastBuildDate>
  <language><?php echo $xml->channel->language; ?></language>
<?php foreach ( $xml->channel->item as $i ) : ?>
  <?php if ( strtolower( $i->category ) == 'comics' ) : ?>
    <?php $comic = get_cyanide_happiness_comic( $i->link, $i->title ); ?>

  <item>
    <title><?php echo $i->title; ?></title>
    <link><?php echo $i->link; ?></link>
    <pubDate><?php echo $i->pubDate; ?></pubDate>
    <guid><?php echo $i->guid; ?></guid>
    <description><?php echo $i->description; ?></description>
    <content:encoded><![CDATA[<?php echo ( $comic ? '<img src="' . $comic . '" alt="' . $i->title . '" />' : 'Could not load comic' ); ?>]]></content:encoded>
  </item>

  <?php endif; ?>
<?php endforeach; ?>
</channel>