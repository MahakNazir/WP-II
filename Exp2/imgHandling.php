<!DOCTYPE html>
<html>
<head>
    <title>Image and File Handling</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f0e6f2; /* Pastel color code */
        }

        .content {
            text-align: center;
            padding: 20px;
        }

        .flex-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }

        img {
            margin: 10px;
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <div class="content">
        <?php
        $uploadDir = 'uploads/';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $uploadFile = $uploadDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $allowedTypes = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadFile)) {
                    echo "Image uploaded successfully.<br>";
                } else {
                    echo "Error uploading image.<br>";
                }
            } else {
                echo "Only JPG, JPEG, PNG, and GIF files are allowed.<br>";
            }
        }
        $uploadedImages = scandir($uploadDir);
        echo '<div class="flex-container">';
        foreach ($uploadedImages as $image) {
            if ($image != "." && $image != "..") {
                echo '<img src="' . $uploadDir . $image . '" alt="Uploaded Image"><br>';
            }
        }
        echo '</div>';
        ?>
        <form method="POST" enctype="multipart/form-data">
            <input type="file" name="image" accept="image/*">
            <input type="submit" value="Upload Image">
        </form>
    </div>
</body>
</html>
