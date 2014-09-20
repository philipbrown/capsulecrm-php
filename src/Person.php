<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Persistance\Persistable;

class Person extends Party {

  use Associations;
  use Persistable;
  use Contactable;
  use Validating;

  /**
   * The model's validation rules
   *
   * @param array
   */
  protected $rules = [
    'first_name' => 'required',
    'last_name' => 'required'
  ];

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'title',
    'first_name',
    'last_name',
    'job_title',
    'organisation_name',
    'about',
    'created_on',
    'updated_on'
  ];

  /**
   * The model's serializble config
   *
   * @var array
   */
  protected $serializableConfig = [
    'collection_root' => 'parties',
    'additional_methods' => ['contacts']
  ];

  /**
   * Create a new instance of the model
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection, array $attributes =[])
  {
    $this->connection = $connection;

    $this->fill($attributes);

    $this->contacts = new Contacts;

    $this->persistableConfig = [
      'create' => function (){ return 'person'; },
      'delete' => function (){ return "party/$this->id"; }
    ];

    $this->belongsTo('organisation');
  }
}
