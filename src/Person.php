<?php namespace PhilipBrown\CapsuleCRM;

class Person extends Party {

  /**
   * The model's fillable attributes
   *
   * @var array
   */
  protected $fillable = [
    'id',
    'first_name',
    'last_name',
    'created_on',
    'updated_on'
  ];

  /**
   * Create a new instance of the Party model
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection, array $attributes =[])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
