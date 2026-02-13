<?php 
session_start();

function image_validation($image, $errors) {
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        //Get info of image
        $image_name = $image['name']; 
        $image_type = $image['type']; 
        $image_temp = $image['tmp_name']; 
        $image_size = $image['size']; 
        $image_error = $image['error']; 

        //Get image type
        $parts = explode('.', $image_name);
        $image_extension = strtolower(end($parts));

        //Check if image Uploaded
        if($image_error == 4) {
            $_SESSION['alert'] = "No File Uploaded";
            $errors[] = "No Image Uploaded";
        } else {
            //Check size of image
            if($image_size > 5000000){
                $errors[] = "<div>Image size is large than 100Kb</div>";
                $_SESSION['alert'] = "Image size is large (Max 5Miga)";
            }

            //Allowed types
            $allowed_types = ['jpg','png','jpeg','gif'];

            //Check if is not image
            if(!in_array($image_extension, $allowed_types)) {
                $errors[] = "File is not image";
                $_SESSION['alert'] = "File not image";
            } 
        }

        //Errors
        if(empty($errors)) {
            //Create random name
            $image_random_name = uniqid().'.'.$image_extension;
            
            //Move image to up
            if(!move_uploaded_file($image_temp, getcwd().'/images//'.$image_random_name)){
                echo "Upload Error";
            };

            return $image_random_name;
        } else {
            return false;
        }
        //Redirection
        // header("location: index.php");

        foreach($errors as $error) {
            echo $error;
        }
    }
}
?>