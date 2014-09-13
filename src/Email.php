<?php namespace PhilipBrown\CapsuleCRM;

class Email extends Model
{
    use Serializable;

    /**
     * @var array
     */
    protected $attributes;

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'email_address',
    ];

    /**
    * The serializble config
    *
    * @var array
    */
    protected $serializableConfig = [
        'include_root' => false,
        'exclude_id' => false
    ];

    /**
     * Create a new Email
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->fill($attributes);
    }
}
