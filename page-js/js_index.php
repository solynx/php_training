<script>
$(document).ready(function() {

    $("#user_logout").click(async function(e) {
        e.preventDefault();
        console.log("Dang xuat de");
        await $.ajax({
            url: "ajax/ajax_index_logout.php",
            type: "POST",
            dataType: 'json',
            data: $("#check_login_form").serialize(),
            success: function(data) {
                if (data.status) {
                    window.location.href = "/";
                }
            }
        })

    });

    async function getAllRestaurant() {
        const response = await fetch('api/api_index_get-all-restaurant.php');

        const data = await response.json();
        $("#restaurant_trending").html(data.restaurant_trending);

        $("#restaurant_saling").html(data.restaurant_sales);

        $("#restaurant_saling99k").html(data.restaurant_sale99);
    }
    getAllRestaurant();
    $("body").on("click", ".btn-view-restaurant", async function(e) {
        e.preventDefault();
        restaurantId = $(this).data("restaurant-id");

        const response = await fetch("api/api_restaurant-area_get-a-restaurant.php?id=" +
            restaurantId);
        const data = await response.json();
        if (data.status) {
            console.log(data.status)
            $("#restaurant-detail").css("display", "block");
            $("#restaurant-detail").html(data.data);

        }
    })
    $("body").on("click", "#hide-restaurant-detail", function(e) {
        e.preventDefault();
        $("#restaurant-detail").html("");
        $("#restaurant-detail").css("display", "none");
    })
    $("body").on("click", ".btn-order-table", async function(e) {
        e.preventDefault();
        $("#restaurant-detail").append(`<div id="order_confirm"></div>`);
        const response = await fetch("api/api_restaurant-area_get-user-info.php");
        const data = await response.json();

        html = `<div class="col-sm-8">
                    <div class="card">
                        <div class="card-header">
                            Thông Tin Khách Hàng
                        </div>
                        <div class="card-body">
                            <div class="col-sm-6 col-6 offset-sm-3">
                             
                                <form data-restaurant-id= method='POST' action='/order/new_order' id="user_form_confirm">
                          
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Tên khách hàng:</label>
                           
                            <input type='text' class='form-control' name='customer_full_name' value='${data.data.full_name}'
                                aria-describedby='emailHelp'>
                          

                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Số Điện Thoại</label>
                                     
                            <input type='text' maxlength='10' class='form-control' value='${data.data.fone_number}'aria-describedby='emailHelp'>
                       
                                    </div>
                                    <select class="form-select" name="time_common">
                                        <option selected>Chọn giờ đến</option>
                                        <option value="9">9 Giờ</option>
                                        <option value="10">10 Giờ</option>
                                        <option value="11">11 Giờ</option>
                                        <option value="12">12 Giờ</option>
                                        <option value="17">17 Giờ</option>
                                        <option value="18">18 Giờ</option>
                                        <option value="19">19 Giờ</option>
                                        <option value="20">20 Giờ</option>
                                        <option value="21">21 Giờ</option>
                                        <option value="22">22 Giờ</option>
                                    </select>
                                 
                                     
                                  
                                    <div class="text-center mt-3">
                                        <span>
                                            <button type="submit" id="user_confirm" class="btn btn-primary">Xác nhận đặt</button>
                                            <button type="submit" id="back_detail" class="btn btn-primary">Quay Lại</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>


                    </div>
                </div>`;
        $("#order_confirm").html(html);
    })
    $("body").on("click", "#back_detail", function(e) {
        e.preventDefault();
        $("#order_confirm").html("");
    })
    $("body").on("submit", "#user_form_confirm", async function(e) {
        e.preventDefault();
        var formData = new FormData(this);


        try {
            formData.append("restaurant_id", $(".btn-order-table").data("restaurant-id"));
            const response = await $.ajax({
                url: "ajax/ajax_restaurant-area_user-order.php",
                type: "POST",
                dataType: 'json',
                processData: false,
                contentType: false,
                data: formData
            });

            if (response.status) {

                $("#order_confirm").html("");
                alert = `<div class='alert alert-success' role='alert'>
                           Đặt bàn thành công!
                         </div>`;
                $("#error_handing").html(alert);
                setTimeout(() => {
                    $("#error_handing").html("");
                }, 5000);
            } else {
                $("#confirm_order").html("");
                alert = `<div class='alert alert-danger' role='alert'>
                       Lỗi đặt bàn!
                         </div>`;
                $("#error_handing").html(alert);
                setTimeout(() => {
                    $("#error_handing").html("");
                }, 5000);
            }
        } catch (error) {
            $("#confirm_order").html("");
            alert = `<div class='alert alert-danger' role='alert'>
                       thất bại lỗi error!
                         </div>`;
            $("#error_handing").html(alert);
            setTimeout(() => {
                $("#error_handing").html("");
            }, 5000);
        }
    })
})
</script>