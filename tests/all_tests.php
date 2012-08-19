<?php
/**
 * Main test suite - run all tests
 * @package RSS More Powerful Than Superman, Batman, Spider-Man, and the Incredible Hulk Put Together
 */
require_once 'simpletest/autorun.php';

class AllTests extends TestSuite {
  function AllTests() {
    $this->TestSuite( 'All tests' );
    $this->addFile( 'core_test.php' );
    $this->addFile( 'functions_test.php' );
  }
}

?>