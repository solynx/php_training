<script>
$(document).ready(function () {
    var restaurant_final_offset =0;
    var restaurant_db_offset =1;
    var flag = true;
    var not_empty_restaurant = true;
    var old_area ="";
    $("#area_submit").submit(async function (e) {
        e.preventDefault();
        if(old_area !== $("#area_value").val()) {
            await filterRestaurantArea();
        }
        
      
    })
    $(window).scroll(async function() {
       if(not_empty_restaurant) {
        if(flag) {
            var currentScrollPosition = $(window).scrollTop();
        
           
            
            if(currentScrollPosition >= (restaurant_final_offset-330) ) {
              
                flag=false;
                restaurant_db_offset = restaurant_db_offset + 12;
               await filterRestaurantArea(restaurant_db_offset);
               flag = true;
                
            }
        }
       }
      
    
      });
     
     async function filterRestaurantArea (offset = 0) {
     
        host =  getHost();
     
  
        area_name = $("#area_value").val();

       await $.ajax({
            url: "api/api_restaurant-area_filter.php?offset="+offset+"&area="+area_name,
            type: "GET",
            dataType:'json',
           
            success: function (data) {
               
                if (!data.data.length) {
                    empty_restaurant = false;
                } 
                if(old_area !== area_name) {
                    
                    $("#restaurant_list_filter").empty();
                    old_area = area_name;
                }
                if (data.status) {
                    data.data.forEach(function (item) {
                        
                        var addressParts = item.address.split(",");
                        item.address = addressParts[addressParts.length - 1].trim();
                        var child = `
                        <div class='col-sm-3 mt-3 restaurant_filter_item'>
                        <div class='card'>
                            <img src='./uploads/${item.image_url}' style='max-height: 165px;' class='card-img-top' alt='...'>
                            <div class='card-body'>
                        <h5 class='card-title'>${item.name}</h5>
                        <p class='card-text'>
    
                            <div><b>Khu vực:</b> <small>${item.address}</small></div>
                            <div class='row'>
                                <div class='col-6'>
                                    <i class='fa fa-star' style='color:#ffc107'></i> ${item.star_total}
                                </div>
                                <div class='col-6'>
                                <small class='float-end'>  ${item.count_order} lượt đặt</small>
                                </div>
                            </div>
                        </p>
                  
                     
                        <div class='text-center'>
                            <button type='submit' data-restaurant-id="${item.id}" class='btn btn-info btn-restaurant-detail'>Xem Thông Tin</button>
                        </div>
                
                    </div>
                    </div>
                </div>
                        `
                        // thêm thẻ con vào thẻ cha
                        $("#restaurant_list_filter").append(child); 
                     
                    })
                    
                }
                restaurant_final_offset =$(".restaurant_filter_item").last().offset().top;
      
            }
        })
        
    }

    $("body").on("click",".btn-restaurant-detail",async function (e) {
       
        var restaurantId = $(this).data("restaurant-id");
       
        const response = await fetch("api/api_restaurant-area_get-a-restaurant.php?id="+restaurantId);
        const data =await response.json();
        if(data.status) {
            $("#restaurant_detail").css("display","block");
            $("#restaurant_detail").html(data.data);
            $("#restaurant_list_filter").css("display","none");
        }
    })
    $("body").on("click","#hide-restaurant-detail",function (e) {
        e.preventDefault();
        $("#restaurant_detail").html("");
        $("#restaurant_detail").css("display","none");
        $("#restaurant_list_filter").css("display","flex");
        
    })

    $("body").on("click",".btn-order-table",async function (e) {
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
        $("#confirm_order").html(html);
    })
    $("body").on("click", "#back_detail", async function (e) {
        e.preventDefault();
        $("#confirm_order").html("");
    })
    $("body").on("submit","#user_form_confirm",async function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        try {
                formData.append("restaurant_id",$(".btn-order-table").data("restaurant-id"));
               const response = await $.ajax({
                   url: "ajax/ajax_restaurant-area_user-order.php",
                   type: "POST",
                   dataType: 'json',
                   processData: false,
                   contentType: false,
                   data: formData
               });
              
               if(response.status) {
       
                $("#confirm_order").html("");
                   alert = `<div class='alert alert-success' role='alert'>
                           Đặt bàn thành công!
                         </div>`;
                   $("#error_handing").html(alert);
                   setTimeout( () =>{$("#error_handing").html("");}, 5000);
               }
               else{
                $("#confirm_order").html("");
                   alert = `<div class='alert alert-danger' role='alert'>
                       Lỗi đặt bàn!
                         </div>`;
                   $("#error_handing").html(alert);
                   setTimeout( () =>{$("#error_handing").html("");}, 5000);
               }
           } catch (error) {
            $("#confirm_order").html("");
               alert = `<div class='alert alert-danger' role='alert'>
                       thất bại lỗi error!
                         </div>`;
                   $("#error_handing").html(alert);
                   setTimeout( () =>{$("#error_handing").html("");}, 5000);
           }
    })
    function getHost () {
        return window.location.hostname;
    }
});

</script>