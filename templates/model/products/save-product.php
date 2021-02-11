<!-- Get DB conn -->
<?php

include('../../../src/model/dbconn.php');

$name = $_POST['name'];
$supplier = $_POST['supplier'];
$category = $_POST['category'];
$size = $_POST['size'];
$orderNo = $_POST['orderNo'];
$cost = $_POST['cost'];
$quantity = $_POST['quantity'];

// Upload image
$image = $_FILES['imgSave']['name'];
$trimmedImage = str_replace(' ', '-', $image);
$target = "../../../upload/img/products/" . basename($trimmedImage);

// Create SKU
$cutName = substr(str_replace(' ', '', strtoupper($name)), 0, 6);
$sku = $cutName . '-' . $size . '-' . $orderNo;

// // Date created and modified
date_default_timezone_set("Asia/Kuala_Lumpur");
$created = date('Y-m-d H:i:s');
$modified = date('Y-m-d H:i:s');

// Insert to database
$insert = "INSERT INTO product (name, category, sku, size, orderNo, cost, quantity, img, created, modified) VALUE ('$name', '$category', '$sku', '$size', '$orderNo', '$cost', '$quantity','$trimmedImage', '$created', '$modified')";

if ($result = mysqli_query($conn, $insert)) {
    move_uploaded_file($_FILES['imgSave']['tmp_name'], $target);
    $msg = "Successfull inserted the product";
    $alert = "success";

    header('Location: /arzuhome/templates/model/products/list');
} else {
    $msg = "Error occured." . mysqli_error($conn);
    $alert = "danger";
}

?>