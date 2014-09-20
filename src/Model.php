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
   * The Base meta instance
   *
   * @var PhilipBrown\CapsuleCRM\Meta\Base
   */
  protected $base;

  /**
   * The model's querable options
   *
   * @var array
   */
  protected $queryableOptions = [];

  /**
   * The model's serializable config
   *
   * @var array
   */
  protected $serializableConfig = [];

  /**
   * The model's persistable config
   *
   * @var array
   */
  protected $persistableConfig = [];

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
   * Return the model attributes
   *
   * @param array
   */
  public function attributes()
  {
    return $this->attributes;
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
    if($this->base) return $this->base;

    return $this->base = new Base($this);
  }

  /**
   * Return the queryable options
   *
   * @return array
   */
  public function getQueryableOptions()
  {
    return $this->queryableOptions;
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
  }

}
