$(document).ready(() => {
    var checkBoxArr = [];
    var searchPra;

    $("#Search").click(() => {
        searchPra = { "firstname": $("#first_name").val(), "lastname": $("#last_name").val() };
        DisplaySearch();
    });

    $("#Delete").click(() => {
        $(".deleteAction").show();
    });

    $(document).on('hidden.bs.modal', function (e) {
        $(e.target).removeData('bs.modal');
    });

    $('[name="alterEmp"]').click(() => {
        $('#appendAlterEmp').append(`<div> &lt;?php $empno = ${10003}; include 'employeeform.php'; ?&gt; </div>`);
    });

    $('ul').on('click', 'input', function() {
        checkBoxArr.push(this.id);
    });

    $("#Cancel").click(() => {
        $(".deleteAction").hide();
    });

    $("#Comfirm").click(() => {
        $.ajax({
            type: "POST",
            url: "search&destroy.php",
            data:  { "jsonData": JSON.stringify(checkBoxArr) },
            success: (res) => {
                $(".deleteAction").hide();
                checkBoxArr.length = 0;
                DisplaySearch();
            }
        });
    });

    function DisplaySearch() {
        $.ajax({
            type: "POST",
            url: "search&destroy.php",
            data: searchPra,
            success: (res) => {
                var listFromPhp = JSON.parse(res);
                $('.testClass').remove();
                for (var i = 0; i < listFromPhp.length; i+=1) {
                    var li = document.createElement("li");
                    var input = document.createElement("input");
                    li.innerHTML = listFromPhp[i].toString().replace(/\,/g,' ');
                    li.setAttribute('id', listFromPhp[i][0]);
                    li.setAttribute('class', 'testClass');
                    input.setAttribute('type', 'checkbox');
                    input.setAttribute('id', listFromPhp[i][0]);
                    input.setAttribute('style', 'display: none;');
                    input.setAttribute('class', 'deleteAction');
                    document.getElementById("List").appendChild(li);
                    document.getElementById(listFromPhp[i][0]).appendChild(input);
                }
            }
        });
    }
});