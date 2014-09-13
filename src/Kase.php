<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\Findable;

class Kase extends Model {

  use Findable;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'status',
    'name',
    'description',
    'party_id',
    'owner',
    'created_on',
    'updated_on'
  ];

  /**
   * The model's queryable options
   *
   * @var array
   */
  protected $queryableOptions = [
    'plural' => 'kase'
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
