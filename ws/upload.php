<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
//echo"datos :";  
echo "<br> <pre>"; print_r( $_FILES ); echo "</pre>";
if (is_array($_FILES) && count($_FILES) > 0) {
    for( $i = 0; $i < count($_FILES); $i++  ){
        if (($_FILES["file$i"]["type"] == "image/pjpeg") || ($_FILES["file$i"]["type"] == "image/jpeg") || ($_FILES["file$i"]["type"] == "image/png") || ($_FILES["file$i"]["type"] == "image/gif")) {
            //echo $_FILES['file']['size'];
            if (move_uploaded_file($_FILES["file$i"]["tmp_name"], "../images/productos/".$_FILES['file'.$i.'']['name'])) {
            //echo "images/".$_FILES['file']['name'];
            echo "images/productos/".$_FILES['file'.$i.'']['name'];
            }
            
        } 
    }
}
?>