<?php
if (!isset($_POST)) {
    echo "failed";
}

include_once("dbconnect.php");
$email = $_POST['email'];
$password = sha1($_POST['password']);
$sqllogin = "SELECT * FROM tbl_user WHERE user_email = '$email' AND user_pass = '$password'";
$result = $conn->query($sqllogin);
$numrow = $result->num_rows;

if ($numrow > 0) {
    while ($row = $result->fetch_assoc()) {
        $user['id'] = $row['user_id'];
        $user['name'] = $row['user_name'];
        $user['email'] = $row['user_email'];
        $user['phoneNo'] = $row['user_phoneNo'];
        $user['address'] = $row['user_address'];
        $user['credit'] = $row['user_credit'];
        $user['otp'] = $row['user_otp'];
        $user['datereg'] = $row['user_datereg'];
        $user['cart'] = $row['user_cart'];
    }
    $response = array('status' => 'success', 'data' => $user);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

