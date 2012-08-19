<?php
/**
 * Tests for functions.php
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */

require_once 'simpletest/autorun.php';
require_once '../lib/functions.php';

class FunctionsTest extends UnitTestCase {

  # Test remove_trailing_slashes()
  function test_remove_trailing_slashes() {
    $tests = array(
      array(
        'test' => 'http://example.com/',
        'expected' => 'http://example.com',
        'recursive' => false
      ),
      array(
        'test' => 'http://example.com/',
        'expected' => 'http://example.com',
        'recursive' => true
      ),
      array(
        'test' => 'http://example.com/foo/bar',
        'expected' => 'http://example.com/foo/bar',
        'recursive' => false
      ),
      array(
        'test' => 'http://example.com/foo//',
        'expected' => 'http://example.com/foo/',
        'recursive' => false
      ),
      array(
        'test' => 'http://example.com/foo//',
        'expected' => 'http://example.com/foo',
        'recursive' => true
      )
    );

    foreach ( $tests as $test ) {
      $this->assertEqual( remove_trailing_slashes( $test['test'], $test['recursive'] ), $test['expected'] );
    }
  }

  # Test get_feed_permalink()
  function test_feed_permalink() {
    $permalinks = array(
      'default' => get_feed_permalink(),
      'xkcd' => get_feed_permalink( 'xkcd' )
    );

    foreach ( $permalinks as $permalink ) {
      $this->assertTrue( strpos( $permalink, $_SERVER['HTTP_HOST'] ) === 0 );
    }
    $this->assertNotEqual( $permalinks['default'], $permalinks['xkcd'] );
  }
}
?>