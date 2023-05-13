<script>
    $(document).ready(function() {

        $("#user_logout").click(async function(e) {
            e.preventDefault();
            console.log("Dang xuat de");
            await $.ajax({
            url: "ajax/ajax_index_logout.php",
            type: "POST",
            dataType:'json',
            data:  $("#check_login_form").serialize(),
            success: function (data) {
                if(data.status) {
                    window.location.href = "/";
                }
            }
        })
      
        });
     
        async function getAllRestaurant() {
            const response= await fetch('api/api_index_get-all-restaurant.php');
           
            const data = await response.json();
            $("#restaurant_trending").html(data.restaurant_trending);

            $("#restaurant_saling").html(data.restaurant_sales);

            $("#restaurant_saling99k").html(data.restaurant_sale99);
        }
        getAllRestaurant();
    })

</script>