<?php 

    $data = json_decode(file_get_contents('php://input'), TRUE);

    require __DIR__.'/model.product.php';

    if(isset($data)) {
        $product_id = (isset($data) ? $data : NULL);

        $product = new Product();

        $product->delete($product_id);
    }
?>