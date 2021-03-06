<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\FindAll;
use PhilipBrown\CapsuleCRM\Querying\Configuration;

class Country extends Model {

  use FindAll;
  use Configuration;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'name'
  ];

  /**
   * The model's serializble config
   *
   * @var array
   */
  protected $serializableConfig = [
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

    $this->fill($attributes);
  }

}
