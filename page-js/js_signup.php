<script>

    $(document).ready(function () {
        $("#signup_form").submit(async function (e) {
        
            e.preventDefault();
            await $.ajax({
            url: "ajax/ajax_signup_create-user.php",
            type: "POST",
            dataType:'json',
            data:  $("#signup_form").serialize(),
            success: function (data) {
                console.log(data);
                if(data.status) {
                    alert = `<div class='alert alert-success' role='alert'>
                            Đăng ký thành công! <a href="/login.php"><b>Đăng nhập</b></a>
                          </div>`;
                    $("#error_handing").html(alert);
                }
                else{
                    alert = `<div class='alert alert-danger' role='alert'>
                            Đăng ký thất bại
                          </div>`;
                    $("#error_handing").html(alert);
                }
            }
            })
        })
    })
</script>