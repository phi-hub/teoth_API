<?php
include_once("./database/conection.php");
$result = $dbConn->query("SELECT id, name, price, quantity, image FROM products");
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>danh sach san pham</h2>
  <a href="./insert.php" class="btn btn-primary">Them moi</a>
  <a href="./dsdanhmuc.php" class="btn btn-primary">danh muc</a>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ten san pham</th>
        <th>gia san pham</th>
        <th>so luong</th>
        <th>hinh anh</th>
        <th>thao tac</th>
      </tr>
    </thead>
    <tbody>
        <?php
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td> <img src='" . $row['image'] . "' width='100'/></td>";
            echo "<td>
                                <a href='update.php?id=" . $row['id'] . "' class='btn btn-primary'>Sửa</a>
                                <a onclick='confirmdelete(" . $row['id'] . ")' href='#' class='btn btn-danger'>Xóa</a>
                        </td>";
            echo "</tr>";
            }
            ?>
    </tbody>
  </table>
</div>

</body>

</html>

<script>
        const confirmdelete = (id) => swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {

              window.location.href = `delete.php?id=${id}`;
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    </script>