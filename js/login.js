$(document).ready(function(){ 
    $("#userid").focus();

    $("#userid").keyup(function() {
        if ($("#userid").val() != '') {
            $(".error_msg").css("display","none");
            $("#userid").removeClass("input_error");
            $("#loginform").removeClass("user-was-validated");
            return false;
        };
    });
    $("#password").keyup(function() {

        if ($("#password").val() != '') {
            $(".error_msg").css("display","none");
            $("#password").removeClass("input_error");
            $("#loginform").removeClass("user-was-validated");
            return false;
        };
    });

    $("#loginform").submit(function(e) {

        if ($("#userid").val() == '') {
            $(".error_msg").css("display","block");
            $(".error_msg").html('아이디를 입력하세요.');
            $("#userid").focus();
            return false;
        }

        if ($("#password").val() == '') {
            $(".error_msg").css("display","block");
            $(".error_msg").html('패스워드를 입력하세요.');
            $("#password").focus();
            return false;
        }

        e.preventDefault();

        var action = $("#loginform").attr('action');
		var form_data = {
			user_id: $("#userid").val(),
			user_pw: $("#password").val(),
			is_ajax: 1
		};
		$.ajax({
			type: "POST",
			url: action,
			data: form_data,
			success: function(response) {
				if(response == 'success') {
                    window.location.href = 'main.php';				
                }
				else {
                    $(".error_msg").css("display","block");
					$(".error_msg").html('아이디 또는 비밀번호가 잘못되었습니다.');	
                    $("#userid").addClass("input_error");
                    $("#password").addClass("input_error");
                    $("#userid").focus();
				}
			}
		});
		return false;
    });

    var forms = $('.needs-validation');
    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if(form.checkValidity() === false){
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('user-was-validated');
        }, false);
    });
});