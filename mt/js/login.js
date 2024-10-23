function _login() {

    $("#emptyLogInError").fadeOut();
    $("#logInError").fadeOut();
    $("#logInSuccess").fadeOut();
    $("#emptyTokenInError").fadeOut();
    $("#captchaError").fadeOut();
    var uss = $("#uss").val();
    uss = $.sha256(uss);
    var pss = $("#pss").val();
    pss = $.sha256(pss);
    var num = $("#num").val();
    num = $.sha256(num);
    var numm = $("#num-m").val();
    numm = $.sha256(numm);
    var token = $("#token_m").val();

    if (!uss.trim() || !pss.trim()) {
        $("#emptyLogInError").fadeIn();
        setTimeout(function() { $("#emptyLogInError").fadeOut(); }, 2000);
    } else if (num != numm) {
        $("#captchaError").fadeIn();
        setTimeout(function() { $("#captchaError").fadeOut(); }, 2000);
    } else if (!token.trim()) {
        $("#emptyTokenInError").fadeIn();
        setTimeout(function() { $("#emptyTokenInError").fadeOut(); }, 2000);
    } else {
        console.log(uss, " # ", pss, " # ", token);
        $.post("pages/login/_login.php", {
                uss: uss,
                pss: pss,
                token: token
            },
            function(data, status) {
                console.log(data);
                if (data == -7) {
                    window.location = "index.php";
                }
                if (parseInt(data) == 0) {

                    $("#logInError").fadeIn();
                }
                if (parseInt(data) <= 17 && parseInt(data) != 0 && parseInt(data) != -7) {

                    $("#logInError").fadeOut();
                    $("#logInSuccess").fadeIn("slow", function() { document.location = "home_x.php"; });
                }
                if (parseInt(data) > 17) {
                    $("#logInError").fadeOut();
                    $("#logInSuccess").fadeIn("slow", function() { window.location = "home_x.php"; });
                }

            }
        );
    }
}