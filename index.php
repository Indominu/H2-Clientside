<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="base.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="jquery-3.3.1.js"></script>
        <script src="index.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    </head>
    <body> 

            <input type="text" id="first_name" name="first_name" placeholder="First Name:">
            <input type="text" id="last_name" name="last_name" placeholder="Last Name:">
            <button type="button" id="Search">Search</button>
            <button type="button" id="Delete">Delete</button>
            <button type="button" id="add">Add</button><br>
            <ul id="List"></ul>
            <button type="button" id="Comfirm" class="deleteAction" style="display: none;">Comfirm</button>
            <button type="button" id="Cancel" class="deleteAction" style="display: none;">Cancel</button><br>

            <iframe id="iform" src="employeeform.php" style="background-color:white;position:absolute;top:10vh;left:16vw;display:none;width:60vw;height:50vh;" scrolling="no"></form>          

    </body>
</html> 