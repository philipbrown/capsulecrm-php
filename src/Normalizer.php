<?php namespace PhilipBrown\CapsuleCRM;

use Illuminate\Support\Collection;

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
   * The collection root
   *
   * @var string
   */
  protected $collection_root;

  /**
   * The attribute to assign
   *
   * @var string
   */
  protected $attribute_to_assign;

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

    return $this->normalizeModel($attributes);
  }

  /**
   * Normalize a collection of models
   *
   * @param array $attributes
   * @return Illuminate\Support\Collection
   */
  public function collection(array $attributes)
  {
    if($this->hasSubclasses())
    {
      return $this->normalizeSubclassCollection($attributes);
    }

    return $this->normalizeCollection($attributes);
  }

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

    if(isset($this->options['root']))
    {
      return $this->root = $this->options['root'];
    }

    return $this->root = $this->model->serializableOptions()['root'];
  }

  /**
   * Get the collection root of the entity
   *
   * @return string
   */
  private function collectionRoot()
  {
    if($this->collection_root)
    {
      return $this->collection_root;
    }

    if(isset($options['collection_root']))
    {
      return $this->collection_root = $options['collection_root'];
    }

    return $this->collection_root = $this->model->serializableOptions()['collection_root'];
  }

  /**
   * Normalize a subclass
   *
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  private function normalizeSubclass(array $attributes)
  {
    reset($attributes);

    $key = key($attributes);

    return $this->createNewModelInstance($key, $attributes[$key]);
  }

  /**
   * Normalize a single model
   *
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  private function normalizeModel(array $attributes)
  {
    return $this->createNewModelInstance($this->model->base()->singular(), $attributes[(string) $this->root()]);
  }

  /**
   * Normalize a collection
   *
   * @param array $attributes
   * @return Illuminate\Support\Collection
   */
  private function normalizeCollection(array $attributes)
  {
    $collection = new Collection;

    $type = (string) $this->collectionRoot();
    $root = (string) $this->root();

    if ($this->isAssociativeArray($attributes[$type][$root])) {
      $collection[] = $this->createNewModelInstance($root, $attributes[$type][$root]);
    }

    else {
      foreach($attributes[$type][$root] as $entity)
      {
        if($this->attributeToAssign())
        {
          $collection[] = $this->createNewModelInstance($root, [$this->attributeToAssign() => $entity]);
        }

        else
        {
          $collection[] = $this->createNewModelInstance($root, $entity);
        }
      }
    }

    return $collection;
  }

  /**
   * Normalize a subclass collection
   *
   * @param array $attributes
   * @return Illuminate\Support\Collection
   */
  private function normalizeSubclassCollection($attributes)
  {
    $collection = new Collection;

    foreach($attributes[(string)$this->collectionRoot()] as $key => $value)
    {
      if($this->isAssociativeArray($value))
      {
        $collection[] = $this->createNewModelInstance($key, $value);
      }

      else
      {
        foreach($value as $attributes)
        {
          $collection[] = $this->createNewModelInstance($key, $attributes);
        }
      }
    }

    return $collection;
  }

  /**
   * Create a new model
   *
   * @param string $name
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  private function createNewModelInstance($name, array $attributes)
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
  private function hasSubclasses()
  {
    return is_array($this->root());
  }

  /**
   * Check to see if the array is associative
   *
   * @param array $array
   * @return bool
   */
  private function isAssociativeArray($array)
  {
    return (bool) count(array_filter(array_keys($array), 'is_string'));
  }

  /**
   * Return the attribute to assign
   *
   * @return string
   */
  private function attributeToAssign()
  {
    if($this->attribute_to_assign)
    {
      return $this->attribute_to_assign;
    }

    if(isset($this->model->serializableOptions()['attribute_to_assign']))
    {
      return $this->model->serializableOptions()['attribute_to_assign'];
    }
  }

}
