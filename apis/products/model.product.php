<?php 

    require('../dbconfig.php');

    /* *
     * Class Product 
     * */
    class Product {
        /* @var mysqli|PDO|string*/
        protected $db;

        public function __construct() {
            $this->db = DB();
        }
        
        /** List of products 
        * 
        *
        * @return string 
        */

        public function read() {
            $stmt = $this->db->prepare("SELECT * FROM tblproducts");
            $stmt->execute();
            return json_encode(['products'=>$stmt->fetchAll(PDO::FETCH_ASSOC)]);
        }

        /** Add new Product 
        * 
        * @param $productName
        * @param $productPrice 
        * 
        * @return string
        */

        public function create($productName, $productPrice) {
            $stmt = $this->db->prepare("INSERT INTO tblproducts (productName, productPrice) VALUES (:productName, :productPrice)");
            $stmt->bindParam("productName", $productName);
            $stmt->bindParam("productPrice", $productPrice);
            $stmt->execute();

            return json_encode(['products' => [
                'id' => $this->db->lastInsertId(),
                'productName' => $productName,
                'productPrice' => $productPrice
            ]]);
        }

        /** Update Product 
         * 
         * @param $productName
         * @param $productPrice
         * @param $productID
         * 
         * @return true | string
        */

        public function update($productName, $productPrice, $productID) {
            $stmt = $this->db->prepare("UPDATE tblproducts SET productName = :productName, productPrice = :productPrice WHERE id = :id");
            $stmt->bindParam("productName", $productName);
            $stmt->bindParam("productPrice", $productPrice);
            $stmt->bindParam("id", $productID);
            
            if ($stmt->execute()) {
                return true;
            } else {
                echo "Failed to update record";
            }
        }

        /** Delete Product
         * @param $productID
         * 
         * @return true | string
         */

         public function delete($productID) {
             $stmt = $this->db->prepare("DELETE FROM tblproducts WHERE id = :id");
             $stmt->bindParam('id', $productID);
             
             if ($stmt->execute()) {
                 return true;
             } else {
                 return false;
             }
         }

    }

?>
