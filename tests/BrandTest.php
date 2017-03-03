<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

        function test_getBrandName()
        {
            $brand_name = "Nike";
            $new_brand = new Brand($brand_name);

            $result = $new_brand->getBrandName();

            $this->assertEquals($brand_name, $result);
        }

        function test_setBrandName()
        {
            $brand_name = "Nike";
            $new_brand = new Brand($brand_name);

            $brand_name2 = "Adidas";
            $new_brand->setBrandName($brand_name2);

            $result = $new_brand->getBrandName();

            $this->assertEquals($brand_name2, $result);
        }

        function test_getId()
        {
            $brand_name = "Nike";
            $id = 2;
            $new_brand = new Brand($brand_name, $id);

            $result = $new_brand->getId();

            $this->assertEquals($id, $result);
        }

        function test_save()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand = new Brand($brand_name, $id);
            $new_brand->save();

            $result = Brand::getAll();

            $this->assertEquals([$new_brand], $result);
        }

        function test_deleteAll()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $brand2 = "Adidas";
            $id = null;
            $new_brand2 = new Brand($brand2, $id);
            $new_brand2->save();

            Brand::deleteAll();
            $result = Brand::getAll();

            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $brand2 = "Adidas";
            $id = null;
            $new_brand2 = new Brand($brand2, $id);
            $new_brand2->save();

            $result = Brand::getAll();

            $this->assertEquals([$new_brand_name, $new_brand2], $result);
        }

        function test_find()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $brand2 = "Adidas";
            $id = null;
            $new_brand2 = new Brand($brand2, $id);
            $new_brand2->save();

            $result = Brand::find($new_brand2->getId());

            $this->assertEquals($new_brand2, $result);
        }

        function test_update()
        {
            $brand_name = "Nik";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $replacement_name = "Nike";
            $new_brand_name->update($replacement_name);

            $result = $new_brand_name->getBrandName();

            $this->assertEquals($replacement_name, $result);
        }

        function test_delete()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $brand2 = "Adidas";
            $id = null;
            $new_brand2 = new Brand($brand2, $id);
            $new_brand2->save();

            $new_brand_name->delete();
            $result = Brand::getAll();

            $this->assertEquals([$new_brand2], $result);
        }

        function test_addStore()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $store_name = "Footlocker";
            $id = 2;
            $new_store = new Store($store_name, $id);
            $new_store->save();

            $new_brand_name->addStore($new_store);

            $this->assertEquals($new_brand_name->getStores(), [$new_store]);
        }

        function test_getStores()
        {
            $brand_name = "Nike";
            $id = null;
            $new_brand_name = new Brand($brand_name, $id);
            $new_brand_name->save();

            $store_name = "Footlocker";
            $id = 2;
            $new_store = new Store($store_name, $id);
            $new_store->save();

            $store_name2 = "Foot Traffic";
            $id2 = 2;
            $new_store2 = new Store($store_name2, $id2);
            $new_store2->save();

            $new_brand_name->addStore($new_store);
            $new_brand_name->addStore($new_store2);

            $this->assertEquals($new_brand_name->getStores(), [$new_store, $new_store2]);
        }
    }
?>
