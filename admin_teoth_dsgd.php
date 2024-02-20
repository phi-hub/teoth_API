<?php
include_once("./database/conection.php");
$result = $dbConn->query("SELECT transactionID, amount, createAt, userID FROM transactions");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title>Bootstrap 5 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="styleadmin.css">
<style>
  
    .btncapnhat  {
       
        border-radius: 4px;
        margin: 20px;
        color: blue;
        text-decoration: none;
        font-weight: bold;
        font-size: 14px ;
        
    }
    .btncapnhat:hover {
        color: orange;
    }
 
</style>
</head>

<body class="text-gray-800 font-inter">
    <!-- start: Sidebar -->
    <div class="fixed left-0 top-0 w-70 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
            <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
                <img src="https://tse1.mm.bing.net/th?id=OIP.JW_kBQ1wercbyLZytjW3SgAAAA&pid=Api&P=0&h=220" alt="" class="w-8 h-8 rounded object-cover">
                <span class="text-lg font-bold text-white ml-3">Admin đẹp trai</span>
        </a>
        <ul class="mt-4">
            <li class="mb-1 group">
                <a href="admin_teoth_dsuser.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                    <i class="ri-home-2-line mr-3 text-lg"></i>
                    <span class="text-sm">Danh sách người dùng</span>
                </a>
            </li>
            <li class="mb-1 group active">
                <a href="admin_teoth_dsgd.php" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                    <i class="ri-instance-line mr-3 text-lg"></i>
                    <span class="text-sm">Danh sách giao dịch</span>
                    <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
                </a>
                
            </li>
        </ul>
    </div>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    <!-- end: Sidebar -->
      <!-- <div class="col-sm-9">
        <div class="container-fluid p-3 bg-primary text-white text-center">
          <h2>Danh sách giao dich</h2>
        </div>
        <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th>Id</th>
                <th>so tien</th>
                <th>thoi gian</th>
                <th>userID</th>
               
              </tr>
            </thead>
            <tbody>
                
            </tbody>
          </table> -->
          <main class="table" id="customers_table">
            <section class="table__header">
                
                <!-- <div class="input-group">
                    <input type="search" placeholder="Search Data...">
                    <img src="images/search.png" alt="">
                </div> -->
              
            </section>
            <section class="table__body">
                <table >
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>so tien</th>
                          <th>thoi gian</th>
                          <th>userID</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $row['transactionID'] . "</td>";
                        echo "<td>" . $row['amount'] . "</td>";
                        echo "<td>" . $row['createAt'] . "</td>";
                        echo "<td>" . $row['userID'] . "</td>";
                        // echo "<td>
                        //                     <a href='updatedanhmuc.php?id=" . $row['id'] . "' class='btn btn-primary'>Sửa</a>
                        //                     <a onclick='confirmdelete(" . $row['id'] . ")' href='#' class='btn btn-danger'>Xóa</a>
                        //             </td>";
                        echo "</tr>";
                        }
                      ?> 
                    </tbody>
                </table>
            </section>
    </main>
      </div>
    </div>
  </div>
   
  </div>
  </div>

  </div>

  <!-- <dialog id="myDialog">
    <input id="tensp" placeholder="Nhap ten san pham" />
    <input id="giasp" placeholder="Nhap gia san pham"/>
    <button id="btnok" onclick="Update()">Ok</button>
  </dialog> -->
  <!-- <script>
    function myFunction(r) {
      var i = r.parentNode.parentNode.rowIndex;
      document.getElementById("myTable").deleteRow(i);

      rowSelection='single';
    }

    function upDateDialog(){
      const element = document.getElementById("myDialog");
      element.open = true;
    }

    function Update(){
      
      const ten = document.getElementById("tensp").value;
      const gia = document.getElementById("giasp").value;

      document.getElementById("name").innerHTML = ten;
      document.getElementById("price").innerHTML = gia;

      const element = document.getElementById("myDialog");
      element.open = false;

    }
  </script> -->
  
  <!-- <script>
    var data = []
  
    function add(){
      var item_Id = document.getElementById("id").value
      var item_name = document.getElementById("name").value
      var item_mh = document.getElementById("mahang").value
     
      
      var item = {
            Id : item_Id,
            Name : item_name,
            Mahang : item_mh
      }
  
      let index = data.findIndex((c)=> c.Id==item_Id)
      if(index>=0){
        data.splice(index,1,item)
      }else{
        data.push(item)
      }
  
      render()
      clear()
      
    }
  
    function render(){
      table = `<tr>
                  <th>ID</th>
                  <th>Firstname</th>
                  <th>Lastname</th>
                  <th>Actions</th>
                </tr>`
                for(let i=0 ; i<data.length;i++){
                  table += `<tr>
                  <th>${data[i].Id}</th>
                  <th>${data[i].Name}</th>
                  <th>${data[i].Mahang}</th>
                  <th> 
                    <button onclick="deleteItem(${data[i].Id})">Delete</button>
                    <button onclick="updateItem(${data[i].Id})">Update</button> 
                    </th>
                </tr>`
                }
                document.getElementById("render").innerHTML = table
    }
  
    function clear(){
      document.getElementById("id").value=""
      document.getElementById("name").value=""
      document.getElementById("mahang").value=""
    }
  
    function deleteItem(id){
        for(let i=0;i<data.length;i++){
          if(data[i].Id==id){
            data.splice(i,1)
            render()
          }
        }
    }
  
    function updateItem(id){
      for(let i=0;i<data.length;i++){
          if(data[i].Id==id){
              document.getElementById("id").value = data[i].Id;
              document.getElementById("name").value = data[i].Name;
              document.getElementById("mahang").value = data[i].Mahang;
          }
        }
    }
  
  </script> -->

</body>

</html>
<script>
  document.querySelector("#btnxoa").addEventListener('click',()=>{


  });

</script>
