<?php 
$title="Home";
include 'header.php';
?>
  <!-- start slider -->
    <div id="fwslider">
        <div class="slider_container">
            <div class="slide"> 
                <!-- Slide image -->
                    <img src="../images/wildcatlow.jpg" alt=""/>
                <!-- /Slide image -->
                <!-- Texts container -->
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <!-- Text title -->
                        <h4 class="title">TFW no ₩₡.</h4>
                        <!-- Text description -->
                        <p class="description">Y U No buy stuff?</p>
                        <!-- /Text description -->
                    </div>
                </div>
                 <!-- /Texts container -->
            </div>
            <!-- /Duplicate to create more slides -->
            <div class="slide">
                <img src="images/wildcatslow.jpg" alt=""/>
                <div class="slide_content">
                    <div class="slide_content_wrap">

                        <!-- Text title -->
                        <h4 class="title">Purrease!</h4>
                        <!-- /Text title -->
                        <p class="description">I can has ₩₡?</p>
                    </div>
                </div>
            </div>
            <!--/slide -->
        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
    </div>
    <!--/slider -->
<div class="main">
	<div class="wrap">
		<div class="section group">
		  <div class="cont span_2_of_3">
		  	<h2 class="head">Featured Products</h2>
			<div class="top-box">
                            <?php
                            $product = mysqli_query($conn, "SELECT * FROM t_product ORDER BY p_id DESC");
                            $rowCount = mysqli_num_rows($product);
                            $rows = array();

                            while($row = mysqli_fetch_array($product))
                            {
                                $rows[] = $row;
                            }

                            if($rowCount > 0)
                            {
                                for ($i = 0; $i < 10; $i++)
                                {

                                    $rowRand = rand(0, $rowCount - 1);
                                    $row1 = $rows[$rowRand];
                                
                                    if($row1['p_qty'] > 0)
                                    {
                                        echo " <div class='col_1_of_3 span_1_of_3'> "; 
	                                        echo "<a href=\"single.php?product={$row1['p_id']}\"/>";
		                                    echo"<div class='inner_content clearfix'>";
		                                        echo"<div class='product_image'> <img src='../{$row1['p_img']}'  alt='' width='200' height='200'/> </div> ";
                                                    echo"<div class='sale-box'><span class='on_sale title_shop'>New</span></div>";	
                                                        echo"<div class='price'>";
			                                                echo"<div class='cart-left'>";
				                                                echo"<p class='title'>{$row1['p_name']}</p>";
				                                                echo"<div class='price1'>";
				                                                    echo"<span class='actual'>₩₡ {$row1['p_price']}</span>";
			                                                    echo"</div>";
			                                                echo"</div>";
			                                                echo"<div class='cart-right'> </div>";
			                                                echo"<div class='clear'></div>";
			                                            echo"</div>";				
                                                    echo"</div>";
                                            echo"</a>";
                                        echo"</div>";
                                    }
                                }
                            }
                            ?>   
 <!-- ---------------------------------------------------------------------------------------------------- -->                           
                            
			  
				                <div class="clear"></div>
			                </div>	
						</div>

			            <div class="clear"></div>
	            </div>
	        </div>
	    </div>

<?php 
   include 'includes/footer.php';
?>
</body>
</html>
