<?php
    include "conn.php";
    $newEmp=$_POST['newEmp'];
    $emp_no=$_POST['emp_no'];
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $birth_date=date('Y-m-d',strtotime($_POST['birth_date']));
    $gender=$_POST['gender'];
    $hire_date=date('Y-m-d',strtotime($_POST['hire_date']));
    $title=$_POST['title'];
    $tit_from_date=date('Y-m-d',strtotime($_POST['tit_from_date']));
    $tit_to_date=date('Y-m-d',strtotime($_POST['tit_to_date']));
    $salary=$_POST['salary'];
    $sal_from_date=date('Y-m-d',strtotime($_POST['sal_from_date']));
    $sal_to_date=date('Y-m-d',strtotime($_POST['sal_to_date']));
    $e_dept_no=$_POST['e_dept_no'];
    $e_dept_from_date=date('Y-m-d',strtotime($_POST['e_dept_from_date']));
    $e_dept_to_date=date('Y-m-d',strtotime($_POST['e_dept_to_date']));
    $m_dept_no=$_POST['m_dept_no'];
    $m_dept_from_date=date('Y-m-d',strtotime($_POST['m_dept_from_date']));
    $m_dept_to_date=date('Y-m-d',strtotime($_POST['m_dept_to_date']));
    if ($newEmp=="TRUE") // ************** new employee *************
    {
        if ($emp_no!="")
        {
            if ($emp_no!="")
                insertSQL("employees","emp_no, first_name, last_name,birth_date,gender,hire_date","'".$emp_no."', '".$first_name."', '".$last_name."','".$birth_date."', '".$gender."', '".$hire_date."'");
            if ($title!="")
                insertSQL("titles","emp_no,title,from_date,to_date","'".$emp_no."', '".$title."', '".$tit_from_date."','".$tit_to_date."'");
            if ($salary!="")
                insertSQL("salaries","emp_no,salary,from_date,to_date","'".$emp_no."', '".$salary."', '".$sal_from_date."','".$sal_to_date."'");
            if ($e_dept_no!="")
                insertSQL("dept_emp","emp_no,dept_no,from_date,to_date","'".$emp_no."', '".$e_dept_no."', '".$e_dept_from_date."','".$e_dept_to_date."'");
            if ($m_dept_no!="")
                insertSQL("dept_manager","emp_no,dept_no,from_date,to_date","'".$emp_no."', '".$m_dept_no."', '".$m_dept_from_date."','".$m_dept_to_date."'");
        }
    }else // ****************** edit old Employee ***********************
    {
        updateSQL("employees",$emp_no,"first_name='".$first_name."',last_name='".$last_name."',birth_date='".$birth_date."',gender='".$gender."',hire_date='".$hire_date."'");
    }

    function insertSQL($table,$columbs,$values)
    {
        global $conn;
        $sql = "INSERT INTO ".$table." (".$columbs.") VALUES (".$values.")";
        $result = mysqli_query($conn,$sql) or die("Query fail: " . mysqli_error($conn));
    }

    function updateSQL($table,$emp_no,$values)
    {
        global $conn;
        $sql = "UPDATE ".$table." SET ".$values." WHERE emp_no='".$emp_no."'";
        $result = mysqli_query($conn,$sql) or die("Query fail: " . mysqli_error($conn));
    }
  //var_dump($_POST);
?>