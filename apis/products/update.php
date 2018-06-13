<?php 
    $data = json_decode(file_get_contents('php://input'), TRUE);

    require __DIR__.('/model.product.php');

    if (isset($data)) {
        
        $name = (isset($data['productName']) ? $data['productName'] : NULL);
        $price = (isset($data['productPrice']) ? $data['productPrice'] : NULL);
        $product_id = (isset($data['ID']) ? $data['ID'] : NULL);

        // validations
        if ($name == NULL || $price == NULL) {
            http_response_code(400);

            echo json_encode(['errors' => ['Fields are required!']]);
        } else {
            
            $product = new Product();

            echo $product->update($name, $price, $product_id);
        }
    }
?>