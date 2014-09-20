<?php namespace PhilipBrown\CapsuleCRM;

use Sirius\Validation\Validator;

trait Validating {

  /**
   * The model's validation rules
   *
   * @var array
   */
  protected $rules;

  /**
   * The validation errors
   *
   * @var array
   */
  protected $errors;

  /**
   * Validate the model's properties
   *
   * @return bool
   */
  public function validate()
  {
    $validator = new Validator;

    $validator->add($this->rules);

    if($validator->validate($this->attributes()))
    {
      return true;
    }

    $this->errors = $validator->getMessages();

    return false;
  }

  /**
   * Return the validation errors
   *
   * @return array
   */
  public function errors()
  {
    return $this->errors;
  }

}
