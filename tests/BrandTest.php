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


    }
?>
