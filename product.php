<?php
    require_once('Includes/config.inc.php');

    $name = NULL;

    if (isset($_GET['gw_id'])){
        $gw_id = (int)$_GET['gw_id'];

        if ($gw_id > 0){
            $q = "SELECT name,default_price,description FROM general_widgets WHERE gw_id=$gw_id";

            $r = mysqli_query($db,$q);

            if (mysqli_num_rows($r) == 1){
                list($name,$price,$description) = mysqli_fetch_array($r);
            }
        }
    }

    if ($name){
        $page_title = $name;
    }
    include_once('./Includes/header.html');
    
    if ($name){
        echo "<h1>$name</h1>";

        if (!empty($description)){
            echo "<p>$description</p>";
        }

        //Get specific widgets for this product
        $q = "SELECT sw_id,color,size,price,in_stock FROM specific_widgets LEFT JOIN colors
        USING (color_id) LEFT JOIN sizes USING (size_id) WHERE gw_id=$gw_id ORDER BY size,color";

        $r = mysqli_query($db,$q);

        if (mysqli_num_rows($r) > 0){
            echo "<h3>Available sizes and colors</h3>";

            while ($row = mysqli_fetch_assoc($r)){
                $price = (empty($row['price'])) ? $price : $row['price'];

                //Print most of the info
                echo "<p>Size: {$row['size']}<br />Color: {$row['color']}<br />Price: $$price<br />In Stock?: {$row['in_stock']}";

                //Print cart link
                if ($row['in_stock'] == 'Y'){
                    echo "<br /><a href=\"cart.php?sw_id={$row['sw_id']}&do=add\">Add to Cart</a>";
                }
                echo '</p>';
            }
        }
        else{ //No specific widgets here!
            echo '<p class="error">There are none of these widgets available for purchase at this time.</p>';
        }
    }
    else{
        echo '<p class="error">This page has been accessed in error </p>';
    }

    include_once('./Includes/footer.php');
?>  