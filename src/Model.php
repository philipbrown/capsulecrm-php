<?php namespace PhilipBrown\CapsuleCRM;

use Exception;
use PhilipBrown\CapsuleCRM\Meta\Base;

abstract class Model {

  /**
   * The HTTP connection
   *
   * @var PhilipBrown\CapsuleCRM\Connection
   */
  protected $connection;

  /**
   * The model's attributes
   *
   * @var array
   */
  protected $attributes = [];

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [];

  /**
   * Inject the Connection dependency
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @return void
   */
  public function __construct(Connection $connection)
  {
    $this->connection = $connection;
  }

  /**
   * Get the connection instance
   *
   * @return PhilipBrown\CapsuleCRM\Connection
   */
  public function connection()
  {
    return $this->connection;
  }

  /**
   * Fill the entity with an array of attributes.
   *
   * @param array $attributes
   */
  protected function fill(array $attributes)
  {
    foreach ($this->fillableFromArray($attributes) as $key => $value)
    {
      if ($this->isFillable($key))
      {
        $this->setAttribute($key, $value);
      }
    }
  }

  /**
   * Get the fillable attributes of a given array
   *
   * @param array $attributes
   * @return array
   */
  protected function fillableFromArray(array $attributes)
  {
    if (count($this->fillable) > 0)
    {
      return array_intersect_key($attributes, array_flip($this->fillable));
    }

    return $attributes;
  }

  /**
   * Determine if the given attribute may be mass assigned
   *
   * @param string $key
   * @return bool
   */
  protected function isFillable($key)
  {
    if (in_array($key, $this->fillable)) return true;
  }

  /**
   * Set attribute on object
   *
   * @param string $key
   * @param string $mixed
   * @return void
   */
  protected function setAttribute($key, $value)
  {
    $this->attributes[$key] = $value;
  }

  /**
   * Return the base meta class
   *
   * @return PhilipBrown\CapsuleCRM\Meta\Base
   */
  public function base()
  {
    return new Base($this);
  }

  /**
   * Dynamically get an attribute
   *
   * @param string $key
   * @return mixed
   */
  public function __get($key)
  {
    if(isset($this->attributes[$key]))
    {
      return $this->attributes[$key];
    }

    throw new Exception("{$key} is not a valid property");
  }

  /**
   * Dynamically set an attribute.
   *
   * @param string $key
   * @param mixed $value
   * @return mixed
   */
  public function __set($key, $value)
  {
    if($this->isFillable($key))
    {
      return $this->setAttribute($key, $value);
    }

    throw new Exception("{$key} is not a valid property");
  }

}
