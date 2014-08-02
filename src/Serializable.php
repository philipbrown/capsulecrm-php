<?php namespace PhilipBrown\CapsuleCRM;

trait Serializable {

  /**
   * An array of serializable options
   *
   * @var array
   */
  protected $serializableOptions = [
    'include_root'        => true,
    'additional_methods'  => []
  ];

  /**
   * Return the serializable options
   *
   * @return array
   */
  public function serializableOptions()
  {
    return array_merge($this->serializableOptions, $this->serializableConfig);
  }

}
