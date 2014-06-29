<?php namespace PhilipBrown\CapsuleCRM\Meta;

use Illuminate\Support\Pluralizer;

class Name {

  /**
   * The class name
   *
   * @var string
   */
  protected $name;

  /**
   * Create a new ClassName instance
   *
   * @param string $name
   * @return void
   */
  public function __construct($name)
  {
    $this->name = $name;
  }

  /**
   * Convert the name to lowercase
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function lowercase()
  {
    return new Name(strtolower($this->name));
  }

  /**
   * Convert the name to uppercase
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function uppercase()
  {
    return new Name(strtoupper($this->name));
  }

  /**
   * Convert the name to plural
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function plural()
  {
    return new Name(Pluralizer::plural($this->name));
  }

  /**
   * Convert the name to singular
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function singular()
  {
    return new Name(Pluralizer::singular($this->name));
  }

  /**
   * Return the name as a string
   *
   * @return string
   */
  public function __toString()
  {
    return $this->name;
  }

}
