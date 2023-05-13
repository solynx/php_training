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
            console.log("var : "+currentScrollPosition)
           
            console.log("fixed : "+restaurant_final_offset)
           
            
            if(currentScrollPosition >= (restaurant_final_offset-330) ) {
              
                flag=false;
                restaurant_db_offset = restaurant_db_offset + 12;
               await filterRestaurantArea(restaurant_db_offset);
               flag = true;
                
            }
        }
       }
      
    
      });
     
     async function filterRestaurantArea (offset = 1) {
     
        host =  getHost();
     
  
        area_name = $("#area_value").val();
       await $.ajax({
            url: "http://"+host+"/restaurant/area_filter?offset="+offset,
            type: "POST",
            dataType:'json',
            data:{
              area_value:$("#area_value").val()
            },
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
                            <img src='http://${host}/storage/${item.image_url}' style='max-height: 165px;' class='card-img-top' alt='...'>
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
                    <form method='POST' action='http://${host}/restaurant/restaurant_detail'>
                        <input type='hidden' name='restaurant_id' value='"${item.id}"'/>
                        <div class='text-center'>
                            <button type='submit' class='btn btn-info'>Xem Thông Tin</button>
                        </div>
                    </form>
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
    function getHost () {
        return window.location.hostname;
    }
});

