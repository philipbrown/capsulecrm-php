<?php

use PhilipBrown\CapsuleCRM\Meta\Name;

class MetaNameTest extends PHPUnit_Framework_TestCase {

  /** @test PhilipBrown\CapsuleCRM\Meta\Name */
  private $name;

  public function setUp()
  {
    $this->name = new Name('Person');
  }

  /** @test */
  public function should_convert_to_lowercase()
  {
    $this->assertEquals('person', $this->name->lowercase());
  }

  /** @test */
  public function should_convert_to_uppercase()
  {
    $this->assertEquals('PERSON', $this->name->uppercase());
  }

  /** @test */
  public function should_convert_plural()
  {
    $this->assertEquals('People', $this->name->plural());
  }

  /** @test */
  public function should_convert_to_singular()
  {
    $this->assertEquals('Person', $this->name->singular());
  }

  /** @test */
  public function modifiers_should_be_chainable()
  {
    $this->assertEquals('people', $this->name->lowercase()->plural());
  }

}
