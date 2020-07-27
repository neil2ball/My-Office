<?php 
$title="Search result";
include'header.php';
?>
<div class="mens">    
  <div class="main">
     <div class="wrap">
		  <div class="cont span_2_of_3">
		  	<h2 class="head">Search result</h2>
        <div class="top-box">
                                    
          <?php 
            if(isset($_GET['search']))
            {

              function clean($str) {
                $str = @trim($str);
                $str = stripslashes($str);
                include ('includes/connection.php');
                return mysqli_real_escape_string($conn, $str);
              }
        
              $p_search = clean($_GET['name']);
                            
              $count = 0;
              $res1 = $conn->prepare("SELECT * FROM t_product WHERE p_name like ? OR p_desc like ?");

              $like = "%{$p_search}%";
              $res1->bind_param('ss', $like, $like);
              $res1->execute();
              $res1Result = $res1->get_result();
                          
              while ($row = mysqli_fetch_array($res1Result))
              {  
                if($count>=3)
                {
                  echo "<div class='top-box'>
                          <div class='col_1_of_3 span_1_of_3'> 
                            <a href=\"single.php?product={$row['p_id']}\">
				                    <div class='inner_content clearfix'>
				                      <div class='product_image'>
					                      <img src='{$row['p_img']}' alt='' width='200' height='200'/>
				                      </div>
                              <div class='sale-box'><span class='on_sale title_shop'>New</span></div>	
                                <div class='price'>
					                        <div class='cart-left'>
							                      <p class='title'>{$row['p_name']}</p>
							                      <div class='price1'>
							                        <span class='actual'>Rs. {$row['p_price']}</span>
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
                        
                  $count=$count-1; 
                } else {
                    echo "<div class='col_1_of_3 span_1_of_3'> 
                            <a href=\"single.php?product={$row['p_id']}\">
				                    <div class='inner_content clearfix'>
				                      <div class='product_image'>
					                      <img src='{$row['p_img']}' alt='' width='200' height='200'/>
				                      </div>
                              <div class='sale-box'><span class='on_sale title_shop'>New</span></div>	
                                <div class='price'>
					                        <div class='cart-left'>
							                      <p class='title'>{$row['p_name']}</p>
							                        <div class='price1'>
							                          <span class='actual'>Rs. {$row['p_price']}</span>
							                        </div>
					                        </div>
                            </a>    
						                    <a href ='#'><div class='cart-right'> </div></a>
						                    <div class='clear'></div>
					                      </div>				
                              </div>
                          </div>
                      ";
                    $count=$count+1; 
                }
              }

              $res1->close();
              $conn->close();

            } else {
              $product = mysqli_query($conn, "SELECT * FROM t_product ORDER BY p_id DESC");

              while ($row = mysqli_fetch_array($product))
              {
                  echo " <div class='col_1_of_3 span_1_of_3'> "; 
                    echo"<div class='inner_content clearfix'>";
                          echo "<a href=\"single.php?product={$row['p_id']}\"/>";
                      echo"<div class='product_image'> <img src='{$row['p_img']}' alt='' width='200' height='200'/> </div> ";
                              echo"<div class='sale-box'><span class='on_sale title_shop'>New</span></div>";	
                                  echo"<div class='price'>";
                                echo"<div class='cart-left'>";
                                  echo"<p class='title'>{$row['p_name']}</p>";
                                  echo"<div class='price1'>";
                                      echo"<span class='actual'>Rs. {$row['p_price']}</span>";
                                    echo"</div>";
                                echo"</div>";
                                      echo"</a>";            
                                echo"<a href ='#'><div class='cart-right'> </div></a>";
                                      echo"<div class='clear'></div>";
                            echo"</div>";
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

<script src="js/jquery.easydropdown.js"></script>

<?php 
  include 'includes/footer.php';
?>

</body>
</html>
