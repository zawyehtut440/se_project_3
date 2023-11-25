<?php
require('productModel.php');

$act = $_REQUEST['act'];

switch ($act) {
    case "listProduct":
        $products = getProductList();
        echo json_encode($products);
        break;
    case "addToCart":
        $jsonStr = $_POST['dat'];
        $product = json_decode($jsonStr);
        // 在這裡應該加入一些驗證，確保傳入的數據是有效的
        if ($product && isset($product->productName) && isset($product->productCost) && isset($product->productContent)) {
            addToCart($product->productName, $product->productCost, $product->productContent, $product->id);
        } else {
            // 如果數據無效，可以返回一個錯誤狀態碼或者其他錯誤信息
            echo json_encode(["error" => "Invalid data"]);
        }
        break;
    default:
        // 如果 act 不匹配任何預期的值，可以返回一個錯誤狀態碼或者其他錯誤信息
        echo json_encode(["error" => "Invalid action"]);
}
?>
