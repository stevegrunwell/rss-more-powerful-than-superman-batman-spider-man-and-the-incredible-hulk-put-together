<?php
/**
 * Index of available RSS feeds
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

require_once 'lib/functions.php';

?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together</title>
<style type="text/css">
html, body { max-width: 980px; margin: 0 auto; font-family: sans-serif; }
body { padding: 2% 4%; }
ul { margin: 0; padding: 0; list-style: none; }
li { margin-bottom: 1.8em; }
.feed-title, .source-link { display: block; font-weight: bold; }
.source-link { font-size: .8em; text-transform: lowercase; }
</style>
</head>
<body>
  <h1>RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together</h1>
  <ul>
  <?php foreach ( glob( 'feeds/*.php' ) as $feed ) : $meta = get_feed_meta( dirname( __FILE__) . '/' . $feed ); ?>
    <?php if ( basename( $feed ) === 'sample-feed.php' ) continue; // Skip sample-feed.php ?>
    <li>
      <a href="<?php echo get_feed_permalink( basename( $feed, '.php' ) ); ?>" class="feed-title"><?php echo $meta['title']; ?></a>
      <?php echo $meta['description']; ?>
      <?php if ( filter_var( $meta['url'], FILTER_VALIDATE_URL ) ) : ?>
        <a href="<?php echo $meta['url']; ?>" class="source-link" rel="external">Visit site</a>
      <?php endif; ?>
    </li>
  <?php endforeach; ?>
  </ul>
</body>
</html>
