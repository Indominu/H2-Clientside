<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="base.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="jquery-3.3.1.js"></script>
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body> 
        <script src="index.js"></script>
        <div class="banner" >Employee Management</div>
        <div style="margin-left:3vw;" >
            <input type="text" id="first_name" name="first_name" placeholder="First Name:" style="width:15vw">
            <input type="text" id="last_name" name="last_name" placeholder="Last Name:" style="width:15vw">
            <button class="button"type="button" id="Search">Search</button>
            <button class="button" type="button" id="Delete">Delete</button>
            <button class="button" type="button" id="add">Add</button><br>
        </div>
        <div style="padding-left:3vw;margin-top:1vh;">
            <div class="title" style="width:5vw">&nbsp;</div>
            <div class="title">Department</div>
            <div class="title">Title</div>
            <div class="title">Emp No</div>
            <div class="title">Name</div>
            <div class="title">Birth Date</div>
            <div class="title">Hire Date</div>
            <div class="title">Salary</div>
        </div>
        <ul id="List" style="margin-left:3vw;padding:0;border:0.1vmax solid silver;width:91vw;height:80vh;overflow-x:hidden;font-size:2vmax;"></ul>
        <button type="button" id="Comfirm" class="deleteAction" style="display: none;">Comfirm</button>
        <button type="button" id="Cancel" class="deleteAction" style="display: none;">Cancel</button><br>

        <iframe id="iform" src="employeeform.php" style="background-color:white;position:absolute;top:10vh;left:16vw;display:none;width:60vw;height:50vh;" scrolling="no"></form>          

    </body>
</html> 