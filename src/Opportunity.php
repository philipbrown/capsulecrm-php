<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Querying\Findable;
use PhilipBrown\CapsuleCRM\Persistance\Persistable;

class Opportunity extends Model {

  use Findable;
  use Validating;
  use Associations;
  use Serializable;
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
    'name',
    'description',
    'party_id',
    'currency',
    'value',
    'duration_basis',
    'duration',
    'expected_close_date',
    'milestone',
    'milestone_id',
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
    $this->connection = $connection;

    $this->fill($attributes);

    $this->persistableConfig = [
      'create' => function ($this){ return 'party/'.$this->party->id.'/opportunity'; },
    ];

    $this->belongsTo('party');
    $this->belongsTo('milestone');
    $this->belongsTo('track');
  }

}
