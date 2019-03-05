<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employees";
$alineNo=0;
$aline="";
$atitles="";
$secondsA = 0;

if (isset($_POST["first_name"])) $firstname="%".$_POST["first_name"]."%"; else $firstname=""; 
if (isset($_POST["last_name"])) $lastname="%".$_POST["last_name"]."%"; else $lastname="";
if (strrpos($firstname,"*"))  {$firstname=str_replace("%","",$firstname);$firstname=str_replace("*","%",$firstname);}
if (strrpos($lastname,"*"))  {$lastname=str_replace("%","",$lastname);$lastname=str_replace("*","%",$lastname);}
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error."<br><br>");}echo "Connected successfully<br><br>";

if ($firstname!="" || $lastname!="")
{
    
    $aStartTime = microtime(true);
    $sql = "CALL search_all('employees.emp_no,first_name,last_name,gender','employees','first_name','".$firstname."','last_name','".$lastname."','LIMIT 100000');";
    $result = mysqli_query($conn,$sql) or die("Query fail: " . mysqli_error($conn));
    
    $aEndTime = microtime(true);
    $secondsA = number_format ($aEndTime - $aStartTime,4);
    
    $atitles.="<div style='display:inline-table;border:0.1vmax solid silver;width:4.1vw;height:auto;'>&nbsp;</div>";
    $atitles.="<div style='display:inline-table;border:0.1vmax solid silver;width:5vw;height:auto;'>emp_no</div>";
    $atitles.="<div style='display:inline-table;border:0.1vmax solid silver;width:10vw;height:auto;'>First Name</div>";
    $atitles.="<div style='display:inline-table;border:0.1vmax solid silver;width:10vw;height:auto;'>Last Name</div>";
    $atitles.="<div style='display:inline-table;border:0.1vmax solid silver;width:1vw;height:auto;'>&nbsp;</div>";
    
    if ($result->num_rows > 0) 
    {
        // output data of each row
        while($row=$result->fetch_assoc()) 
        {
            $alineNo++;
            if ($row["gender"]=="M") $background="transparent"; else $background="#FFCCCC";
            $aline.="<div>";
            $aline.="<div style='display:inline-table;border:0.1vmax solid silver;width:4vw;height:auto;background:".$background."'>".$alineNo."</div>";
            $aline.="<div style='display:inline-table;border:0.1vmax solid silver;width:5vw;height:auto;background:".$background."'>".$row["emp_no"]."</div>";
            $aline.="<div style='display:inline-table;border:0.1vmax solid silver;width:10vw;height:auto;background:".$background."'>".$row["first_name"]."</div>";
            $aline.="<div style='display:inline-table;border:0.1vmax solid silver;width:10vw;height:auto;background:".$background."'>".$row["last_name"]."</div>";
            $aline.="<div style='display:inline-table;border:0.1vmax solid silver;width:1vw;height:auto;text-align:center;background:".$background."'>".$row["gender"]."</div>";
            $aline.="</div>";
        }
    } else 
        $aline.= "No Results";
    $result->close();
    $conn->next_result();  
}
?>

<html>
<body>

<form action="?" method="post" target="iframetest">
First Name: <input type="text" name="first_name">
Last Name: <input type="text" name="last_name">
<input type="submit" >
</form>

<div style="display:inline-table;width:45vw;height:76vh;">
    <div style="width:100%;height:3vh;">
    <?php echo $atitles;?>
    </div>
    <div style="width:100%;height:70vh;border:0.1vmax solid silver;overflow-x:hidden;">
    <?php echo $aline;?>
    </div>
    <div style="width:100%;height:3vh;border:0.1vmax solid silver;">
    Result:<?php echo $alineNo;?>&nbsp;&nbsp;&nbsp;Time:<?php echo $secondsA;?>&nbsp;sec
    </div>
</div>
</body>
</html>