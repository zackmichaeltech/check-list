<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
  /**
   * Run unit and acceptance tests
   * @param  string $pathToSelenium Path to Selenium jar
   * @return void
   */
  public function test ($pathToSelenium = '~/selenium.jar')
  {
    // $this->taskServer(8080)
    //   ->background()
    //   ->dir('public')
    //   ->run();
    $this->taskPHPUnit()
      ->run();
  }

  /**
   * Start a local server
   * @return void
   */
  public function serve ()
  {
    $this->taskServer(8080)
      ->dir('public')
      ->background()
      ->run();
    $this->taskWatch()
      ->monitor('assets', function () {
        $this->assets();
      })
      ->monitor('src', function () {
        $this->test();
      })
      ->monitor('tests', function () {
        $this->test();
      })
      ->run();
  }

  /**
   * Process assets
   * @return void
   */
  public function assets ()
  {
    $this->taskLess([
        'assets/less/default.less' => 'public/css/default.css'
      ])
      ->importDir('assets/less')
      ->compiler('lessphp')
      ->run();

    $this->taskMinify('public/css/default.css')
      ->run();
  }
}
