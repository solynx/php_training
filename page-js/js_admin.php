<script>
    $(document).ready(function () {
        restaurant_offset = 0;
        order_offset =  0;
        $("#new_restaurant").click(function (e) {
            e.preventDefault();
            content = `<div class="container">
                            <div class="row">
                                <div class="card">
                                    <div class="card-header">
                                        Thêm Nhà Hàng
                                    </div>
                                   
                                    <div class="row">
                                        <div class="col-sm-6 offset-sm-3">
                                            <div class="card-body">
                                                <h5 class="card-title">Thông Tin Nhà Hàng</h5>
                                                <form method="POST" action="#" enctype="multipart/form-data" id="create_restaurant_form">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Tên Nhà Hàng:</label>
                                                        <input type="text" class="form-control" name="restaurant_name">

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Địa chỉ:</label>
                                                        <input type="text" class="form-control" name="restaurant_address">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Số điện thoại:</label>
                                                        <input type="text" class="form-control" maxlength="10" name="restaurant_fone_num">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Số chỗ ngồi:</label>
                                                        <input type="number" class="form-control" name="restaurant_slot">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Giá hiện tại:</label>
                                                        <input type="number" class="form-control" name="restaurant_price">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Giá khuyễn mãi (nếu có):</label>
                                                        <input type="number" class="form-control" name="restaurant_sale_price">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">Chọn 1 ảnh nhà hàng</label>
                                                        <input class="form-control" type="file" id="formFile" name="restaurant_image">
                                                    </div>
                                                    <div id="error_handing"></div>
                                                    <button type="submit" class="btn btn-primary offset-5">Thêm Nhà Hàng</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>`;
            $("#admin_content").html(content);
        });

        $("#list_restaurent").click(async function (e) {
            e.preventDefault();
            const response= await fetch('api/api_admin_get-offset-restaurant.php?offset='+restaurant_offset);
           
            const data = await response.json();

                content = `<div class="container">
                    <div class="row">
                        <div class="card">
                            <div class="card-header" id="restaurant_header">
                                Danh Sách Nhà Hàng
                            </div>
                        
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-body">
                                    <div class='col-sm-6 offset-sm-3' id="restaurant_option">

                                    </div>
                                        <table class="table" id="table_restaurant">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Tên Nhà Hàng</th>
                                                    <th scope="col">Địa Chỉ</th>
                                                    <th scope="col">Số Điện Thoại</th>
                                                    <th scope="col">Chức Năng</th>
                                                </tr>
                                            </thead>
                                            <tbody id="list_restaurant">
                                                



                                            </tbody>
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <p class="text-center" id="more_restaurant">Hiển thị thêm</p>
                        </div>
                    </div>
                  
                </div>`;
               await $("#admin_content").html(content);
              if(data.status){
                $("#list_restaurant").html(data.data);
              }
              else{
                $("#more_restaurant").css("display", "none");
              }

        })

        $("body").on("click", ".btn-detail-restaurant",async function (e) {
       
            e.preventDefault();
            var restaurantId = $(this).data("restaurant-id");
           
            const response= await fetch('api/api_admin_get-a-restaurant.php?id='+restaurantId);
            
            const data = await response.json();

            if(data.status) {
                $("#restaurant_option").html(data.data).css("display","block");
                $("#table_restaurant").css("display", "none");
                $("#restaurant_header").html("Chi Tiết Nhà Hàng");
                $("#more_restaurant").css("display", "none");
            }
        })

        
        $("body").on("click", ".btn-edit-restaurant",async function (e) {
       
       e.preventDefault();
       var restaurantId = $(this).data("restaurant-id");
      
       const response= await fetch('api/api_admin_get-edit-restaurant.php?id='+restaurantId);
       
       const data = await response.json();

       if(data.status) {
            let result = data.data;
            content = `<form method='POST' data-restaurant-id="${result.id}" id="update_restaurant_form" action='http://$HTTP_HOST/admin/update_restaurant' enctype='multipart/form-data'>
                        
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Tên Nhà Hàng:</label>
                           
                                <input type='text' class='form-control' value='${result.name}'name='restaurant_name'>
                                
                              
                             
                                
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Địa chỉ:</label>
                                <input type='text' class='form-control' value='${result.address}'
                                    name='restaurant_address'> 
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Số điện thoại:</label>
                                <input type='text' class='form-control' value='${result.fone_number}'
                                    name='restaurant_fone_num'>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Số chỗ ngồi:</label>
                                <input type='number' class='form-control' value='${result.slot_num}'
                                    name='restaurant_slot'>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Giá hiện tại:</label>
                                <input type='number' class='form-control' value='${result.price}'
                                    name='restaurant_price'>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Giá khuyễn mãi:</label>
                                <input type='number' class='form-control' value='${result.sale_price}'
                                    name='restaurant_sale_price'>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Chọn 1 ảnh nhà hàng</label>
                                <input class="form-control" type="file" id="formFile" name="restaurant_image">
                            </div>
                            <div id="error_handing"></div>
                            <button type="submit" class="btn btn-primary offset-5">Sửa Thông Tin</button>
                        </form>`;

           $("#restaurant_option").html(content).css("display","block");
           $("#table_restaurant").css("display", "none");
           $("#restaurant_header").html("Chỉnh Sửa Nhà Hàng");
           $("#more_restaurant").css("display", "none");
       }
        })

        $("body").on("submit", "#update_restaurant_form",function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            var restaurantId = $(this).data("restaurant-id");
            editRestaurant(formData,restaurantId);
        })

        $("body").on("click", "#hide_detail_restaurant",async function (e) {
       
            e.preventDefault();
           
                $("#restaurant_option").css("display","none");
                $("#table_restaurant").css("display", "block");
                $("#restaurant_header").html("Danh Sách Nhà Hàng");
                $("#more_restaurant").css("display", "block");
                
        });

        $("body").on("click", "#more_restaurant",async function (e) {
           
            e.preventDefault();
            restaurant_offset = restaurant_offset + 12;
            const response= await fetch('api/api_admin_get-offset-restaurant.php?offset='+restaurant_offset);
        
            const data = await response.json();
            if(data.status) {
                $("#list_restaurant").append(data.data);
            }
            else{
                $(this).css("display", "none");
              }
        })

       
       async function editRestaurant(formData,id) {
           try {
               const response = await $.ajax({
                   url: "ajax/ajax_admin_update-restaurant.php?id="+id,
                   type: "POST",
                   dataType: 'json',
                   processData: false,
                   contentType: false,
                   data: formData
               });
              
               if(response.status) {
       
               
                   alert = `<div class='alert alert-success' role='alert'>
                           Cập nhật nhà hàng thành công!
                         </div>`;
                   $("#error_handing").html(alert);
                   setTimeout( () =>{$("#error_handing").html("");}, 5000);
               }
               else{
                   alert = `<div class='alert alert-danger' role='alert'>
                       Sửa nhà hàng thất bại!
                         </div>`;
                   $("#error_handing").html(alert);
                   setTimeout( () =>{$("#error_handing").html("");}, 5000);
               }
           } catch (error) {
        
               alert = `<div class='alert alert-danger' role='alert'>
                       Sửanhà hàng thất bại lỗi error!
                         </div>`;
                   $("#error_handing").html(alert);
                   setTimeout( () =>{$("#error_handing").html("");}, 5000);
           }
        }
        $("body").on("click", ".btn-delete-restaurant",async function (e) {
            e.preventDefault();
            var restaurantId = $(this).data("restaurant-id");
       
            try {
                var formData = new FormData();
                formData.append("id", restaurantId);
                const response = await $.ajax({
        
                    url: "ajax/ajax_admin_delete-restaurant.php",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formData
                });
                if(response.status) {
                    theRow= $(this).closest("tr");
                    theRow.remove();
                    alert = `<div class='alert alert-success' role='alert'>
                            Thêm nhà hàng thành công!
                          </div>`;
                    $("#admin_alert").html(alert);
                    setTimeout( () =>{$("#admin_alert").html("");}, 5000);
                }
                else{
                    alert = `<div class='alert alert-danger' role='alert'>
                        Thêm nhà hàng thất bại!
                          </div>`;
                          $("#admin_alert").html(alert);
                          setTimeout( () =>{$("#admin_alert").html("");}, 5000);
                }
            } catch (error) {
                console.log(error);
                alert = `<div class='alert alert-danger' role='alert'>
                        Thêm nhà hàng thất bại error!!
                          </div>`;
                          $("#admin_alert").html(alert);
                          setTimeout( () =>{$("#admin_alert").html("");}, 5000);
            }
            
        })
        $("body").on("submit", "#create_restaurant_form",  function (e) {
           
            e.preventDefault();
            var formData = new FormData(this);
           
            submitFormData(formData);
        });
        
        async function submitFormData(formData) {
            try {
                const response = await $.ajax({
                    url: "ajax/ajax_admin_create-restaurant.php",
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    data: formData
                });
                if(response.status) {
                    $('#create_restaurant_form')[0].reset();
                    alert = `<div class='alert alert-success' role='alert'>
                            Thêm nhà hàng thành công!
                          </div>`;
                    $("#error_handing").html(alert);
                    setTimeout( () =>{$("#error_handing").html("");}, 5000);
                }
                else{
                    alert = `<div class='alert alert-danger' role='alert'>
                        Thêm nhà hàng thất bại!
                          </div>`;
                    $("#error_handing").html(alert);
                    setTimeout( () =>{$("#error_handing").html("");}, 5000);
                }
            } catch (error) {
                
                alert = `<div class='alert alert-danger' role='alert'>
                        Thêm nhà hàng thất bại!
                          </div>`;
                    $("#error_handing").html(alert);
                    setTimeout( () =>{$("#error_handing").html("");}, 5000);
            }
    }


    // =-=--------------============= ORDER
    $("#order_today").click(async function (e) {
        e.preventDefault();
        order_offset = 0;
        content = `<div class="container">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    Danh Sách Đặt Bàn Hôm Nay
                                </div>
                                <div id="error_handing"></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Tên Khách Hàng</th>
                                                        <th scope="col">Số Điện Thoại</th>
                                                        <th scope="col">Giờ Đến</th>
                                                        <th scope="col">Tại Nhà Hàng</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="list_order">
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div id="user_alert" class="text-center">
                             
                            </div>
                        </div>
                    </div>`
        
            await $("#admin_content").html(content);
           
            const response = await  fetch("api/api_admin_get-offset-order.php?offset="+order_offset);
            const data = await response.json();
        
            if(data.status) {
               if(data.orders !== "empty") {
                    $("#list_order").html(data.orders);
                    
                    view_more = `<p class="text-center" id="more_order">Hiển thị thêm</p>`;
                    $('#user_alert').html(view_more);
             
               }
               else{
                empty_text = `<p>Oh no! Hôm nay chưa có ai đặt bàn, thật là ế ẩm </p>`;
                $('#user_alert').html(empty_text);
               }
            }
            
    })
    $("body").on("click","#more_order",async function (e) {
        e.preventDefault();
        order_offset = order_offset + 12;
        const response = await  fetch("api/api_admin_get-offset-order.php?offset="+order_offset);
        const data = await response.json();
        if(data.status) {
               if(data.orders !== "empty") {
                    $("#list_order").append(data.orders);
                    
                    view_more = `<p class="text-center" id="more_order">Hiển thị thêm</p>`;
                    $('#user_alert').html(view_more);
             
               }
               else{
                empty_text = `<p>Oh no! Hết người đặt bàn rồi, thật là ế ẩm </p>`;
                $('#user_alert').html(empty_text);
               }
            }
    })
    $("#all_order").click(async function (e) {
        e.preventDefault();
        content=`
                <div class="container">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                Danh Sách Đặt Bàn
                            </div>
                            <div class="row">
                                <div class="col-sm-4 mt-3">
                                
                                    <form action='order' method='POST'>
                               
                                        <select id="date_filter" class="form-select" name="date_filter" aria-label="Default select example">
                                            <option selected>Lọc theo ngày</option>
                                        </select>
                                  
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-body" id="order_table">
                                       
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>`;
        await $("#admin_content").html(content);
        const response = await  fetch("api/api_admin_get-date-filter.php");
        const data = await response.json();
       
        $("#date_filter").append(data.date_history);
    })

    $("body").on("change","#date_filter",async function (e) {
        e.preventDefault();
       
        
        content = `<table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên Khách Hàng</th>
                                    <th scope="col">Số Điện Thoại</th>
                                    <th scope="col">Giờ Đến</th>
                                    <th scope="col">Tại Nhà Hàng</th>
                                </tr>
                            </thead>
                            <tbody id="order_list">
                            </tbody>
                        </table>`
        await $("#order_table").html(content);
        const response = await fetch("api/api_admin_filter-order-by-date.php?date="+$(this).val());


        const data = await response.json();
        if(data.status) {
                 
            $("#order_list").html(data.orders);
        }
    })
        
    })


</script>

