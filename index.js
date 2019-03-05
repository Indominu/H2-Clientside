checkBoxArr = [];
searchPra="";

$(document).ready(() => {

    $("#Search").click(() => {
        searchPra = { "firstname": $("#first_name").val(), "lastname": $("#last_name").val() };
        DisplaySearch();
    });

    $("#Delete").click(() => {
        $(".deleteAction").show();
        $("#save").show();
        $("#cancel").show();
    });

    $('ul').on('click', 'input', function() {
        if ($(this).is(':checked')) {
            checkBoxArr.push(this.id); 
        } else {
            checkBoxArr.splice(checkBoxArr.indexOf(this.id), 1);
        }
    });

    $("#cancel").click(() => {
        $(".deleteAction").hide();
        $("#save").hide();
        $("#cancel").hide();
    });

    $('ul').on('click', '.nameLine', function() {
        document.getElementById("iform").style.display="block";
        document.getElementById("iform").src="employeeform.php?emp_no="+this.id;
    });

    $("#add").click(() => {
        document.getElementById("iform").style.display="block";
        document.getElementById("iform").src="employeeform.php";
    });

    $("#save").click(() => {
        $.ajax({
            type: "POST",
            url: "search&destroy.php",
            data:  { "jsonData": JSON.stringify(checkBoxArr) },
            success: (res) => {
                $(".deleteAction").hide();
                $("#save").hide();
                $("#cancel").hide();
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
               var div = document.createElement("div");
               div.setAttribute('id', listFromPhp[i][2]);
               div.setAttribute('style', "white-space:nowrap;");
               div.setAttribute('class', "testClass");
               html="&nbsp;<input id='"+listFromPhp[i][2]+"' type='checkbox' class='deleteAction' style='display:none'>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:15.2vw;'>"+listFromPhp[i][0].toString().replace(/\,/g,' ')+"</div>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:11vw;'>"+listFromPhp[i][1].toString().replace(/\,/g,' ')+"</div>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:6vw;text-align: center;'>"+listFromPhp[i][2].toString().replace(/\,/g,' ')+"</div>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:23vw;'>"+listFromPhp[i][3]+" "+listFromPhp[i][4]+"</div>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:9vw;text-align: center;'>"+listFromPhp[i][5].toString().replace(/\,/g,' ')+"</div>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:9vw;text-align: center;'>"+listFromPhp[i][6].toString().replace(/\,/g,' ')+"</div>";
               html+="&nbsp;<div id='"+listFromPhp[i][2]+"' class='nameLine' style='width:9vw;text-align: center;'>"+listFromPhp[i][7].toString().replace(/\,/g,' ')+"</div>";


               div.innerHTML=html;
               document.getElementById("List").appendChild(div);
            }
        }
    });
}