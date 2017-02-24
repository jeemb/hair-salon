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

    function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name, phone, address, stylist_id) VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getAddress()}'), '{$this->getStylistId()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name = $client['name'];
                $phone = $client['phone'];
                $address = $client['address'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name, $phone, $address, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Stylist::getAll();
            foreach($clients as $client) {
                $client_id = $client->getId();
                if ($client_id == $search_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

}
?>
