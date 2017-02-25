<?php
class Client
{
    private $name_client_client;
    private $stylist_id;
    private $id;

    function __construct($name_client, $stylist_id, $id = null)
    {
        $this->name_client = $name_client;
        $this->stylist_id = $stylist_id;
        $this->id = $id;
    }

    function getName()
    {
        return $this->name_client;
    }

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function getId()
    {
        return $this->id;
    }

    function setName($new_name_client)
    {
        $this->name_client = (string) $new_name_client;
    }

    function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO clients (name_client, stylist_id) VALUES ('{$this->getName()}', '{$this->getStylistId()}')");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
            $clients = array();
            foreach($returned_clients as $client) {
                $name_client = $client['name_client'];
                $stylist_id = $client['stylist_id'];
                $id = $client['id'];
                $new_client = new Client($name_client, $stylist_id, $id);
                array_push($clients, $new_client);
            }
            return $clients;
        }

        static function find($search_id)
        {
            $found_client = null;
            $clients = Client::getAll();
            foreach($clients as $client) {
                $client_id = $client->getId();
                if ($client_id == $search_id) {
                    $found_client = $client;
                }
            }
            return $found_client;
        }

        function update($new_name_client)
        {
            $GLOBALS['DB']->exec("UPDATE clients SET name_client = '{$new_name_client}' WHERE id = {$this->getId()};");
            $this->setName($new_name_client);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM clients;");
        }

}
?>
