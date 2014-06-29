<?php

use PhilipBrown\CapsuleCRM\Meta\Name;

class MetaNameTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->name = new Name('Person');
  }

  public function testNameToLowercase()
  {
    $this->assertEquals('person', $this->name->lowercase());
  }

  public function testNameToUpperCase()
  {
    $this->assertEquals('PERSON', $this->name->uppercase());
  }

  public function testNameToPlural()
  {
    $this->assertEquals('People', $this->name->plural());
  }

  public function testNameToSingular()
  {
    $this->assertEquals('Person', $this->name->singular());
  }

  public function testChainedModifiers()
  {
    $this->assertEquals('people', $this->name->lowercase()->plural());
  }

}
