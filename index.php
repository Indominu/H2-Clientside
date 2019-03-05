<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="base.css">
        <script src="jquery-3.3.1.js"></script>
    </head>
    <body> 
        <script src="index.js"></script>
        <div class="banner" >Employee Management</div>
        <div style="margin-left:3vw;" >
            <input type="text" id="first_name" name="first_name" placeholder="First Name:" style="width:15vw;">
            <input type="text" id="last_name" name="last_name" placeholder="Last Name:" style="width:15vw;">
            <button class="button" type="button" id="Search">Search</button>
            <button class="button" type="button" id="Delete">Delete</button>
            <button class="button" type="button" id="add">Add</button>
            <button class="button" type="button" id="save" style="display: none;">Comfirm</button>
            <button class="button" type="button" id="cancel" style="display: none;">Cancel</button><br>
        </div>
        <div style="padding-left:3.4vw;margin-top:1vh;">
            <div class="title" style="width:5vw">&nbsp;</div>
            <div class="title" style="width:10.5vw">Department</div>
            <div class="title" style="width:13vw">Title</div>
            <div class="title" style="width:9vw">Emp No</div>
            <div class="title" style="width:23vw">Name</div>
            <div class="title" style="width:9vw">Birth Date</div>
            <div class="title" style="width:9vw">Hire Date</div>
            <div class="title" style="width:9vw">Salary</div>
        </div>
        <ul id="List"></ul>
        <img id="wait" src="wait.gif" style="position:absolute;top:26vh;left:35vw;width:25vw;display:none;">
        <iframe id="iform" src="employeeform.php" style="background-color:white;position:absolute;top:15vh;left:16vw;display:none;width:60vw;height:50vh;" scrolling="no"></form>          

    </body>
</html> 