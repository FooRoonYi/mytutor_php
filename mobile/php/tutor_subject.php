<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$search = $_POST['search'];
$sqltutorsubject = "SELECT s.subject_id, s.subject_name, s.tutor_id FROM tbl_tutors t, tbl_subjects s WHERE t.tutor_id = s.tutor_id AND tutor_name LIKE '%$search%' ORDER BY s.subject_id";
$result = $conn->query($sqltutorsubject);
$numrow = $result->num_rows;

if ($numrow > 0) {
    $tutors["tutors"] = array();
    while ($row = $result->fetch_assoc()) {
        $tlist = array();
        $tlist['tutor_id'] = $row['tutor_id'];
        $tlist['tutor_email'] = $row['tutor_email'];
        $tlist['tutor_phone'] = $row['tutor_phone'];
        $tlist['tutor_name'] = $row['tutor_name'];
        $tlist['tutor_password'] = $row['tutor_password'];
        $tlist['tutor_description'] = $row['tutor_description'];
        $tlist['tutor_datereg'] = $row['tutor_datereg'];
        $tlist['subject_id'] = $row['subject_id'];
        $tlist['subject_name'] = $row['subject_name'];
        array_push($tutors["tutors"],$tlist);
    }
    $response = array('status' => 'success', 'data' => $tutors);
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

?>