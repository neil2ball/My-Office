<?php  
$title="Cart";
include'header.php';

?>

<div class="container">
	<div class="row">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Delete</th>
              
            </tr>
          </thead>
          <tbody id="myTable">
            <?php
            $num = 1;
              while ($row1 = mysqli_fetch_array($cartResult)) {
              $ttl_amt  =  $row1['p_price']*$row1['c_p_qty'];
                  
                echo"<tr>
                    <td> $num  </td> 
                    <td> {$row1['p_name']} </td>
                    <td> Rs.{$row1['p_price']}</td>
                    <td>  <input type='text' value='{$row1['c_p_qty']}'></td> 
                    <td> $ttl_amt</td>
                    <td><a href=\"cart.php?del_id={$row1['p_id']}\">Delete Product</a></td>
                  </tr> ";
                    $num = $num+1;
              }  
                  ?>
            
          </tbody>
        </table>   
      </div>
      <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
      </div>
	</div>
    
    <span class="input-group-btn">
      <?php   echo"<a class='btn btn-default' href=\"invoice.php?inv_id=$id\">CheckOut!</a>" ; ?>
      </span>
</div>

<script>

$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 7,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
  	pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};

$(document).ready(function(){
    
  $('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:4});
    
});
</script>

<?php 
if(isset($_SERVER['QUERY_STRING'])){

	function clean($str) {
		$str = @trim($str);
		$str = stripslashes($str);
		include ('../includes/connection.php');
		return mysqli_real_escape_string($conn, $str);
	}
	

    $get_string = $_SERVER['QUERY_STRING'];
    parse_str($get_string, $get_array);

    if(isset($get_array['del_id'])) {

        $p_id = clean($get_array['del_id']);

        $del_product = $conn->prepare("SELECT c_id FROM t_cart WHERE p_id= ? AND u_id= ?");
        $del_product->bind_param('ss', $p_id, $id);
        $del_product->execute();
        $del_productResult = $del_product->get_result();

        if ($row2 = mysqli_fetch_array($del_productResult))
        {
            $prdt_del = clean($row2['c_id']);
            $del_prdt = $conn->prepare("DELETE FROM t_cart WHERE c_id= ?");
            $del_prdt->bind_param('s', $prdt_del);
            $del_prdt->execute();
            $del_prdtResult = $del_prdt->get_result();
        }
    }
}
 else {
    
}

?>
