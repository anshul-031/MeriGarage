<?php

include('connection.php');

$makeId = isset($_POST['makeId']) ? $_POST['makeId'] : 0;
// $stateId = isset($_POST['stateId']) ? $_POST['stateId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
    case "brand":
        $statement = "SELECT makeid,makeTitle FROM mericar_make";
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['makeid'] . ">" . $result['makeTitle'] . "</option>";
        }
        break;

    case "model":
        $result1 = "<option>Select Model</option>";
        $statement = "SELECT modelid,modelTitle FROM mericar_model WHERE makeid=" . $makeId;
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['modelTitle'] . ">" . $result['modelTitle'] . "</option>";
        }
        echo $result1;
        break;

    // case "city":
    //     $result1 = "<option>Select City</option>";
    //     $statement = "SELECT id, name FROM cities WHERE state_id=" . $stateId;
    //     $dt = mysqli_query($conn, $statement);

    //     while ($result = mysqli_fetch_array($dt)) {
    //         $result1 .= "<option value=" . $result['id'] . ">" . $result['name'] . "</option>";
    //     }
    //     echo $result1;
    //     break;
}

exit();
?>