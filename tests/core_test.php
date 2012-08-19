<?php
/**
 * Tests for lib/core.php
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

require_once 'simpletest/autorun.php';
require_once '../lib/core.php';

class CoreTest extends UnitTestCase {

  # Test parse_feed_meta()
  function test_parse_feed_meta() {

    // The most basic of tests - can we parse this simple information?
    $comment = "Title: Lorem ipsum\nURL: http://example.com\nDescription: Foo bar baz\n";
    $meta = parse_feed_meta( $comment );

    $this->assertIsA( $meta, 'array' );
    $this->assertEqual( count( $meta ), 3 );
    $this->assertEqual( $meta['title'], 'Lorem ipsum' );
    $this->assertEqual( $meta['url'], 'http://example.com' );
    $this->assertEqual( $meta['description'], 'Foo bar baz' );

    // Make sure we're not worried about spacing or capitalization
    $comment = "Title:  Lorem ipsum\nURL: http://example.com    \nDESCRIPTION: Foo bar baz\n";
    $meta = parse_feed_meta( $comment );

    $this->assertIsA( $meta, 'array' );
    $this->assertEqual( count( $meta ), 3 );
    $this->assertEqual( $meta['title'], 'Lorem ipsum' );
    $this->assertEqual( $meta['url'], 'http://example.com' );
    $this->assertEqual( $meta['description'], 'Foo bar baz' );
  }

  # Test get_feed_meta()
  function test_get_feed_meta() {
    $meta = get_feed_meta( dirname( __FILE__ ) . '/mock-objects/feed.php' );
    $this->assertEqual( $meta['title'], 'A mock feed' );
    $this->assertEqual( $meta['url'], 'http://example.com' );
    $this->assertEqual( $meta['description'], 'This feed is only intended to be a mock object' );
  }
}
?>