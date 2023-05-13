<script>
       $(document).ready(function() {
        $("#check_login_form").submit(async function (e) {
        e.preventDefault();
        await $.ajax({
            url: "ajax/ajax_login_check-user.php",
            type: "POST",
            dataType:'json',
            data:  $("#check_login_form").serialize(),
            success: function (data) {
                if(data.status) {
                    window.location.href = "/";
                }
                else{
                    error = `<div class='alert alert-danger' role='alert'>
                            Tên đăng nhập hoặc mật khẩu không chính xác !
                          </div>`;
                    $("#error_handing").html(error);
                }
            }
        })
      
        });
    
  
    })
</script>