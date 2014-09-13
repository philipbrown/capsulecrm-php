<?php namespace PhilipBrown\CapsuleCRM;

trait Contactable
{
    /**
     * @var Contacts
     */
    private $contacts;

    /**
     * Add Contacts
     *
     * @param Contacts $contact
     * @return void
     */
    public function addContacts(Contacts $contacts)
    {
        $this->contacts = $contacts;
    }

    /**
     * Get Contacts
     *
     * @return Contacts
     */
    public function contacts()
    {
        return $this->contacts;
    }
}
