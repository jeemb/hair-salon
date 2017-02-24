<?php
class Stylist
{
    private $name;
    private $phone;
    private $address;
    Private $id;

    function __construct($name, $phone, $address, $id = null)
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->address = $address;
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
            $GLOBALS['DB']->exec("INSERT INTO stylists (name, phone, address) VALUES ('{$this->getName()}', '{$this->getPhone()}', '{$this->getAddress()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
            $stylists = array();
            foreach($returned_stylists as $stylist) {
                $name = $stylist['name'];
                $phone = $stylist['phone'];
                $address = $stylist['address'];
                $id = $stylist['id'];
                $new_stylist = new Stylist($name, $phone, $address, $id);
                array_push($stylists, $new_stylist);
            }
            return $stylists;
        }

        static function find($search_id)
        {
            $found_stylist = null;
            $stylists = Stylist::getAll();
            foreach($stylists as $stylist) {
                $stylist_id = $stylist->getId();
                if ($stylist_id == $search_id) {
                    $found_stylist = $stylist;
                }
            }
            return $found_stylist;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM stylists;");
          $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
        }

}
?>
