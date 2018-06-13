<?php 
    $data = json_decode(file_get_contents('php://input'), TRUE);

    require __DIR__.('/model.product.php');

    $productName = (isset($data['productName']) ? $data['productName'] : NULL);
    $productPrice = (isset($data['productPrice']) ? $data['productPrice'] : NULL);

    if ($productName == null || $productPrice == null) {
        http_response_code(400);
        echo json_encode(['errors' => ['Fields are required']]);
    } else {
        $product = new Product();

        echo $product->create($productName, $productPrice);
    }


    
?>