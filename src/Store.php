<?php

    Class Store
    {
        private $store_name;
        private $id;

        function __construct($store_name, $id = null)
        {
            $this->store_name = $store_name;
            $this->id =  $id;
        }

        function getStoreName()
        {
            return $this->store_name;
        }

        function setStoreName($new_store)
        {
            $this->store_name = (string) $new_store;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO stores (store_name) VALUES ('{$this->getStoreName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $stores = array();
            foreach($returned_stores as $store) {
                $store_name = $store['store_name'];
                $id = $store['id'];
                $new_store = new Store($store_name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
            $GLOBALS['DB']->exec("DELETE FROM stores_stores;");
        }

        static function find($search_id)
        {
            $found_store = null;
            $stores = Store::getAll();
            foreach ($stores as $store) {
                $store_id = $store->getId();
                if ($store_id == $search_id) {
                    $found_store = $store;
                }
            }
            return $found_store;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET store_name = '{$new_name}' WHERE id = {$this->getId()}");
            $this->setStoreName($new_name);
        }


    }
?>
