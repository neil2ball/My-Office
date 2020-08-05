<?php 
$title ="Buyer Verify";
include 'teach_header.php';
?>
<html>
    <body>
        <?php
            if (isset($_POST['commit']))
            {
                $verify = $conn->prepare("UPDATE t_product SET p_name= ?, p_qty= ?, p_wt= ?, p_price= ? WHERE p_id= ?");
                $verify->bind_param('siiii', $_POST['p_name'], $_POST['p_qty'], $_POST['p_wt'], $_POST['p_price'], $_POST['p_id']);
                $verify->execute();
            }

            echo("<script type=\"text/javascript\">
                window.location.href='data.php?product';
            </script>");

        ?>

    </body>

</html>