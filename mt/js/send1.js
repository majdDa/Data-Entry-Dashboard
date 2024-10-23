$(document).ready(
    function() {
        $("#smstxt").val('');
        // $("#sdate").val();
    }

);




function _send() {

    console.log("_send")
    document.getElementById("addButton").disabled = true;

    $("#res").fadeOut();
    $("#ContentExistResponse").fadeOut();
    var code = $("#service_id").val();
    var smstxt = $("#smstxt").val();
    var sdate = $("#sdate").val();

    if (!code.trim() || !smstxt.trim() || !sdate.trim()) {
        alert('please enter all data..');
    } else {


        $.post("pages/insert/insert_sms1.php", {
                code: code,
                smstxt: smstxt,
                sdate: sdate
            },
            function(data, status) {

                if (data == '1') {
                    $("#res").fadeIn();
                    $("#smstxt").val('');
                } else {
                    $("#ContentExistResponse").fadeIn();
                }

            }
        );
    }

    setTimeout(function() {
        document.getElementById("addButton").disabled = false;
    }, 2000);

}


function showDeleteDialog(id) {
    var id = id;
    BootstrapDialog.show({
        title: 'Delete SMS',
        message: 'Delete this SMS ?',
        buttons: [{
            label: 'Accept',
            action: function(dialog) {
                deleteSms(id);
                //alert(id);
            }
        }, {
            label: 'Cancel',
            action: function(dialog) {
                // dialog.setTitle('Title 2');
                dialog.close();
            }
        }]
    });
}

function deleteSms(id) { //dialog.close();
    var id = id;
    $.post("pages/delete/delete_sms.php", {
            id: id

        },
        function(data, status) { //alert(data);
            if (data == '1') {
                BootstrapDialog.show({
                    title: 'SMS Deleted',
                    message: 'SMS Deleted',
                    buttons: [{
                        label: 'Close',
                        action: function(dialog) {
                            // dialog.setTitle('Title 2');
                            dialog.close();
                            window.location = "sms.php";
                        }
                    }]
                });
            } else {
                BootstrapDialog.show({
                    title: 'SMS Not Deleted',
                    message: 'SMS Not Deleted',
                    buttons: [{
                        label: 'Close',
                        action: function(dialog) {
                            // dialog.setTitle('Title 2');
                            dialog.close();
                            window.location = "sms.php";
                        }
                    }]
                });
            }
        }
    );

}



function _Test_MTN_Mt() {
    $("#res").fadeOut();
    $("#ErrorRes").fadeOut();
    $("#ErrorResponse").fadeOut();
    $("#SuccessResponse").fadeOut();

    var smstxt = $("#smstxt").val();

    if (!smstxt.trim()) {
        alert('Please Enter Text !!');
    } else {
        $.post("pages/test/test_sms.php", {
                smstxt: smstxt,
            },
            function(data, status) {
                if (data == 1) {
                    $("#SuccessResponse").fadeIn();
                    //$("#smstxt").val('');
                } else {
                    //console.log(data);
                    //$("#ErrorResponse").fadeIn();
                }

            }
        );
    }


}