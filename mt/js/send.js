$(document).ready(
    function() {
        $("#smstxt").val('');
        $("#sdate").val();
    }

);



function _send() {

    $("#res").fadeOut();
    var code = $("#service_id").val();
    var smstxt = $("#smstxt").val();
    var sdate = $("#sdate").val();

    if (!code.trim() || !smstxt.trim() || !sdate.trim()) {
        alert('please enter all data.');
    } else {
        $.post("pages/insert/insert_sms.php", {
                code: code,
                smstxt: smstxt,
                sdate: sdate

            },
            function(data, status) {
                $("#res").fadeIn();
                $("#smstxt").val('');
            }
        );
    }
}