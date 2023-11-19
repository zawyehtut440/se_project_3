<?php
require('supplierModel.php');

$act = $_REQUEST['act'];

switch($act) {
    case "listItem":
        $items = getItemList();
        echo json_encode($items);
        return;
    case "addItem":
        $itemName = $_POST['itemName'];
        $itemPrice = (int)$_POST['itemPrice'];
        $itemDescription = $_POST['itemDescription'];
        $itemNumber = (int)$_POST['itemNum'];
        addItem($itemName, $itemPrice, $itemDescription, $itemNumber);
        return;
    case "getItemInfo":
        $itemId = (int)$_GET['id'];
        $itemInfo = getItem($itemId);
        echo json_encode($itemInfo);
        return;
    case "updateItem":
        $itemId = (int)$_GET['id'];
        $itemName = $_POST['itemName'];
        $itemPrice = (int)$_POST['itemPrice'];
        $itemDescription = $_POST['itemDescription'];
        $itemNumber = (int)$_POST['itemNum'];
        updateItem($itemId, $itemName, $itemPrice, $itemDescription, $itemNumber);
        return;
    case "delItem":
        $itemId = (int)$_GET['id'];
        delItem($itemId);
        return;
}

?>