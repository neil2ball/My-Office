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
              <th>Price Per Item</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Total</th>
              
            </tr>
          </thead>
          <tbody id="myTable">
            <?php
            $num = 1;
            $total = 0;
              while ($row1 = mysqli_fetch_array($cartResult)) {
              $ttl_amt  =  $row1['p_price']*$row1['c_p_qty'];
                  
                echo"<tr>
                    <td> $num  </td> 
                    <td> {$row1['p_name']} </td>
                    <td> ₩₡ {$row1['p_price']}</td>
                    <td> {$row1['c_p_qty']}</td> 
                    <td> $ttl_amt</td>
                  </tr> ";
                    $num = $num+1;
                    $total = $total + $ttl_amt;
              }
              echo"<tr>
              <td></td> 
              <td></td>
              <td></td>
              <td></td> 
              <td></td>
              <td>$total</td>
              </tr> "; 
                  ?>
            
          </tbody>
        </table>   
      </div>
      <div class="col-md-12 text-center">
      <ul class="pagination pagination-lg pager" id="myPager"></ul>
      </div>
	</div>
    
    <span class="input-group-btn">
      <form action='' method='POST'>
        <input type='submit' name='submit' value='Commit to Buy' style="font-size : 20px; width: 100%; height: 100px;" />
      </form>
      <?php   
      
        if(isset($_POST['submit']))
        {
          $success = 0;
          $buyer = $conn->prepare("SELECT * FROM t_supplier WHERE s_id = ?");
          $buyer->bind_param('s', $id);
          $buyer->execute();
          $buyerResult = $buyer->get_result();
          $buy = mysqli_fetch_array($buyerResult);

          $buyId = $buy['s_id'];
          $buyName = $buy['s_name'];
          $buyEmail = $buy['s_email'];
          $buyTeachEmail = $buy['a_id'];
          $buyLoc = $buy['s_loc'];
          $buyBal = $buy['s_bal'];

          $cart = $conn->prepare("SELECT * FROM t_cart WHERE u_id = ?");
          $cart->bind_param('s', $id);
          $cart->execute();
          $cartResult = $cart->get_result();

          while ($row1 = mysqli_fetch_array($cartResult))
          {

            $c_id   = $row1['c_id'];
            $b_id   = $row1['u_id'];
            $s_id   = $row1['s_id'];
            $p_id   = $row1['p_id'];
            $p_amt  = $row1['c_p_qty'];
            $p_price  = $row1['p_price'];
            $p_name = $row1['p_name'];

            $price = $p_amt * $p_price;

            $seller = $conn->prepare("SELECT * FROM t_supplier WHERE s_id = ?");
            $seller->bind_param('s', $s_id);
            $seller->execute();
            $sellerResult = $seller->get_result();
            $sell = mysqli_fetch_array($sellerResult);
            
            $sellId = $sell['s_id'];
            $sellName = $sell['s_name'];
            $sellEmail = $sell['s_email'];
            $sellTeachEmail = $sell['a_id'];
            $sellLoc = $sell['s_loc'];

            if($buyBal >= $price)
            {
              $buyBal = $buyBal - $price;
              $buyUp = $conn->prepare("UPDATE t_supplier SET s_bal = ? WHERE s_id = ?");
              $buyUp->bind_param('ii', $buyBal, $buyId);
              $buyUp->execute();

              echo mysqli_error($conn);

              $buyVer = 0;
              $sellVer = 0;
              $date_now = date('Y-m-d H:i:s');                      
              $save = $conn->prepare("INSERT INTO t_order_user_det ( p_id, p_name, p_amt, b_id, b_name, b_email, b_t_email, b_loc, s_id, s_name, s_email, s_t_email, s_loc, o_date, o_price, o_escrow, b_ver, s_ver) "
              . "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $save->bind_param('isiissssisssssiiii', $p_id, $p_name, $p_amt, $buyId, $buyName, $buyEmail, $buyTeachEmail, $buyLoc, $sellId, $sellName, $sellEmail, $sellTeachEmail, $sellLoc, $date_now, $price, $price, $buyVer, $sellVer);
              $save->execute();

              $cart = $conn->prepare("DELETE FROM t_cart WHERE c_id = ?");
              $cart->bind_param('s', $c_id);
              $cart->execute();
              $success = 1;
            } else
            {
              $success = 0;
            }
          }

          if ($success)
          {
            echo("<script type=\"text/javascript\">
              window.location.href='data.php?order';
            </script>");
          } else
          {
            echo("<script type=\"text/javascript\">
              window.location.href='checkout.php';
            </script>");
          }
        }

      ?>
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
