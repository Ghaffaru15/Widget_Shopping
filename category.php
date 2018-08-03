<?php
    require_once('./Includes/config.inc.php');
    //Checking for the category id
    $category = FALSE;
    if (isset($_GET['cid'])){
        $cid = (int)$_GET['cid']; //forcing to be an int

        if ($cid > 0){
            $q = "SELECT category,description FROM categories WHERE category_id=$cid";
            $r = mysqli_query($db,$q);

            if (mysqli_num_rows($r) == 1){
                $row = mysqli_fetch_assoc($r);
                $category = $row['category'];
                $description = $row['description'];
            }
        }
    }

    if ($category){
        $page_title = $category;
    }

    include_once('Includes/header.html');

    if ($category){
        echo "<h1>$category</h1><br />";

        if (!empty($description)){
            echo "<p>$description</p>";
        }

        //Get the widgets in this category
        $q = "SELECT gw_id,name,default_price,description FROM general_widgets WHERE category_id=$cid";

        $r = mysqli_query($db,$q);

        if (mysqli_num_rows($r) > 1 ){
            while(list($gw_id,$wname,$wprice,$wdescription) = mysqli_fetch_array($r)){
                echo "<h2><a href=\"product.php?gw_id=$gw_id\">$wname</a></h2><p>$wdescription<br />$$wprice</p><br />";
            }
        }
        else{
            echo "<p class=\"error\">There are no widgets in this category</p>";
        }
    }
    else{
        echo '<p class="error">This page has been accessed in error!</p>';
    }

    include_once('Includes/footer.php');
?>