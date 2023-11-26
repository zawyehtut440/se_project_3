<?php
require('productModel.php');

$act = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';

switch ($act) {
    case "listProduct":
        $products = getProductList();
        echo json_encode($products);
        break;
    case "addToCart":
        $jsonStr = file_get_contents("php://input"); // 使用此行來獲取 JSON 數據
        $product = json_decode($jsonStr);
        var_dump($jsonStr);
        var_dump($product);

        // 在這裡應該加入一些驗證，確保傳入的數據是有效的
        if ($product && isset($product->dat->productName) && isset($product->dat->productCost) && isset($product->dat->productId)) {
            $result = addToCart($product->dat->productName, $product->dat->productCost, $product->dat->productId);

            if ($result) {
                echo json_encode(["success" => true]);
            } else {
                echo json_encode(["error" => "Failed to add to cart"]);
            }
        } else {
            // 如果數據無效，可以返回一個錯誤狀態碼或者其他錯誤信息
            echo json_encode(["error" => "Invalid data"]);
        }
        break;
    default:
        // 如果 act 不匹配任何預期的值，可以返回一個錯誤狀態碼或者其他錯誤信息
        echo json_encode(["error" => "Invalid action: $act"]);
}
?>
