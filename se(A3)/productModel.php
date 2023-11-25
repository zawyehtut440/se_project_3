<?php
require('dbconfig.php');

function getProductList() {
	global $db;
	$sql = "select * from product;";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);

	$rows = array();
	while ($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	return $rows;
}

function addToCart($productName, $productCost, $productId) {
	global $db;
	// 假設購物車內容存儲在另一個資料表，這裡只是一個簡單的示例
	// 在實際情況中，您可能需要更複雜的邏輯和資料庫結構
	// 在這裡您可以將商品添加到購物車，可能需要檢查商品是否已經在購物車中，如果是，則增加數量

	// 以下是一個簡單的示例，假設購物車內容存儲在 cart 資料表中
	$sql = "INSERT INTO cart (productName, productPrice, id) VALUES (?, ?, ?)";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "sii", $productName, $productCost, $productId);
	mysqli_stmt_execute($stmt);
	return true;
}
?>
