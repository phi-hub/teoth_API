<?php
  include_once("./database/conection.php");
  
  if(isset($_POST['submit'])){
    $currentDirectory = getcwd();
    $uploadDirectory = "/uploads/";
    $fileName = $_FILES['image']['name'];
    $fileTmpName  = $_FILES['image']['tmp_name'];
    $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
    // upload file
    move_uploaded_file($fileTmpName, $uploadPath);
    
    $id = $_POST['id'];
    $name = $_POST['name']; // đọc theo name của input

    if(!$fileName){
      
        $sql = "UPDATE categorie set name = '$name' where id = $id";
    }
    else{
        $image="http://127.0.0.1:1234/uploads/" .$fileName;
        $sql = "UPDATE categorie set name = '$name', image = '$image' where id = $id";
    }
    // thực thi câu lệnh sql
    $result = $dbConn->exec($sql);
    // chuyển hướng trang web về index.php
    header("Location: dsdanhmuc.php");
  }
  else{
    $id = $_GET['id'];
    if(!$id || !is_numeric($id)){
        echo "ID khong hop le";
        exit();
      }
    
    $sql = "SELECT id, name, image FROM categorie WHERE id = $id";
  
    $result = $dbConn->query($sql);
    $product = $result->fetch(PDO::FETCH_ASSOC);
  }

  $id = $product['id'];
  $name = $product['name'];
  $image = $product['image'];
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm mới sản phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container mt-3">
        <h2>Thông tin sản phẩm</h2>
        <form action="/updatedanhmuc.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name">Tên danh muc:</label>
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input value="<?php echo $name ?>" type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>

            <div class="mb-3">
                <label for="image">Ảnh danh muc:</label>
                <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
                <img  src="<?php echo $image; ?>"  id="image-display" width="100px">
            
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</body>

</html>

<script>
    const image = document.getElementById('image');
        const imageDisplay = document.getElementById('image-display');
        image.addEventListener('change', (e) => {
            const file = e.target.files[0];
            const fileReader = new FileReader();
            fileReader.onload = () => {
                imageDisplay.src = fileReader.result;
            }
            fileReader.readAsDataURL(file);
        });
</script>