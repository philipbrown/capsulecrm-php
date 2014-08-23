<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\Findable;

class Task extends Model {

  use Findable;
  use Serializable;

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'description',
    'detail',
    'category',
    'due_date',
    'owner',
    'party_id',
    'party_name',
    'status'
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
