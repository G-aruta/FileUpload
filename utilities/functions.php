<?php
    function noDuplicate($file_destination){
        return(file_exists($file_destination)) ? true : false;
    }

    function insideArray($file_ext, $allowed){
        return(in_array($file_ext, $allowed)) ? true : false;
    }

    function limit($file_size){
        return($file_size <= 10000000) ? true : false;
    }
    function acceptUpload($file_tmp, $file_destination){
        return(move_uploaded_file($file_tmp, $file_destination)) ? true : false;
    }
?>