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
   * @return void
   */
  public function __construct(Model $model, array $options = [])
  {
    $this->model = $model;
    $this->options = $options;
  }

  /**
   * Normalize a single model
   *
   * @param array $attributes
   * @return PhilipBrown\CapsuleCRM\Model
   */
  public function model(array $attributes){}

  /**
   * Normalize a collection of models
   *
   * @param array $attributes
   * @return Illuminate\Support\Collection
   */
  public function collection(array $attributes){}

}
