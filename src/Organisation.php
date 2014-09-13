<?php namespace PhilipBrown\CapsuleCRM;

class Organisation extends Party {

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
   * Create a new instance of the model
   *
   * @param PhilipBrown\CapsuleCRM\Connection $connection
   * @param array $attributes;
   * @return void
   */
  public function __construct(Connection $connection, array $attributes = [])
  {
    parent::__construct($connection);

    $this->fill($attributes);
  }

}
