

  <!-- Header-->
  <?php

include ('/xampp/htdocs/BMS_3.0/includes/header.php');
include('/xampp/htdocs/BMS_3.0/assets/php/connect.php');
?>

  <!-- Content of the page-->
<div class="container-fluid px-4">
    <p class="mt-4"> Home/ <span class="small stretched-link">Orders</span></p>
    <h1 >Manage Orders </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">This is a summary of the orders that are in the system.</li>
    </ol>
<div class="card mb-4" style="z-index:90;">
  <div class="card-header">
      <i class="fas fa-table me-1"></i>
      Products
  </div>
  <div class="card-body" style="height:70vh">
      <table id="datatablesSimple" >
          <thead> 
              <tr>
                  <th>Retailer</th>
                  <th>Product ordered</th>
                  <th>Added by</th>
                  <th>Quantity Purchased</th>
                  <th>Total Value(KES)</th>
                  <th>Date created</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th>Retailer</th>
                  <th>Product ordered</th>
                  <th>Added by</th>
                  <th>Quantity Purchased</th>
                  <th>Total Value(KES)</th>
                  <th>Date created</th>
                  <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php
               $sql = "SELECT * FROM `orders` ";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td>
                  <?php 
                    $retailerId= $row["retailerId"];
                    $productSql="SELECT * FROM `retailers` WHERE retailerId='$retailerId'";
                    $productResult= $conn->query($productSql);
                    if ($productResult->num_rows > 0) {
                      // output data of each row
                      while($productRow = $productResult->fetch_assoc()) {
                        $productName=$productRow["retailerName"];
                        echo $productName;
                      }
                    }
                  ?>
                  </td>
                <td>
                  <?php
                    $productId= $row["productId"];
          
                    $productSql="SELECT * FROM `products` WHERE productId='$productId'";
                    $productResult= $conn->query($productSql);
                    if ($productResult->num_rows > 0) {
                      // output data of each row
                      while($productRow = $productResult->fetch_assoc()) {
                        $productName=$productRow["productName"];
                        echo $productName;
                        $productTotalPrice=$productRow["price"]*$row["quantityOrdered"];
                      }
                    }
                  ?>
                </td>
                <td>
                  <?php
                    $userId= $row["userId"];
          
                    $productSql="SELECT * FROM `users` WHERE userId='$userId'";
                    $productResult= $conn->query($productSql);
                    if ($productResult->num_rows > 0) {
                      // output data of each row
                      while($productRow = $productResult->fetch_assoc()) {
                        $productName=$productRow['firstName']." ".$productRow['lastName'];
                        echo $productName;
                      }
                    }
                  ?>
                </td>
                <td><?php echo $row["quantityOrdered"];?></td>
                <td><?php echo $productTotalPrice;?></td>
                <td><?php echo $row["orderDate"];?></td>
                <td></td>
                <?php
                 echo "<script>
                 $(document).ready(function () {
                  var table = $('#datatablesSimple').DataTable({
                     
                      columnDefs: [
                          {
                              targets: -1,
                              data: null,
                              defaultContent: '<button>Click!</button>',
                          },
                      ],
                  });
                 </script>"
                ?>

              </tr>
            <?php
                }
              }else {
                //echo "No orders  in the database";
              }
            ?>
          </tbody>
      </table>
  </div>
  <div class="card-body" style="height:100vh;">
  
  <div class="container" id="addProduct">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Orders Form</h3></div>
                <div class="card-body">

                    <!--connect to the database-->
                    <!-- <form action="/Applications/MAMP/htdocs/BMS_3.0/assets/php/connect.php" method="POST"> -->
                    <form method="POST">
                    <div class=" mb-3 ">
                          <label for="retailer">Retailer(Customer)</label>
                          <select name="retailer" id="retailer" class="form-control">
                            <?php 
                              $productSql="SELECT * FROM `retailers`  ";
                              $productResult= $conn->query($productSql);
                              if ($productResult->num_rows > 0) {
                                // output data of each row
                                while($productRow = $productResult->fetch_assoc()) {
                            ?>
                              <option value="<?php echo $productRow["retailerId"]?>"><?php echo $productRow["retailerName"]?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>

                        </div>
                        <div class=" mb-3 ">
                          <label for="product">Product</label>
                          <select name="product" id="product" class="form-control">
                            <?php 

                              $productSql="SELECT * FROM `products` WHERE quantity>0 ";
                              $productResult= $conn->query($productSql);
                              if ($productResult->num_rows > 0) {
                                // output data of each row
                                while($productRow = $productResult->fetch_assoc()) {
                                  // $productName=$productRow["productName"];
                            ?>
                              <option value="<?php echo $productRow["productId"]?>"><?php echo $productRow["productName"]?></option>
                            <?php
                                }
                              }
                            ?>
                          </select>

                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="quantity" type="number" name="quantity" required placeholder="Enter quantity of product" />
                            <label for="quantity">Quanitity</label>
                        </div>
                        
                        
                        <div class="mt-4 mb-0">
                            <input type="submit" class="btn btn-primary" value="Add order"/>
                        </div>
                    </form>
                    <?php
                                          
                      if($_SERVER['REQUEST_METHOD'] == "POST")
                      {
                          //something was posted
                        $productId = $_POST['product'];
                        $quantity = $_POST['quantity'];
                        $retailerId = $_POST['retailer'];
                        $userId=$_SESSION['userId'];
                          //save to database
                        $query = "INSERT INTO orders ( productId, retailerId, userId, quantityOrdered) VALUES ( '$productId', '$retailerId', '$userId'  ,'$quantity')";
                        if(mysqli_query($conn,$query)){
                          $updateInventory="UPDATE `products` SET quantity=(quantity-'$quantity') WHERE productId='$productId'   ";
                          if(mysqli_query($conn,$updateInventory)){
                            echo "<script>alert('order added succesfully')</script>";
                            echo "<script>location.replace('manageorders.php');</script>";
                          }
                          else{
                            echo "<script>alert('product quantity has not been updated</script>";
                          }
                           
                        }
                        else{
                            echo "\r\n Record not inserted ".mysqli_error($conn);
                          }
                        

                    }
                    ?>
                </div>
                
            </div>
        </div>
    </div>
  </div>
  </div>
</div>


  <!-- Footer-->
<?php
include ('includes/footer.php');
include ('includes/scripts.php');

?>
