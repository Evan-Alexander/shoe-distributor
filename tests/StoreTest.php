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
        function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

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

        function test_getId()
        {
            $store_name = "Footlocker";
            $id = 2;
            $new_store = new Store($store_name, $id);

            $result = $new_store->getId();

            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store = new Store($store_name, $id);
            $new_store->save();

            $result = Store::getAll();

            $this->assertEquals([$new_store], $result);
        }

        function test_deleteAll()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $store2 = "Footlocker";
            $id = null;
            $new_store2 = new Store($store2, $id);
            $new_store2->save();

            Store::deleteAll();
            $result = Store::getAll();

            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $store2 = "Footlocker";
            $id = null;
            $new_store2 = new Store($store2, $id);
            $new_store2->save();

            $result = Store::getAll();

            $this->assertEquals([$new_store_name, $new_store2], $result);
        }

        function test_find()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $store2 = "Footlocker";
            $id = null;
            $new_store2 = new Store($store2, $id);
            $new_store2->save();

            $result = Store::find($new_store2->getId());

            $this->assertEquals($new_store2, $result);
        }

        function test_update()
        {
            $store_name = "Foo Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $replacement_name = "Foot Traffic";
            $new_store_name->update($replacement_name);

            $result = $new_store_name->getstoreName();

            $this->assertEquals($replacement_name, $result);
        }

        function test_delete()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $store2 = "Footlocker";
            $id = null;
            $new_store2 = new Store($store2, $id);
            $new_store2->save();

            $new_store_name->delete();
            $result = Store::getAll();

            $this->assertEquals([$new_store2], $result);
        }

        function test_addBrand()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $brand = "Adidas";
            $id = null;
            $new_brand = new Brand($brand, $id);
            $new_brand->save();

            $new_store_name->addBrand($new_brand);

            $this->assertEquals($new_store_name->getbrands(), [$new_brand]);
        }

        function test_getBrands()
        {
            $store_name = "Foot Traffic";
            $id = null;
            $new_store_name = new Store($store_name, $id);
            $new_store_name->save();

            $brand = "Adidas";
            $id = null;
            $new_brand = new Brand($brand, $id);
            $new_brand->save();

            $brand2 = "Nike";
            $id2 = null;
            $new_brand2 = new Brand($brand2, $id2);
            $new_brand2->save();

            $new_store_name->addbrand($new_brand);
            $new_store_name->addbrand($new_brand2);
            $this->assertEquals($new_store_name->getbrands(), [$new_brand, $new_brand2]);
        }
    }
?>
