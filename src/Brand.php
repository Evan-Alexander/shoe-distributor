<?php

    Class Brand
    {
        private $brand_name;
        private $id;

        function __construct($brand_name, $id = null)
        {
            $this->brand_name = $brand_name;
            $this->id =  $id;
        }

        function getBrandName()
        {
            return $this->brand_name;
        }

        function setBrandName($new_brand)
        {
            $this->brand_name = (string) $new_brand;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (brand_name) VALUES ('{$this->getBrandName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $brands = array();
            foreach($returned_brands as $brand) {
                $brand_name = $brand['brand_name'];
                $id = $brand['id'];
                $new_brand = new Brand($brand_name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores;");
        }

        static function find($search_id)
        {
            $found_brand = null;
            $brands = Brand::getAll();
            foreach ($brands as $brand) {
                $brand_id = $brand->getId();
                if ($brand_id == $search_id) {
                    $found_brand = $brand;
                }
            }
            return $found_brand;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE brands SET brand_name = '{$new_name}' WHERE id = {$this->getId()}");
            $this->setBrandName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()}");
            $GLOBALS['DB']->exec("DELETE FROM brands_stores WHERE brand_id = {$this->getId()}");
        }

        function addStore($store)
        {
            $GLOBALS['DB']->exec("INSERT INTO brands_stores (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()})");
        }

        function getStores()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                JOIN brands_stores ON (brands_stores.brand_id = brands.id)
                JOIN stores ON (stores.id = brands_stores.store_id)
                WHERE brands.id = {$this->getId()};");
                $stores = [];
                foreach($returned_stores as $store) {
                    $store_name = $store['store_name'];
                    $id = $store['id'];
                    $new_store = new Store($store_name, $id);
                    array_push($stores, $new_store);
                }
                return $stores;
        }
    }
?>
