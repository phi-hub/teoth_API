<?php
  include_once("./database/conection.php");
  $result = $dbConn->query("SELECT userID, username, email, available, balance FROM users");

  $row = $result->fetch(PDO::FETCH_ASSOC);
  $oldbalance = $row['balance'];
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

  <style>
    .item{border: 2px solid; width: 200px; margin: 50px 40px; padding-left: 20px;}
    .item_box{display: flex; flex-direction: row; justify-content: center;}
    a{text-decoration: none; color: #000;}
    .giatien{margin-left: 10px;}
  </style>
  
</head>
<body>

  <div class="container mt-3 ">
  <h2>Xin chao user..</h2>
  </div>

  <div class="item_box">

    <div class="item">
      <form action="checkout.php" method="post"> 
          <img src="https://tse3.explicit.bing.net/th?id=OIP.WCMzO3Ws08Jr-f2amChgigAAAA&pid=Api&P=0&h=220" />
          <input type="text" name="ten" value="20 kim cuong">
          <input type="text" name="gia" value="20000">
          <input type="submit" name="submit" value="Mua">
      </form>
    </div>

    <div class="item">
    <a href="payment.php"> 
          <img src="https://tse3.explicit.bing.net/th?id=OIP.WCMzO3Ws08Jr-f2amChgigAAAA&pid=Api&P=0&h=220" />
          <p><?php echo $oldbalance ?></p>
          <p>20.000 vnd</p>
      </a>
    </div>

    <div class="item">
    <a href="payment.php"> 
          <img src="https://tse3.explicit.bing.net/th?id=OIP.WCMzO3Ws08Jr-f2amChgigAAAA&pid=Api&P=0&h=220" />
          <p>200 diamonds</p>
          <p>20.000 vnd</p>
      </a>
    </div>

    <div class="item">
    <a href="payment.php"> 
          <img src="https://tse3.explicit.bing.net/th?id=OIP.WCMzO3Ws08Jr-f2amChgigAAAA&pid=Api&P=0&h=220" />
          <p>200 diamonds</p>
          <p>20.000 vnd</p>
      </a>
    </div>

    <div class="item">
        <img src="https://tse3.explicit.bing.net/th?id=OIP.WCMzO3Ws08Jr-f2amChgigAAAA&pid=Api&P=0&h=220" />
        <p>200 diamonds</p>
        <p>20.000 vnd</p>
    </div>
  </div>

  

  
    
    <div class=" card containe mt-5 " style="width:30%; margin: 0px 300px; padding: 20px">
      <div class="">Chi tiết giao dịch</div>
      <hr/>
      <div class="">
     
          <dl class="d-flex flex-row" style="justify-content: space-between;">
            <div class="">Sản phẩm được chọn</div>
            <div class="">
              <div class="">
                <div>
                  <span class="">10 000 VND</span>
                </div>
              </div>
            </div>
          </dl>
          <hr/>
       
          <dl class="d-flex flex-row" style="justify-content: space-between;">
            <div class="">Giá</div>
            <div class="">
              <div class="">
                <span class=""><?php
                  
                  ?>
                </span>
              </div>
            </div>
          </dl>
          <hr/>
   
          <dl class="d-flex flex-row" style="justify-content: space-between;">
            <div class="">Phương thức thanh toán</div>
            <div class="">
              <div class="">stripe</div>
            </div>
          </dl>
          <hr/>
      
          <dl class="d-flex flex-row" style="justify-content: space-between;">
            <div class="">Tên tài khoản trong game</div>
            <div class="">
              <div class="">user name</div>
            </div>
          </dl>
          <hr/>
      </div>
      <div class="">
        <div class="">
          <div class="">
            <input class="" type="submit" value="Xử lý thanh toán"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  


</body>

</html>

<script>
        // const confirmdelete = (id) => swal({
        //     title: "Are you sure?",
        //     text: "Once deleted, you will not be able to recover this imaginary file!",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //     if (willDelete) {

        //       window.location.href = `delete.php?id=${id}`;
        //         swal("Poof! Your imaginary file has been deleted!", {
        //         icon: "success",
        //         });
        //     } else {
        //         swal("Your imaginary file is safe!");
        //     }
        //     });
    </script>