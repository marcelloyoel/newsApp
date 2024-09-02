console.log('hi2');
function validateEmail(email) {
    // Regular expression for basic email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

function validasiForm(){
    if(document.getElementById('username').value === "") return "Username Tidak Boleh Kosong!";
	else if(document.getElementById('email').value === "") return "Email Tidak Boleh Kosong!";
	else if(document.getElementById('name').value === "") return "Display Name Tidak Boleh Kosong!";
	else if(document.getElementById('password').value === "") return "Password Tidak Boleh Kosong!";
    else if(!validateEmail(document.getElementById('email').value)) return "Email Tidak Valid!";
    else return true;
}

function alertMain(alertText){
	window.scrollTo(0, 0);
	$("#alert-main").remove();
	$(".alertNih").prepend('<div class="alert alert-warning" id="alert-main" role="alert">'+alertText+'</div>');
}


$(document).ready(function(){
    $('#submitBtn').on('click', function(e){
        console.log('masuk sini');
        $('#spinnerLoading').css("display", "block");
        $('#tulisDisini').css("color", "black")
        $('#tulisDisini').text('Melakukan validasi data...').show();
        setTimeout(function() {
            let validasi = validasiForm();
            if(validasi == true){
                $('#tulisDisini').text('Mengirim data...').show();
                $('#submitBtn').submit();
            }else{
                $('#tulisDisini').text('')
                $('#spinnerLoading').css("display", "none");
                $('#tulisDisini').css("display", "none");
                alertMain(validasi);
            }
        }, 900);
    });
})
