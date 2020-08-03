<?php 
$title ="Buyer Verify";
include 'seller_header.php';
?>
<html>
    <body>
        <?php
            if (isset($_POST['delete']))
            {
                $verify = $conn->prepare("DELETE FROM t_product WHERE p_id= ?");
                $verify->bind_param('i', $_POST['p_id']);
                $verify->execute();
            }

            echo("<script type=\"text/javascript\">
                window.location.href='data.php?product';
            </script>");

        ?>

    </body>

</html>