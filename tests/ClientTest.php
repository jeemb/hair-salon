<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Client::deleteAll();
          Stylist::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name = "Rob";
            $phone = "43";
            $address = "450";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $address, $stylist_id, $id);
            $test_client->save();

            //Act
            $result = $test_client->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name = "Rob";
            $phone = "43";
            $address = "450";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name, $phone, $address, $stylist_id, $id);
            $test_client->save();

            //Act
            $result = $test_client->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCuisineId()
        {
            //Arrange
            $test_stylist = new Stylist("Mary", "55", "400 SW", $id = null);
            $test_stylist->save();

            $stylist_id = $test_stylist->getId();
            $test_client = new client("Fred", "45", "400", $stylist_id, $id = null);
            $test_client->save();
            //Act
            $result = $test_client->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_save()
            {
                //Arrange
                $name = "Bob";
                $phone = "44";
                $address = "400";
                $id = null;
                $test_stylist = new Stylist($name, $phone, $address, $id);
                $test_stylist->save();

                $name_client = "Rob";
                $id = null;
                $stylist_id = $test_stylist -> getId();
                $test_client = new Client($name_client, $stylist_id, $id);
                $test_client->save();

                //Act
                $result = Client::getAll();

                //Assert
                $this->assertEquals($test_client, $result[0]);
            }

        function test_getAll()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name_client = "Rob";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name_client, $stylist_id, $id);
            $test_client->save();

            $name2 = "Bob";
            $phone2 = "44";
            $address2 = "400";
            $id = null;
            $test_stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_stylist2->save();

            $name_client2 = "Rob";
            $id = null;
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name_client2, $stylist_id2, $id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name_client = "Rob";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name_client, $stylist_id, $id);
            $test_client->save();

            $name2 = "Bob";
            $phone2 = "44";
            $address2 = "400";
            $id = null;
            $test_stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_stylist2->save();

            $name_client2 = "Rob";
            $id = null;
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name_client2, $stylist_id2, $id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name_client = "Joe";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name_client, $stylist_id, $id);
            $test_client->save();

            $name2 = "Mary";
            $phone2 = "44";
            $address2 = "400";
            $id = null;
            $test_stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_stylist2->save();

            $name_client2 = "Margaret";
            $id = null;
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name_client2, $stylist_id2, $id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name_client = "Rob";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name_client, $stylist_id, $id);
            $test_client->save();

            $new_name = "hello";

            //Act
            $test_client->update($new_name);

            //Assert
            $this->assertEquals("hello", $test_client->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $id = null;
            $test_stylist = new Stylist($name, $phone, $address, $id);
            $test_stylist->save();

            $name_client = "Rob";
            $id = null;
            $stylist_id = $test_stylist->getId();
            $test_client = new Client($name_client, $stylist_id, $id);
            $test_client->save();

            $name2 = "Mary";
            $phone2 = "55";
            $address2 = "455";
            $id = null;
            $test_stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_stylist2->save();

            $name_client2 = "Margaret";
            $id = null;
            $stylist_id2 = $test_stylist->getId();
            $test_client2 = new Client($name_client2, $stylist_id2, $id);
            $test_client2->save();

            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([$test_client2], Client::getAll());
        }
    }

?>
