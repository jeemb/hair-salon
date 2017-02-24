<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Stylist::deleteAll();
        //   Client::deleteAll();
        }

        function test_save()
            {
                //Arrange
                $name = "Bob";
                $phone = "44";
                $address = "400";
                $id = null;
                $test_Stylist = new Stylist($name, $phone, $address, $id);
                $test_Stylist->save();

                //Act
                $result = Stylist::getAll();

                //Assert
                $this->assertEquals($test_Stylist, $result[0]);
            }

        function test_getAll()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $name2 = "Robert";
            $phone2 = "55";
            $address2 = "500";
            $id = null;
            $test_Stylist = new Stylist($name, $phone, $address, $id);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_Stylist2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_Stylist, $test_Stylist2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $name2 = "Robert";
            $phone2 = "55";
            $address2 = "500";
            $id = null;
            $test_Stylist = new Stylist($name, $phone, $address, $id);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_Stylist2->save();

            //Act
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $name2 = "Robert";
            $phone2 = "55";
            $address2 = "500";
            $id = null;
            $test_Stylist = new Stylist($name, $phone, $address, $id);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_Stylist2->save();

            //Act
            $result = Stylist::find($test_Stylist->getId());

            //Assert
            $this->assertEquals($test_Stylist, $result);
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

            $new_name = "Robert";

            //Act
            $test_stylist->update($new_name);

            //Assert
            $this->assertEquals("Robert", $test_stylist->getName());
        }

        function testDelete()
        {
            //Arrange
            $name = "Bob";
            $phone = "44";
            $address = "400";
            $name2 = "Robert";
            $phone2 = "55";
            $address2 = "500";
            $id = null;
            $test_Stylist = new Stylist($name, $phone, $address, $id);
            $test_Stylist->save();
            $test_Stylist2 = new Stylist($name2, $phone2, $address2, $id);
            $test_Stylist2->save();

            //Act
            $test_Stylist->delete();

            //Assert
            $this->assertEquals([$test_Stylist2], Stylist::getAll());
        }
    }

?>
