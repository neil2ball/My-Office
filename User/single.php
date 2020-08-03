<?php 
$title="Single";
include'header.php';
?>

<?php 

if(isset($_POST['buy']))
{

    $nos  = clean($_POST['qty']);
    $p_id = clean($_POST['pid']);
    
	$query = $conn->prepare("SELECT s_id, p_name, p_price, p_qty FROM t_product WHERE p_id = ?");
	$query->bind_param('s', $p_id);
	$query->execute();
	$queryResult = $query->get_result();

	while ($row = mysqli_fetch_array($queryResult))
	{
      $s_id    =  clean($row['s_id']);
      $p_name  =  clean($row['p_name']);
      $p_price =  clean($row['p_price']);
      $p_qty   =  clean($row['p_qty']);
        
        if($p_qty >= $nos)
        {        
			$avl = $p_qty-$nos;
        	// echo"$nos product has been orderd, Now $avl available products";
            
            $cart_data = $conn->prepare("INSERT INTO t_cart (u_id, s_id, p_id, c_p_qty, p_name, p_price)"
										. "VALUES (?, ?, ?, ?, ?, ?)");
			$cart_data->bind_param('ssssss', $id, $s_id, $p_id, $nos, $p_name, $p_price);
			$cart_data->execute();


			$product_update = $conn->prepare("UPDATE t_product SET p_qty = ? WHERE p_id = ?");
			$product_update->bind_param('ss', $avl, $p_id);
			$product_update->execute();

        } else {
            echo"You required $nos product and $p_qty product are available";
        }
    }
        echo("<script type=\"text/javascript\">
                window.location.href='single.php?product=$p_id';
            </script>");
}

?>

<div class='mens'>
    <div class='main'>
        <?php 
		
		function clean($str) {
			$str = @trim($str);
			$str = stripslashes($str);
			include ('../includes/connection.php');
			return mysqli_real_escape_string($conn, $str);
		}

		$get_string = $_SERVER['QUERY_STRING'];
		parse_str($get_string, $get_array);
		if(array_key_exists('product',$get_array))
		{
			$prd_id = clean($get_array['product']);
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
								
										echo"<img class='etalage_thumb_image' src=\"../{$row['p_img']}\" class='img-responsive' />";
										echo"<img class='etalage_source_image' src=\"../{$row['p_img']}\" class='img-responsive' title='' />";

			    					echo"</a>";
								echo"</li>";
		    				echo"</ul>";
		    				echo"<div class='clearfix'></div>";
						echo"</div>";
	
						echo"<div class='desc1 span_3_of_2'>";
			
		    				echo"<h3 class='m_3'>{$row['p_name']}</h3>";
                            echo"<p class='m_5'>₩₡ {$row['p_price']} </p>";
                            echo"<p>Quantity: {$row['p_qty']}</p>";
		         	 
            				echo"<div class='btn_form'>";
								echo"<form action ='single.php' method ='post'>";

                    				echo"<input type='submit' value='buy' name='buy'>";
                    				echo"<input type='number' class='textbox' name ='qty' placeholder='enter quantity' required=''>";
									echo"<input type='text' class='textbox' name ='pid' value = '{$row['p_id']}' hidden=''>";
								
								echo"</form>";
            				echo"</div>";
                		echo"</div>";    
					echo"</div>";
				
					echo"<p class='m_text2'>{$row['p_desc']} </p>";
				
        		echo"</div>";
			}
        }
        

		?>


        <div class="clear"></div>

    </div>

    <div class="clear"></div>

</div>


<?php 
			   include 'footer.php';
			?>
</body>

</html>