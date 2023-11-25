<?php
require('todoModel.php');

$act=$_REQUEST['act'];
switch ($act) {
case "listCart":
    $items=getCartList();
    echo json_encode($items);
    return;

case "delCartItem":
	$id=(int)$_REQUEST['id']; //$_GET, $_REQUEST
	//verify
	delCartItem($id);
	return;

case "updateCart":
	$id=(int)$_REQUEST['id'];
	$amount=(int)$_REQUEST['amount'];
	// 拿到id及要修改的數量，此數量必須1<X<商品剩餘數量
	updateCartAmount($id, $amount);


default:
  
}

?>