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

    // 先檢查購物車中是否已經存在相同的商品
    $checkSql = "SELECT id, myAmount FROM cart WHERE productName = ? AND productPrice = ? AND id = ?";
    $checkStmt = mysqli_prepare($db, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "sii", $productName, $productCost, $productId);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);

    if ($checkResult && $existingProduct = mysqli_fetch_assoc($checkResult)) {
        // 商品已存在於購物車中，更新數量
        $existingProductId = $existingProduct['id'];
        $newAmount = $existingProduct['myAmount'] + 1;

        $updateSql = "UPDATE cart SET myAmount = ? WHERE id = ?";
        $updateStmt = mysqli_prepare($db, $updateSql);
        mysqli_stmt_bind_param($updateStmt, "ii", $newAmount, $existingProductId);
        mysqli_stmt_execute($updateStmt);

        if (mysqli_stmt_affected_rows($updateStmt) > 0) {
            return true; // 更新成功
        } else {
            return false; // 更新失敗
        }
    } else {
        // 商品不存在於購物車中，插入新商品
        $insertSql = "INSERT INTO cart (productName, productPrice, id, myAmount) VALUES (?, ?, ?, 1)";
        $insertStmt = mysqli_prepare($db, $insertSql);
        mysqli_stmt_bind_param($insertStmt, "sii", $productName, $productCost, $productId);
        mysqli_stmt_execute($insertStmt);

        if (mysqli_stmt_affected_rows($insertStmt) > 0) {
            return true; // 插入成功
        } else {
            return false; // 插入失敗
        }
    }
}


?>
