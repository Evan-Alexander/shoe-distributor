<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/
require_once "src/store.php";

$server = 'mysql:host=localhost:8889;dbname=shoes_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

class StoreTest extends PHPUnit_Framework_TestCase
{

    function test_getStoreName()
    {
        $store_name = "Footlocker";
        $new_store = new Store($store_name);

        $result = $new_store->getStoreName();

        $this->assertEquals($store_name, $result);
    }

    function test_setStoreName()
    {
        $store_name = "Footlocker";
        $new_store = new Store($store_name);

        $store_name2 = "Foot Traffic";
        $new_store->setStoreName($store_name2);

        $result = $new_store->getStoreName();

        $this->assertEquals($store_name2, $result);
    }
    //
    // function test_getId()
    // {
    //     $store_name = "Footlocker";
    //     $id = 2;
    //     $new_store = new Store($store_name, $id);
    //
    //     $result = $new_store->getId();
    //
    //     $this->assertEquals($id, $result);
    // }
}

?>
