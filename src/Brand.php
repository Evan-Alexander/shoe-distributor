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
    }


?>
