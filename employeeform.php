<?php
include 'Connect.php';
 if (isset($_GET['emp_no'])) {$emp_no=$_GET['emp_no'];$newEmp="FALSE";} else {$emp_no="";$newEmp="TRUE";}
 //$emp_no="1";$newEmp="FALSE"; // debug
 $first_name="";
 $last_name="";
 $birth_date="";
 $gender="";
 $hire_date="";

 $title="";
 $tit_from_date="";
 $tit_to_date="";

 $salary="";
 $sal_from_date="";
 $sal_to_date="";

 $e_dept_no="";
 $e_dept_name="";
 $e_dept_from_date="";
 $e_dept_to_date="";

 $m_dept_no="";
 $m_dept_name="";
 $m_dept_from_date="";
 $m_dept_to_date="";
 

 if ($emp_no!="")
 {
    $sql = "SELECT * FROM employees  
    INNER JOIN (SELECT title,from_date AS tit_from_date, to_date AS tit_to_date FROM titles     WHERE emp_no='".$emp_no."') AS titles
    INNER JOIN (SELECT salary,from_date AS sal_from_date, to_date AS sal_to_date FROM salaries  WHERE emp_no='".$emp_no."') AS salaries
    INNER JOIN (SELECT dept_no AS e_dept_no,from_date AS e_dept_from_date, to_date AS e_dept_to_date FROM dept_emp  WHERE emp_no='".$emp_no."') AS dept_emp
    INNER JOIN (SELECT dept_no AS m_dept_no,from_date AS m_dept_from_date, max(to_date) AS m_dept_to_date FROM dept_manager  WHERE emp_no='".$emp_no."') AS dept_manager 
    WHERE employees.emp_no='".$emp_no."' AND sal_to_date = (SELECT MAX(to_date) FROM salaries) AND tit_to_date = (SELECT MAX(to_date) FROM titles) AND e_dept_to_date = (SELECT MAX(to_date) FROM dept_emp)
    LIMIT 1;";
    $result = mysqli_query($conn,$sql) or die("Query fail: " . mysqli_error($conn));
    $row=$result->fetch_assoc();

    function setDate($date)
    {
        if ($date!="") $date=date('d-m-Y',strtotime($date));
        return $date;
    }

    $first_name=$row['first_name'];
    $last_name=$row['last_name'];
    $birth_date=setDate($row['birth_date']);
    $gender=$row['gender'];
    $hire_date=setDate($row['hire_date']);
    $title=$row['title'];
    $tit_from_date=setDate($row['tit_from_date']);
    $tit_to_date=setDate($row['tit_to_date']);
    $salary=$row['salary'];
    $sal_from_date=setDate($row['sal_from_date']);
    $sal_to_date=setDate($row['sal_to_date']);
    $e_dept_no=$row['e_dept_no'];
    $e_dept_from_date=setDate($row['e_dept_from_date']);
    $e_dept_to_date=setDate($row['e_dept_to_date']);
    $m_dept_no=$row['m_dept_no'];
    $m_dept_from_date=setDate($row['m_dept_from_date']);
    $m_dept_to_date=setDate($row['m_dept_to_date']);

    function getDepartment($conn,$dept_no)
    {
        $sql="SELECT dept_name FROM departments WHERE dept_no='".$dept_no."' ";
        $result = mysqli_query($conn,$sql) or die("Query fail: " . mysqli_error($conn));
        return $result->fetch_assoc()['dept_name']; 
    }

    if ($e_dept_no!="") $e_dept_name=getDepartment($conn,$e_dept_no);
    if ($m_dept_no!="") $m_dept_name=getDepartment($conn,$m_dept_no);
 }

