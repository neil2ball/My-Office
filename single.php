<?php 
$title="Single";
include'header.php';
?>
  
<div class='mens'>   
	<div class='main'>
    <?php 
	if(isset($_GET['product']))
	{

		function clean($str) {
			$str = @trim($str);
			$str = stripslashes($str);
			include ('includes/connection.php');
			return mysqli_real_escape_string($conn, $str);
		}

		$prd_id = clean($_GET['product']);
		
		$prd_view = $conn->prepare("SELECT * FROM t_product WHERE p_id = ?");
		$prd_view->bind_param('s', $prd_id);
		$prd_view->execute();
		$prd_viewResult = $prd_view->get_result();

		while ($row = mysqli_fetch_array($prd_viewResult)) 
		{
        	echo"<div class='wrap'>";
     	    	echo"<div class='cont span_2_of_3'>";
					echo"<div class='grid images_3_of_2'>";
		    			echo"<ul id='etalage'>";
							echo"<li>";
			    				echo"<a href='optionallink.php'>";
									echo"<img class='etalage_thumb_image' src=\"{$row['p_img']}\" class='img-responsive' />";
									echo"<img class='etalage_source_image' src=\"{$row['p_img']}\" class='img-responsive' title='' />";
			    				echo"</a>";
							echo"</li>";
		    			echo"</ul>";
		    			echo"<div class='clearfix'></div>";
	        		echo"</div>";
            		echo"<div class='desc1 span_3_of_2'>";
		    			echo"<h3 class='m_3'>{$row['p_name']}</h3>";
						echo"<p class='m_5'>₩₡ {$row['p_price']} </p>";
						echo"<p>Quantity: {$row['p_qty']}</p>";
		         	 
                    		echo"<div class='btn_form' action ='cart.php' method ='post'>";
			
	    					echo"</div>";
            
	        				echo"<span class='m_link'><a href=\"login.php\">login to save in wishlist</a> </span>";
            
	    					echo"<p class='m_text2'>{$row['p_desc']} </p>";
        			echo"</div>";
		}
	}
	?>          
			   		<div class="clear"></div>
     				</div>
			
     			</div>
			</div>
			<div class="clear"></div>
		</div>
		

	<?php 
   include 'includes/footer.php';
   ?>
</body>
</html>
