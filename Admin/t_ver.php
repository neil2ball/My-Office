<?php 
$title ="Teacher Verify";
include 'teach_header.php';
?>
<html>
    <body>
        <?php
            if (isset($_POST['action']))
            {
                $verify = $conn->prepare("UPDATE t_order_user_det SET b_ver= 1, s_ver= 1 WHERE o_id= ?");
                $verify->bind_param('i', $_POST['o_id']);
                $verify->execute();
            }

            echo("<script type=\"text/javascript\">
                window.location.href='data.php?order';
            </script>");

        ?>

    </body>

</html>