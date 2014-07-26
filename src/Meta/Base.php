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
    return $this->getNameInstance()->lowercase();
  }

  /**
   * Convert the name to uppercase
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function uppercase()
  {
    return $this->getNameInstance()->uppercase();
  }

  /**
   * Convert the name to plural
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function plural()
  {
    return $this->getNameInstance()->plural();
  }

  /**
   * Convert the name to singular
   *
   * @return PhilipBrown\CapsuleCRM\Meta\ClassName
   */
  public function singular()
  {
    return $this->getNameInstance()->singular();
  }

  /**
   * Create new Name instance
   *
   * @return PhilipBrown\CapsuleCRM\Meta\Name
   */
  protected function getNameInstance()
  {
    return new Name($this->reflection->getShortName());
  }


}
