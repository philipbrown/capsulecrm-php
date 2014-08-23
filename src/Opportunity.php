<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\Findable;

class Opportunity extends Model {

  use Findable;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'name',
    'description',
    'party_id',
    'currency',
    'value',
    'duration_basis',
    'duration',
    'expected_close_date',
    'milestone_id',
    'milestone',
    'probability',
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
    'plural' => 'opportunity'
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
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
