<?php

use PhilipBrown\CapsuleCRM\Helper;

class HelperTest extends PHPUnit_Framework_TestCase {

  public function testToSnakeCaseMethod()
  {
    $attributes = Helper::toSnakeCase([
      'firstName' => 'Philip Brown'
    ]);

    reset($attributes);

    $this->assertEquals('first_name', key($attributes));
  }

  public function testToCamelCaseMethod()
  {
    $attributes = Helper::toCamelCase([
      'first_name' => 'Philip Brown'
    ]);

    reset($attributes);

    $this->assertEquals('firstName', key($attributes));
  }

}
