<?php namespace PhilipBrown\CapsuleCRM;

class Normalizer {

  /**
   * The Model instance
   *
   * @var PhilipBrown\CapsuleCRM\Model
   */
  protected $model;

  /**
   * The options array
   *
   * @var array
   */
  protected $options;

  /**
   * Create a new Normalizer instance
   *
   * @param PhilipBrown\CapsuleCRM\Model $model
   * @param array $options
   */
  public function __construct(Model $model, array $options)
  {
    $this->model = $model;
    $this->options = $options;
  }

}
