<?php 
    require('model.product.php');

    $product = new Product();

    echo $product->read();
?>