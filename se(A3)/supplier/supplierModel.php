<?php
require('../dbConfig.php');

function getItemList() {
    global $db;
    $sql = "SELECT * FROM `product`;";
    $stmt = mysqli_prepare($db, $sql); // precompile sql指令,建立statement物件,以便執行SQL
    mysqli_stmt_execute($stmt); // 執行SQL
    $result = mysqli_stmt_get_result($stmt); // 取得查詢結果

    $rows = array();
    while ($r = mysqli_fetch_assoc($result)) {
        $rows[] = $r;
    }
    return $rows;
}

function addItem($name, $price, $description, $remainNum) {
    global $db;
    $sql = "INSERT INTO `product` (productName, productCost, productContent, productNumber) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_prepare($db, $sql); // precompile sql指令,建立statement物件,以便執行SQL
    mysqli_stmt_bind_param($stmt, "sisi", $name, $price, $description, $remainNum);
    mysqli_stmt_execute($stmt); // 執行SQL
    return true;
}

function getItem($id) {
    global $db;
    $sql = "SELECT * FROM `product` WHERE id=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

function updateItem($id, $name, $price, $description, $remainNum) {
    global $db;
    $sql = "UPDATE `product` SET productName=?, productCost=?, productContent=?, productNumber=? WHERE id=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "sisii", $name, $price, $description, $remainNum, $id);
    mysqli_stmt_execute($stmt);
    return true;
}

function delItem($id) {
    global $db;
    $sql = "DELETE FROM `product` WHERE id=?;";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    return true;
}

?>