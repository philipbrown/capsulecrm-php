<?php namespace PhilipBrown\CapsuleCRM\Meta;

use ReflectionClass;
use PhilipBrown\CapsuleCRM\Model;

class Base {

  /**
   * The ReflectionClass instance
   *
   * @var ReflectionClass
   */
  protected $reflection;

  /**
   * The class to inspect
   *
   * @param PhilipBrown\CapsuleCRM\model $model
   * @return void
   */
  public function __construct(Model $model)
  {
    $this->reflection = new ReflectionClass($model);
  }

  /**
   * Convert the name to lowercase
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function lowercase()
  {
    return new Name(strtolower($this->reflection->getShortName()));
  }

  /**
   * Convert the name to uppercase
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function uppercase()
  {
    return new Name(strtoupper($this->reflection->getShortName()));
  }

  /**
   * Convert the name to plural
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function plural()
  {
    return new Name(Pluralizer::plural($this->reflection->getShortName()));
  }

  /**
   * Convert the name to singular
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function singular()
  {
    return new Name(Pluralizer::singular($this->reflection->getShortName()));
  }

}
