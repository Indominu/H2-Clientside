<?php

include 'Connect.php';


if(isset($_POST['firstname']) && isset($_POST['lastname'])) {

    $listArr = array();

    $firstname = "%".$_POST['firstname']."%";
    $lastname = "%".$_POST['lastname']."%";

    if (strrpos($firstname, "*"))  {
        $firstname=str_replace("%", "", $firstname);
        $firstname = str_replace("*", "%", $firstname);
    }
    if (strrpos($lastname, "*")) {
        $lastname=str_replace("%", "", $lastname);
        $lastname = str_replace("*", "%", $lastname);
    }

    $firstname = str_replace(" ", "", $firstname);
    $lastname = str_replace(" ", "", $lastname);

    $sql = "SELECT * FROM employees WHERE first_name LIKE '$firstname' AND last_name LIKE '$lastname' LIMIT 2000;";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
    
            // add each row returned into an array
            $listArr[] = array($row['emp_no'], $row['first_name'], $row['last_name'], $row['gender']);
        }

    } else {
        $listArr[] = "0 results";
    }

    mysqli_close($conn);
 
    // Sends result back to Ajax response
    echo json_encode($listArr);
};

if(isset($_POST['jsonData'])) {

    $data = json_decode($_POST['jsonData'], true);
    $emp = "";
    $arrLength;

        $arrLength = count($data);
        for ($i = 0; $i < $arrLength; $i++) {
            if ($i == ($arrLength-1)) { $emp = $emp."emp_no = ".$data[$i]; }
            else { $emp = "".$emp."emp_no = ".$data[$i]." OR "; }
        }
    

    $sql = "DELETE FROM employees WHERE ".$emp.";";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

}
?>