<?php
$jsonData = json_decode(file_get_contents('php://input'), true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update item</title>
</head>
<body>
    <form id="myForm" name="myForm" method="post">
        商品名稱: <input name="itemName" type="text" value="<?php echo $jsonData['itemName'];?>" ><br>
        商品價格: <input name="itemPrice" type="number" value="<?php echo $jsonData['itemPrice']; ?>" ><br>
        商品資訊: <input name="itemDescription" type="text" value="<?php echo $jsonData['itemDescription']; ?>" ><br>
        商品數量: <input name="itemNum" type="number" value="<?php echo $jsonData['itemNum']; ?>" >
        <br>
        <input type="button" onclick="updateItem(<?php echo $jsonData['id']; ?>)" value="修改">
    </form>
</body>
</html>