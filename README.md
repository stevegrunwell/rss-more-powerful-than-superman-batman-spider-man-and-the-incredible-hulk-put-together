# RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together

Sometimes the RSS feeds generated by your favorite sites don't quite fit the way you want to use them. Maybe they're only excerpts and the real site is terrible on a mobile browser. Maybe they contain everything you're looking for but don't want to view source to read the "mouseover text" on a panel.

This isn't trying to divert traffic or circumvent ads - I'm just sick of always having to click through to m.xkcd.com to read the comics' `title` attribute. If you want to create your own versions of different RSS feeds, feel free to use my code as a template, host it on your own server, and take control of your reading experience.

## How to create a feed

The easiest way to start is to copy feeds/sample-feed.php, rename it to the slug you want to use for your feed, and start updating it from there.

### Anatomy of a feed

Within every feed file there should be a comment block somewhere within the first 2000 characters that defines the feed's meta information:

* **Title:** - The name of this feed
* **URL:** The site that generated the original RSS feed
* **Description:** What makes your version of the feed different from the original?

After that, we use the SimpleXML library (PHP 5, usually enabled by default) to parse the RSS feed and create a new `<channel>` XML element. The channel includes the RSS feed's name, URL, build date, description, and a series of `<item>` elements which contain the individual RSS items.

Your template will most likely look something like this:

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