?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="base.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <body onload="makeForm()" style="width:99%;height:97.5%;">
        <form action="saveEmployee.php" name="form" id="form" method="post" enctype="multipart/form-data">
          <input type='text' name='newEmp' id='newEmp' style='display:none' value='<?=$newEmp?>'>
          <input type='text' name='empchanged' id='empchanged' style='display:none' value='FALSE'>
          <input type='text' name='titlechanged' id='titlechanged' style='display:none' value='FALSE'>
          <input type='text' name='salarychanged' id='salarychanged' style='display:none' value='FALSE'>
          <input type='text' name='e_deptchanged' id='e_dept_nochanged' style='display:none' value='FALSE'>
          <input type='text' name='m_deptchanged' id='m_dept_nochanged' style='display:none' value='FALSE'>
          <div id="formular" style="display:block:border;0.1vmax solid silver;width:99%;height:80vh;">&nbsp;</div>
          <div id="buttons" style="display:block:border;0.1vmax solid silver;width:99%;height:5vh;">
            <div class="button" id="save"   style="height:8vh;padding-top:2vh;" onclick="handleForm('save')">Save</div>
            <div class="button" id="cancel" style="height:8vh;padding-top:2vh;" onclick="handleForm('cancel')">Cancel</div>
          </div>
        </form>
    </body>

    
    <script>
        function makeForm()
        {
            fields = 
            [
                "Emp No:emp_no:<?=$emp_no?>",
                "First Name:first_name:<?=$first_name?>",
                "Last Name:last_name:<?=$last_name?>",
                "Birth Date(d-m-aaaa):birth_date:<?=$birth_date?>", 
                "Gender:gender:<?=$gender?>",
                "Hire date(d-m-aaaa):hire_date:<?=$hire_date?>",
                "Title:title:<?=$title?>",
                "Title From Date(d-m-aaaa):tit_from_date:<?=$tit_from_date?>",
                "Title To Date(d-m-aaaa):tit_to_date:<?=$tit_to_date?>",                           
                "Employee Dept No:e_dept_no:<?=$e_dept_no?>",
                "Department:e_dept_name:<?=$e_dept_name?>",
                "From Date(d-m-aaaa):e_dept_from_date:<?=$e_dept_from_date?>",
                "To Date(d-m-aaaa):e_dept_to_date:<?=$e_dept_to_date?>",
                "Manager Dept No:m_dept_no:<?=$m_dept_no?>",
                "Department manager:m_dept_name:<?=$m_dept_name?>",
                "Man From Date(d-m-aaaa):m_dept_from_date:<?=$m_dept_from_date?>",
                "Man To Date(d-m-aaaa):m_dept_to_date:<?=$m_dept_to_date?>",
                "Salary:salary:<?=$salary?>",
                "Sal From Date(d-m-aaaa):sal_from_date:<?=$sal_from_date?>",
                "Sal To Date(d-m-aaaa):sal_to_date:<?=$sal_to_date?>"
            ];
            html=makeInput(fields[0].split(":")[0],fields[0].split(":")[1],fields[0].split(":")[2])+"<br>";
            for (i=1;i<fields.length;i++)
                html+=makeInput(fields[i].split(":")[0],fields[i].split(":")[1],fields[i].split(":")[2]);   
            
            $("#formular").html(html);

            // if old employe is editet set employe number to read only
            if($("#newEmp").attr("value")=="FALSE") 
            {
                $("#emp_no").css("color","gray");
                $("#emp_no").attr("readonly","true");
                $("#first_name").change(function(){$("#empchanged").attr("value","TRUE");});
                $("#last_name").change(function(){$("#empchanged").attr("value","TRUE");});
                $("#birth_date").change(function(){$("#empchanged").attr("value","TRUE");});
                $("#gender").change(function(){$("#empchanged").attr("value","TRUE");});
                $("#hire_date").change(function(){$("#empchanged").attr("value","TRUE");});
                $("#title").change(function(){$("#titlechanged").attr("value","TRUE");});
                $("#tit_from_date").change(function(){$("#titlechanged").attr("value","TRUE");});
                $("#tit_to_date").change(function(){$("#titlechanged").attr("value","TRUE");});
                $("#e_dept_no").change(function(){$("#e_deptchanged").attr("value","TRUE");});
                $("#e_dept_name").change(function(){$("#e_deptchanged").attr("value","TRUE");});
                $("#e_dept_from_date").change(function(){$("#e_deptchanged").attr("value","TRUE");});
                $("#e_dept_to_date").change(function(){$("#e_deptchanged").attr("value","TRUE");});
                $("#m_dept_no").change(function(){$("#m_deptchanged").attr("value","TRUE");});
                $("#m_dept_name").change(function(){$("#m_deptchanged").attr("value","TRUE");});
                $("#m_dept_from_date").change(function(){$("#m_deptchanged").attr("value","TRUE");});
                $("#m_dept_to_date").change(function(){$("#m_deptchanged").attr("value","TRUE");});
                $("#salary").change(function(){$("#salarychanged").attr("value","TRUE");});
                $("#sal_from_date").change(function(){$("#salarychanged").attr("value","TRUE");});
                $("#sal_to_date").change(function(){$("#salarychanged").attr("value","TRUE");});           
            }
        }
            
        function makeInput(title,name,value)
        {  
            inputLine="<div style='position:relative;display:inline-table;margin-right:1vmax;font-size:1.3vmax;'>"+title+"<br>";        
            inputLine+="<input type='text' name='"+name+"' id='"+name+"' style='font-size:1.8vmax;' placeholder='"+title+"' value='"+value+"'>";
            inputLine+="</div>";
            return inputLine;
        }

        function handleForm(action)
        {
          if (action=="save")
          {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {
                    document.getElementById("save").innerHTML = this.responseText;
                    parent.document.getElementById("iform").style.display="none";
                    parent. DisplaySearch();
                }
            }
            xmlhttp.open("POST","saveEmployee.php",true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.setRequestHeader("Content-length", 500);
            xmlhttp.setRequestHeader("Connection", "close")            
            
            fields=document.getElementsByTagName("input");
            options="";
            for (i=0;i<fields.length;i++)
             options+=fields[i].name+"="+fields[i].value+"&";
            xmlhttp.send(options);
            
            //document.getElementById("form").submit();
          }

          if (action=="cancel")
          {
             parent.document.getElementById("iform").style.display="none"; 
          }
        }
    </script>
</html>