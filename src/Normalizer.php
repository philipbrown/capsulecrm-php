<?php namespace PhilipBrown\CapsuleCRM;

class Normalizer {

  /**
   * The Model instance
   *
   * @var PhilipBrown\CapsuleCRM\Model
   */
  protected $model;

  /**
   * The options array
   *
   * @var array
   */
  protected $options;

  /**
   * The root of the entity
   *
   * @var array|string
   */
  protected $root;

  /**
   * Create a new Normalizer instance
   *
   * @param PhilipBrown\CapsuleCRM\Model $model
   * @param array $options
   * @return void
   */
  public function __construct(Model $model, array $options = [])
  {
    $this->model = $model;
    $this->options = $options;
  }

  /**
   * Normalize a single model
   *
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  public function model(array $attributes)
  {
    if($this->hasSubclasses())
    {
      return $this->normalizeSubclass($attributes);
    }
  }

  /**
   * Normalize a collection of models
   *
   * @param array $attributes
   * @return Illuminate\Support\Collection
   */
  public function collection(array $attributes){}

  /**
   * Get the root of the entity
   *
   * @return array|string
   */
  private function root()
  {
    if($this->root)
    {
      return $this->root;
    }

    if(isset($options['root']))
    {
      return $this->root = $options['root'];
    }

    return $this->root = $this->model->serializableOptions()['root'];
  }

  /**
   * Normalize a subclass
   *
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  protected function normalizeSubclass(array $attributes)
  {
    reset($attributes);

    $key = key($attributes);

    return $this->createNewModelInstance($key, $attributes[$key]);
  }

  /**
   * Create a new model
   *
   * @param string $name
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  protected function createNewModelInstance($name, array $attributes)
  {
    $class = ucfirst($name);

    $class = "PhilipBrown\CapsuleCRM\\$class";

    $attributes = Helper::toSnakeCase($attributes);

    return new $class($this->model->connection(), $attributes);
  }

  /**
   * Check to see if the entity has subclasses
   *
   * @return bool
   */
  protected function hasSubclasses()
  {
    return is_array($this->root());
  }

}
