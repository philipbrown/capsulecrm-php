<?php namespace PhilipBrown\CapsuleCRM;

class Contacts
{
    /**
     * @var array
     */
    protected $addresses;

    /**
     * @var array
     */
    protected $emails;

    /**
     * @var array
     */
    protected $phones;

    /**
     * @var array
     */
    protected $websites;

    /**
     * Create a new Contacts collection
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->addresses = isset($attributes['addresses']) ? $attributes['addresses'] : [];
        $this->emails    = isset($attributes['emails'])    ? $attributes['emails'] : [];
        $this->phones    = isset($attributes['phones'])    ? $attributes['phones'] : [];
        $this->websites  = isset($attributes['websites'])  ? $attributes['websites'] : [];
    }

    /**
     * Set an array of addresses
     *
     * @param array $addresses
     * @return void
     */
    public function addresses(array $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Set an array of emails
     *
     * @param array $emails
     * @return void
     */
    public function emails(array $emails)
    {
        $this->emails = $emails;
    }

    /**
     * Set an array of phones
     *
     * @param array $phones
     * @return void
     */
    public function phones(array $phones)
    {
        $this->phones = $phones;
    }

    /**
     * Set an array of websites
     *
     * @param array $websites
     * @return void
     */
    public function websites(array $websites)
    {
        $this->websites = $websites;
    }

    /**
     * Convert the Contacts collection to JSON
     *
     * @return string
     */
    public function toJson()
    {
        $body = [
            'address'  => $this->map($this->addresses),
            'email'    => $this->map($this->emails),
            'phone'    => $this->map($this->phones),
            'website'  => $this->map($this->websites),
        ];

        $body = array_filter($body, function ($item) {
            return count($item);
        });

        return json_encode($body);
    }

    private function map(array $attributes)
    {
        if (count($attributes) == 1) {
            return json_decode($attributes[0]->toJson());
        }

        return array_map(function($obj){ return json_decode($obj->toJson()); }, $attributes);
    }

    /**
     * Dynamically get an attribute
     *
     * @param string $key
     * @return array
     */
    public function __get($key)
    {
        return $this->$key;
    }
}
