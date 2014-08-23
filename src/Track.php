<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\FindAll;
use PhilipBrown\CapsuleCRM\Querying\Configuration;

class Track extends Model {

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
    'description',
    'capture_rule'
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
