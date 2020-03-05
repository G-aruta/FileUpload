<?php
    include("includes/header.php");
    include("includes/content.php");
    
?>
<?php
    include("utilities/functions.php");
    // echo '<pre>', print_r($_FILES), '</pre>'; exit;
    if(!empty($_FILES['files']['name'][0])){
        $files = $_FILES['files'];

        $uploaded = array();
        $failed = array();

        $allowed = array('png', 'jpg');

        foreach($files['name'] as $position => $file_name) {
            // echo '<pre>', print_r($file_name), '</pre>'; exit;
            $file_tmp = $files['tmp_name'][$position];
            // echo '<pre>', print_r($file_tmp), '</pre>'; exit;
            $file_size = $files['size'][$position];
            $file_error = $files['error'][$position];

            $file_ext = explode('.',$file_name);
            $file_ext = strtolower(end($file_ext));

            if(insideArray($file_ext, $allowed)) {

                    if(limit($file_size)) {

                        $file_destination = 'uploads/' . $file_name;
                        if(!noDuplicate($file_destination)){
                        
                            // echo "<pre>", print_r($file_destination), "</pre>";exit;
                            if(acceptUpload($file_tmp, $file_destination)) {
                                $uploaded[$position] = $file_destination;
                            } else {
                                $failed[$position] = "[$file_name] failed to upload. <br><br>";
                            }

                        }else {
                            $failed[$position] = "[$file_name] existing file. <br><br>";
                        }

                    } else {
                        $failed[$position] = "[$file_name] is too large. <br><br>";
                    }

            } else {
                $failed[$position] = "[{$file_name}] file extention '{$file_ext}' is not allowed. <br><br>";
            }
        }
        if(!empty($uploaded)) {
            foreach($uploaded as $images){
                echo "<img src=\"$images\" /> <br><br>";
            }
        }
        if(!empty($failed)) {
            echo implode(" ", $failed);
        }
    }

?>
<?php
    include("includes/footer.php");
?>