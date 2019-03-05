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
    
    $sql = ("SELECT dept_name, title, E.emp_no, first_name, last_name, birth_date, hire_date, salary FROM employees E
    INNER JOIN titles T ON E.emp_no = T.emp_no
    INNER JOIN salaries S ON E.emp_no = S.emp_no
    INNER JOIN dept_emp DE ON E.emp_no = DE.emp_no
    INNER JOIN departments D ON D.dept_no = DE.dept_no
    WHERE E.first_name LIKE '$firstname' AND E.last_name LIKE '$lastname'
    AND S.to_date = (SELECT MAX(to_date) FROM salaries) AND T.to_date = (SELECT MAX(to_date) FROM titles) AND DE.to_date = (SELECT MAX(to_date) FROM dept_emp)
    LIMIT 1000;");

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
    
            // add each row returned into an array
            $listArr[] = array($row['dept_name'], $row['title'], $row['emp_no'], $row['first_name'], $row['last_name'], $row['birth_date'], $row['hire_date'], $row['salary']);

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
            if ($i == ($arrLength-1)) { $emp = $emp."E.emp_no = ".$data[$i]; }
            else { $emp = "".$emp."E.emp_no = ".$data[$i]." OR "; }
        }

    $sql = ("DELETE E,T,S,D FROM employees E
    INNER JOIN titles T ON E.emp_no = T.emp_no
    INNER JOIN salaries S ON E.emp_no = S.emp_no
    INNER JOIN  dept_emp D ON E.emp_no = D.emp_no
    LEFT JOIN dept_manager DM ON E.emp_no = DM.emp_no
    WHERE ".$emp.";");

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);

}
?>