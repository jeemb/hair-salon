<?php
class Client
{
    private $name;
    private $phone;
    private $address;
    private $stylist_id;
    private $id;

    function __construct($name, $phone, $address, $stylist_id, $id = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getAddress()
    {
        return $this->address;
    }

    function getStylistId()
    {
        return $this->stylistId;
    }

    function getId()
    {
        return $this->id;
    }

    function setName($new_name)
    {
        $this->name = (string) $new_name;
    }

    function setPhone($new_phone)
    {
        $this->phone = (string)$new_phone;
    }

    function setAddress($new_address)
    {
        $this->address = (string) $new_address;
    }
}
?>
