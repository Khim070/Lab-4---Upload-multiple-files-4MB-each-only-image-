<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload multiple files</title>
</head>
<body>
    <?php
        if(isset($_FILES['myfile']))
        {
            $fileCount = count($_FILES['myfile']['tmp_name']);
            if( $fileCount > 5){
                echo "<p style='color:red;'>You can't upload more than 5 files</p>";
            }else{
                foreach($_FILES['myfile']['tmp_name'] as $i => $tmp_name){
                    $tmp_name = $_FILES['myfile']['tmp_name'][$i];
                    $name = $_FILES['myfile']['name'][$i];
                    $size = $_FILES['myfile']['size'][$i];
                    $maxSize = 4*1024*1024;
                    if($size > $maxSize){
                        echo "<p style='color:red;'>$name is too large. Maximum size is 4MB.</p>";
                        continue;
                    }else{
                        if (move_uploaded_file($tmp_name, "images/" . $name)) {
                            echo "<p style='color:green;'>$name uploaded successfully.</p>";
                        } else {
                            echo "<p style='color:red;'>Failed to upload $name.</p>";
                        }
                    }
                }
            }
        }
        else
        {
    ?>
        <form method="post" enctype="multipart/form-data">
            <label>Input your files</label>
            <input type="file" name="myfile[]" multiple>
            <input type="submit" value="Upload">
        </form>
    <?php
        }
    ?>
</body>
</html>