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
            <button type="button" data-toggle="modal" data-target="#alterEmp" name="alterEmp">Alter</button>
            <button type="button" data-toggle="modal" data-target="#addEmp">Add</button><br>
            <button type="button" id="Comfirm" class="deleteAction" style="display: none;">Comfirm</button>
            <button type="button" id="Cancel" class="deleteAction" style="display: none;">Cancel</button><br>
            <ul id="List" style="width: 20%;"></ul>
            <div id="alterEmp" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="appendAlterEmp"> 
                    </div>
                </div>
            </div>
            <div id="addEmp" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" id="appendAddEmp">
                        <?php include 'employeeform.php';?>
                    </div>
                </div>
            </div>

    </body>
</html> 