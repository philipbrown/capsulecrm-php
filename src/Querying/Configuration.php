<?php namespace PhilipBrown\CapsuleCRM\Querying;

trait Configuration {

  /**
   * Return an instance of the Options object
   *
   * @return PhilipBrown\CapsuleCRM\Querying\Options
   */
  public function queryableOptions()
  {
    return new Options($this);
  }

}
