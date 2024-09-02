console.log('hi');
$(document).ready(function(){
    $('#loginBtn').on('click', function(e){
        console.log('masuk sini ga');
        e.preventDefault();
        $('#spinnerLoading').css("display", "block");

        $.ajax({
            url: '/login',
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                username: $('#username').val(),
                password: $('#password-input').val()
            },
            success: function(response){
                console.log(response);
                $('#spinnerLoading').css("display", "none");
                $('#loginError').css("color", "green").text('Login berhasil! Menuju Halaman Home.').show();
                window.location.href = '/';
            },
            error: function(response) {
                console.log(response);
                $('#spinnerLoading').css("display", "none");
                $('#loginError').css("color", "red").text(response.responseJSON["error"]).show();
                console.log('salah');
            }
        })
    })
})
