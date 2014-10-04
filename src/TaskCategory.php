<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\FindAll;
use PhilipBrown\CapsuleCRM\Querying\Configuration;

class TaskCategory extends Model {

  use FindAll;
  use Configuration;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'name'
  ];

    /**
     * The model's queryable options
     *
     * @var array
     */
    protected $queryableOptions = [
        'plural' => 'task/categories'
    ];

  /**
   * The model's serializble config
   *
   * @var array
   */
  protected $serializableConfig = [
    'root' => 'taskCategory',
    'collection_root' => 'taskCategories',
    'attribute_to_assign' => 'name'
  ];

  /**
   * Create a new instance of the model
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection,  array $attributes = [])
  {
    $this->connection = $connection;

    if (isset($attributes['name'])) {
      $attributes['id'] = $attributes['name'];
    }

    $this->fill($attributes);
  }

}
