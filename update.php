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
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $categoryId = $_POST['categoryId'];
    $description = $_POST['description'];   

    if(!$fileName){
        $sql = "UPDATE products SET name = '$name',
            price = '$price', quantity = '$quantity',
            categoryId = '$categoryId',
            description = '$description' where id = $id";
    }
    else{
        $image="http://127.0.0.1:1234/uploads/" . $fileName;
        $sql = "UPDATE products set name = '$name',
                price = '$price', quantity = '$quantity',
                image = '$image',categoryId = '$categoryId',
                description = '$description' where id = $id";
    }
    // thực thi câu lệnh sql
    $result = $dbConn->exec($sql);
    // chuyển hướng trang web về index.php
    header("Location: index.php");
  }
  else{
    $categories = $dbConn->query("SELECT id, name FROM categorie");
    $id = $_GET['id'];
  
    if(!$id || !is_numeric($id)){
      echo "ID khong hop le";
      exit();
    }
  
    $sql = "SELECT id, name, price, quantity, description,
              image, categoryId from products WHERE id = $id";
  
    $result = $dbConn->query($sql);
    $product = $result->fetch(PDO::FETCH_ASSOC);
  }

  $id = $product['id'];
  $name = $product['name'];
  $price = $product['price'];
  $quantity = $product['quantity'];
  $image = $product['image'];
  $categoryId = $product['categoryId'];
  $description = $product['description'];
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
        <form action="/update.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name">Tên sản phẩm:</label>
                <input type="hidden" value="<?php echo $id ?>" name="id">
                <input value="<?php echo $name ?>" type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
            <div class="mb-3">
                <label for="price">Giá sản phẩm:</label>
                <input  value="<?php echo $price ?>" type="number" class="form-control" id="price" placeholder="Enter price" name="price">
            </div>
            <div class="mb-3">
                <label for="quantity">Số lượng sản phẩm:</label>
                <input value="<?php echo $quantity ?>" type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="image">Ảnh sản phẩm:</label>
                <input type="file" class="form-control" id="image" placeholder="Enter image" name="image">
                <img  src="<?php echo $image; ?>"  id="image-display" width="100px">
            
            </div>
            <div class="mb-3">
                <label for="description">Mô tả sản phẩm:</label>
                <textarea class="form-control" rows="5" id="description" name="description"><?php echo $description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="supplier">Nhà cung cấp sản phẩm:</label>
                <select class="form-control" id="categoryId" name="categoryId">
                    <?php 
                        while ($row = $categories->fetch(PDO::FETCH_ASSOC)) {
                            if($row['id'] == $categoryId){
                                echo "<option selected value='".$row['id']."'>".$row['name']."</option>";
                            } 
                            else{
                                echo "<option value='".$row['id']."'>".$row['name']."</option>";
                            }   
                            
                        }                    
                        ?>
                </select>
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