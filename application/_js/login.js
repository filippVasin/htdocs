/**
 * Created by root on 13.02.2017.
 */
$(document).ready(function() {



    $(document).on("click", "#try_login", function () {
        var login = $('#login_user_name').val();
        var password = $('#login_user_password').val();

        if(login == '' || password == ''){
            message('Вы не ввели данные для авторизации', 'error');
            return;
        }

        $.ajax({
            type: "POST",
            url: "/login/try_login",
            data: "login=" + login + "&password=" + password,
            success: function (answer) {
                var result = jQuery.parseJSON(answer);
                var login_result = result.status;
                var login_message = result.message;

                // Если компания, идём на /main
                if(login_result == 'company'){
                    setTimeout(function(){
                        window.location = "/main";
                    }, 0);
                }

                // Если сотрудник не прошол материалы, идём их смотреть
                if(login_result == 'employee'){
                    setTimeout(function(){
                        window.location = "/rover";
                    }, 0);
                }

                if(login_result == 'error'){
                    message(login_message, login_result);
                }


            },
            error: function () {
                console.log('error');
            }
        });
    });
});