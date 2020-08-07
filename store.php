<?php 
$title="Search result";
include'header.php';
?>
<div class="mens">    
  <div class="main">
     <div class="wrap">
		  <div class="cont span_2_of_3">
          <div class="top-box">
            <?php 
            if(isset($_GET['store']))
            {

              function clean($str) {
                $str = @trim($str);
                $str = stripslashes($str);
                include ('includes/connection.php');
                return mysqli_real_escape_string($conn, $str);
              }
        
              $p_search = clean($_GET['store']);

              $name = $conn->prepare("SELECT s_name FROM t_supplier WHERE s_id= ?");
              $name->bind_param('i', $p_search);
              $name->execute();
              $nameResult = $name->get_result();
              $nameArr = mysqli_fetch_array($nameResult);

              $nameName = $nameArr['s_name'];
              ?><h2 class="head">Store of <?php echo $nameName?></h2><?php
                            
              $count = 0;
              $res1 = $conn->prepare("SELECT * FROM t_product WHERE s_id= ?");
              $res1->bind_param('i', $p_search);
              $res1->execute();
              $res1Result = $res1->get_result();
                          
              while ($row = mysqli_fetch_array($res1Result))
              {
                if($row['p_qty'] > 0)
                {
                  echo "<div class='top-box'>
                        <div class='col_1_of_3 span_1_of_3'> 
                          <a href=\"single.php?product={$row['p_id']}\">
				                  <div class='inner_content clearfix'>
				                    <div class='product_image'>
					                    <img src='../{$row['p_img']}'/>
				                    </div>
                            <div class='sale-box'><span class='on_sale title_shop'>New</span></div>	
                              <div class='price'>
					                      <div class='cart-left'>
							                    <p class='title'>{$row['p_name']}</p>
							                      <div class='price1'>
							                        <span class='actual'>₩₡ {$row['p_price']}</span>
							                      </div>
					                      </div>
                                </a>    
						                    <a href ='#'><div class='cart-right'> </div></a>
						                    <div class='clear'></div>
					                    </div>				
                            </div>
                          </div>
                        </div>

                      ";
                }
              }

              $res1->close();
              $conn->close();

            } else {
              
		  	      ?><h2 class="head">Stores</h2><?php

              $product = mysqli_query($conn, "SELECT * FROM t_supplier ORDER BY s_id ASC");

              while ($row = mysqli_fetch_array($product))
              {
                    echo " <div class='col_1_of_3 span_1_of_3'> "; 
                      echo"<div class='inner_content clearfix'>";
                        echo "<a href=\"store.php?store={$row['s_id']}\"/>";
                          echo"<p class='title'>{$row['s_name']}</p>";
                        echo"</a>";
                      echo"</div>";
                    echo"</div>";
              }
            }
            
            ?>
                        
                        
		     </div>	
					 							 			    
		  </div>
			
			<div class="clear"></div>
			</div>
		   </div>
		</div>
	</div>
</div>

<script src="js/jquery.easydropdown.js"></script>

<?php 
  include 'includes/footer.php';
?>

</body>
</html>
