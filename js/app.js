var app = angular.module('myApp', ['ngRoute']);

app.config(['$routeProvider', function ($routeProvider) {

}]);

app.controller('ProductController', ['$scope', '$http', function ($scope, $http) {

    $scope.products = [];

    // For displaying the list of products
    $scope.listProducts = function () {
        $http.get('apis/products/list.php')
            .then(function (response) {
                $scope.products = response.data.products;
            }, function error($e) {
                console.log($e);
            });
    }

    $scope.listProducts();

    // For adding a product
    $scope.addProduct = function () {

        var products = {
            'productName': $scope.productName,
            'productPrice': $scope.productPrice
        };

        $http.post('apis/products/create.php', products)
            .then(function (response) {
                $scope.errors = [];

                $scope.products.push(response.data.products);

                $scope.message = 'Product was added successfully!';

                return false;
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    }

    // For showing the records to be edited on a modal
    $scope.edit = function (index) {
        $scope.message = '';
        $scope.product_details = $scope.products[index];
        var modal_element = angular.element('#modal_update_product');
        modal_element.modal('show');
    }

    // For updating the records of the product inside the modal
    $scope.updateProduct = function () {
        var products = $scope.product_details;
        $http.post('apis/products/update.php', products)
            .then(function (response) {
                // $scope.message = 'Product was updated!';

                // return false;
                console.log(response);
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
        
    }

    // For deleting records
    $scope.deleteProduct = function (id, index) {
        var conf = confirm('Do you really wanted to delete an item?');
        var product_id = id; 

        if (conf == true) {
            $http.post('apis/products/delete.php', product_id)
                .then(function(response) {
                $scope.errors = [];

                $scope.products.splice(index, 1);
            }, function error(e) {
                $scope.errors = e.data.errors;
            });

        } 
    }

}]);