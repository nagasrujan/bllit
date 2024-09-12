<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "my_website";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $_POST['title'];
$content = $_POST['content'];
$image = $_FILES['image'];


$target_dir = "uploads/";
$target_file = $target_dir . basename($image["name"]);

if (move_uploaded_file($image["tmp_name"], $target_file)) {
    $image_url = $target_file;
} else {
    die("Sorry, there was an error uploading your file.");
}


$sql = "INSERT INTO about_us (title, content, image_url) VALUES ('$title', '$content', '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "New content added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
