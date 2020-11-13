<?php

include 'Product.php';

function testCase($product_price, $product_weight, $product_width, $product_height, $product_depth, $product_type="") {
    $product_Test = new Product($product_price, $product_weight, $product_width, $product_height, $product_depth);
    $result = $product_Test->getItemPrice($product_type);
    if($result['returnCode'] != 0) {
        echo "Product Test result: ". $result['returnMess'] . " Test result: FAIL</br>";
    } else {
        echo "Product Test result: " . $result['returnMess'] . " Test result: PASS</br>";
    }
}

testCase("a", 10.00, 23.00, 15.00, 10.00);
testCase(10000.00, 10.00, 23.00, 15.00, 10.00);
testCase(10000.00, 10.00, 23.00, 15.00, 10.00, "jewelry");
testCase(10000.00, "abc", 23, 15, 10);
testCase(10000, 10, 23, 15, 10);