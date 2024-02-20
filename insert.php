<?php
  include_once("./database/conection.php");
  $categories = $dbConn->query("SELECT id, name FROM categorie");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thêm mới sản phẩm</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.4.0/firebase.js"></script>

</head>

<?php
if(isset($_POST['submit'])){
    // $currentDirectory = getcwd();
    // $uploadDirectory = "/uploads/";
    // $fileName = $_FILES['image']['name'];
    // $fileTmpName  = $_FILES['image']['tmp_name'];
    // $uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);
    // // upload file
    // move_uploaded_file($fileTmpName, $uploadPath);
    
    $name = $_POST['name']; // đọc theo name của input
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image = $_POST['imageUrl'];
    $categoryId = $_POST['categoryId'];
    $description = $_POST['description'];

    // $image="http://127.0.0.1:1234/uploads/" .$fileName;
    // thực hiện câu lệnh sql
    $sql = "INSERT INTO products 
            (name, price, quantity, image, categoryId, description)
            VALUES 
            ('$name', '$price', '$quantity', '$image', '$categoryId', '$description')";
    // thực thi câu lệnh sql
    $result = $dbConn->exec($sql);
    // chuyển hướng trang web về index.php
    header("Location: index.php");
}
?>

<body>

    <div class="container mt-3">
        <h2>Thông tin sản phẩm</h2>
        <form action="/insert.php" method="post">
            <div class="mb-3 mt-3">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
            </div>
            <div class="mb-3">
                <label for="price">Giá sản phẩm:</label>
                <input type="number" class="form-control" id="price" placeholder="Enter price" name="price">
            </div>
            <div class="mb-3">
                <label for="quantity">Số lượng sản phẩm:</label>
                <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="image">Ảnh sản phẩm:</label>
                <input onchange="onChangeFile()" type="file" class="form-control" id="img-file" placeholder="Enter image" name="image">
                <input type="hidden" id="imageUrl" name="imageUrl">
                <img id="img-view" width="100px">
            
            </div>
            <div class="mb-3">
                <label for="description">Mô tả sản phẩm:</label>
                <textarea class="form-control" rows="5" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="supplier">Nhà cung cấp sản phẩm:</label>
                <select class="form-control" id="categoryId" name="categoryId">
                    <?php 
                        while ($row = $categories->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row['id']."'>".$row['name']."</option>";
                        }               
                        ?>
                </select>
            </div>
            <button name="submit" type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div>

</body>

</html>

<script>
    // const image = document.getElementById('image');
    //     const imageDisplay = document.getElementById('image-display');
    //     image.addEventListener('change', (e) => {
    //         const file = e.target.files[0];
    //         const fileReader = new FileReader();
    //         fileReader.onload = () => {
    //             imageDisplay.src = fileReader.result;
    //         }
    //         fileReader.readAsDataURL(file);
    //     });

    const firebaseConfig = {
    apiKey: "AIzaSyCdjFJbU0VFAIFqgsuBPf8lJ50LilT76_c",
    authDomain: "webphp-8c46e.firebaseapp.com",
    projectId: "webphp-8c46e",
    storageBucket: "webphp-8c46e.appspot.com",
    messagingSenderId: "787069329600",
    appId: "1:787069329600:web:4c581473632705d26c4d25",
    measurementId: "G-8Q7HLFDGL1"
    };
    firebase.initializeApp(firebaseConfig);
    
    const onChangeFile = () => {
            const file = document.getElementById('img-file').files[0];
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('img-view').src = e.target.result;
            }
            reader.readAsDataURL(file);

            // upload
            const ref = firebase.storage().ref(new Date().getTime() + '-' + file.name);
            const uploadTask = ref.put(file);
            uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED,
                (snapshot) => {},
                (error) => {console.log('firebase error: ',error)},
                () => {
                    uploadTask.snapshot.ref.getDownloadURL().then(url => {
                        console.log('>>>>> File available at:', url);
                        document.getElementById('imageUrl').value = url;
                    })
                }
            );
        }
</script>