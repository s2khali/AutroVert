$("#btnSignup").click(function (e) {
    $.ajax({
        type: "post",
        url: "api/index.php?url=users",
        processData: false,
        data: '{ "username": "'+ $("#reg_uname").val() +'", "email": "'+$("#reg_email").val() +'", "password": "'+ $("#reg_pass").val() +'" }',
        success: function(r) {
            document.location.href = "/home";
        },
        error: function(r) {
            console.log(r.responseText)
        }
    })
    e.preventDefault();
})

$("#btnLogin").click(function (e) {
    $.ajax({
        type: "post",
        url: "api/index.php?url=auth",
        processData: false,
        data: '{ "username": "'+ $("#txt_uname").val() +'", "password": "'+ $("#txt_pass").val() +'" }',
        dataType: "json",
        success: function(r) {
            console.log(r);
            document.location.href = "/home";
        },
        error: function(r) {
            console.log(r)
        }
    })
    e.preventDefault();
})

