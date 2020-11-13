<?php

class Product
{
    private $product_price;
    private $product_weight;
    private $product_width;
    private $product_height;
    private $product_depth;
    private $config;

    public function __construct($product_price, $product_weight, $product_width, $product_height, $product_depth)
    {
        $this->product_price = $product_price;
        $this->product_weight = $product_weight;
        $this->product_width = $product_width;
        $this->product_height = $product_height;
        $this->product_depth = $product_depth;
        $this->config = require 'config.php';
    }

    public function getProductPrice()
    {
        return $this->product_price;
    }

    public function setProductPrice($product_price)
    {
        $this->product_price = $product_price;
    }

    public function getProductWeight()
    {
        return $this->product_weight;
    }

    public function setProductWeight($product_weight)
    {
        $this->product_weight = $product_weight;
    }

    public function getProductWidth()
    {
        return $this->product_width;
    }

    public function setProductWidth($product_width)
    {
        $this->product_width = $product_width;
    }

    public function getProductHeight()
    {
        return $this->product_height;
    }

    public function setProductHeight($product_height)
    {
        $this->product_height = $product_height;
    }

    public function getProductDepth()
    {
        return $this->product_depth;
    }

    public function setProductDepth($product_depth)
    {
        $this->product_depth = $product_depth;
    }

    public function getProductType()
    {
        return $this->product_type;
    }

    public function setProductType($product_type)
    {
        $this->product_type = $product_type;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }


    public function getItemPrice($product_type = "")
    {
        if(!is_float($this->product_price) || !is_float($this->product_weight) || !is_float($this->product_height)
            || !is_float($this->product_width) || !is_float($this->product_depth) ) {
            return array('returnCode' => 201, 'returnMess' => "Check input value");
        }
        $fee_by_weight = $this->product_weight * $this->config['coefficients']['weight'];
        $fee_by_dimension = $this->product_width * $this->product_height * $this->product_depth * $this->config['coefficients']['dimension'];
        $fee_by_product_type = 0;
        if ($product_type != "") {
            if(isset($this->config['product_type_fee'][$product_type]))
            {
                $fee_by_product_type = $this->config['product_type_fee'][$product_type];
            } else {
                return array('returnCode' => 201, 'returnMess' => "Check input value");
            }
        }
        $shipping_fee = max($fee_by_weight, $fee_by_dimension, $fee_by_product_type);
        return array('returnCode' => 0, 'returnMess' => $this->product_price + $shipping_fee);
    }

}