<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\Findable;
use PhilipBrown\CapsuleCRM\Persistance\Persistable;

class Kase extends Model {

  use Validating;
  use Findable;
  use Serializable;
  use Associations;
  use Persistable;

  /**
   * The model's validation rules
   *
   * @param array
   */
  protected $rules = [
    'name' => 'required'
  ];

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

    $this->persistableConfig = [
      'create' => function ($this){ return 'party/'.$this->party->id.'/kase'; },
    ];

    $this->belongsTo('party');
    $this->belongsTo('track');
  }

}
