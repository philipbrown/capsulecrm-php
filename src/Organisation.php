<?php namespace PhilipBrown\CapsuleCRM;

use PhilipBrown\CapsuleCRM\Persistance\Persistable;

class Organisation extends Party {

  use Persistable;
  use Validating;
  use Contactable;

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
    'root' => 'organisation',
    'additional_methods' => ['contacts']
  ];

  /**
   * Create a new instance of the model
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection, array $attributes = [])
  {
    parent::__construct($connection);

    $this->contacts = new Contacts;

    $this->fill($attributes);

    $this->persistableConfig = [
      'create' => function () { return "organisation"; },
      'update' => function () { return "organisation/$this->id"; },
      'delete' => function () { return "party/$this->id"; }
    ];
  }

}
