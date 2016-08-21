<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
  public function test ($pathToSelenium = '~/selenium.jar')
  {
    $this->taskServer(8080)
      ->background()
      ->dir('public')
      ->run();
    $this->taskPHPUnit()
      ->run();
  }

  public function serve ()
  {
    $this->taskServer(8080)
      ->dir('public')
      ->run();
  }
}
