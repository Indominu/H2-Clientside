var checkBoxArr = [];
var searchPra;

$(document).ready(() => {
    
    $("#Search").click(() => {
        searchPra = { "firstname": $("#first_name").val(), "lastname": $("#last_name").val() };
        DisplaySearch();
    });

    $("#Delete").click(() => {
        $(".deleteAction").show();
    });

    $('ul').on('click', 'input', function() {
        checkBoxArr.push(this.id);
    });

    $("#Cancel").click(() => {
        $(".deleteAction").hide();
    });

    $('ul').on('click', '.nameLine', function() {
        document.getElementById("iform").style.display="block";
        document.getElementById("iform").src="employeeform.php?emp_no="+this.id;
    });

    $("#add").click(() => {
        document.getElementById("iform").style.display="block";
        document.getElementById("iform").src="employeeform.php";
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
                /*
                var div = document.createElement("div");
                var li = document.createElement("li");
                var input = document.createElement("input");
                li.innerHTML = listFromPhp[i].toString().replace(/\,/g,' ');
                li.setAttribute('id', listFromPhp[i][0]);
                li.setAttribute('class', 'testClass');
                input.setAttribute('type', 'checkbox');
                input.setAttribute('id', listFromPhp[i][0]);
                input.setAttribute('style', 'display: none;');
                input.setAttribute('class', 'deleteAction');
                document.getElementById("List").appendChild(div);
                document.getElementById("List").appendChild(li);
                //document.getElementById(listFromPhp[i][0]).appendChild(input);
                */
               var div = document.createElement("div");
               div.setAttribute('id', listFromPhp[i][0]);
               div.setAttribute('style', "white-space:nowrap");
               div.setAttribute('class', "testClass");
               html="&nbsp;<input id='"+listFromPhp[i][0]+"' type='checkbox' class='deleteAction' style='display:none'>";
               html+="&nbsp;<div id='"+listFromPhp[i][0]+"' class='nameLine' >"+listFromPhp[i].toString().replace(/\,/g,' ')+"</div>";

               div.innerHTML=html;
               document.getElementById("List").appendChild(div);
            }
        }
    });
}

