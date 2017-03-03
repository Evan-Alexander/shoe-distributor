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
        //
        // function test_getId()
        // {
        //     $name = "Nike";
        //     $id = 2;
        //     $new_brand = new Brand($name, $id);
        //     $result = $new_brand->getBrandId();
        //     $this->assertEquals($id, $result);
        // }
    }
?>
