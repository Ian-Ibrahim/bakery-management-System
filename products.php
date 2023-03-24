

  <!-- Header-->
  <?php

include ('/xampp/htdocs/BMS_3.0/includes/header.php');
require_once('/xampp/htdocs/BMS_3.0/assets/php/connect.php');
?>

  <!-- Content of the page-->
<div class="container-fluid px-4">
    <p class="mt-4"> Home/ <span class="small stretched-link">Bakery Products</span></p>
    <h1 >Bakery Products </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">This is a summary of the products</li>
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
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Price(KES)</th>
                  <th>Package Weight</th>
                  <th>Total Value(KES)</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Price(KES)</th>
                  <th>Package Weight</th>
                  <th>Total value(KES)</th>
                  <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php
               $sql = "SELECT * FROM `products` ";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td><?php echo $row["productName"];?></td>
                <td><?php echo $row["quantity"];?></td>
                <td><?php echo $row["price"];?></td>
                <td><?php echo $row["packageWeight"]." ".$row["weightQuantifier"];?></td>
                <td><?php echo $row["price"]*$row["quantity"];?></td>
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
                //echo "No rpoducts  in the database";
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
                <div class="card-header"><h3 class="text-center font-weight-light my-4">products Form</h3></div>
                <div class="card-body">

                    <!--connect to the database-->
                    <!-- <form action="/Applications/MAMP/htdocs/BMS_3.0/assets/php/connect.php" method="POST"> -->
                    <form method="POST">

                        <div class="form-floating mb-3 ">
                                <input class="form-control" id="productName" type="text" name="productName" required placeholder="Enter product name" />
                                <label for="productName">Product name</label>

                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="unitPrice" type="number" name="unitPrice" required placeholder="Enter price of product" />
                            <label for="unitPrice">Unit price</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="quantity" type="number" name="quantity" required placeholder="Enter quantity of product" />
                            <label for="quantity">Quanitity</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="weight" type="number" name="weight" required placeholder="Enter weight of product" />
                            <label for="weight">weight</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="weightQuantifier" type="text" name="weightQuantifier" required placeholder="Enter weight quantifier of product" />
                            <label for="weightQuantifier">weight quantifier</label>
                        </div>
                        
                        <div class="mt-4 mb-0">
                            <input type="submit" class="btn btn-primary" value="Add product"/>
                        </div>
                    </form>
                    <?php
                                          
                      if($_SERVER['REQUEST_METHOD'] == "POST")
                      {
                          //something was posted
                        $productName = $_POST['productName'];
                        $quantity = $_POST['quantity'];
                        $unitPrice = $_POST['unitPrice'];
                        $weightQuantifier = $_POST['weightQuantifier'];
                        $weight = $_POST['weight'];
                          //save to database
                        $query = "insert into products ( productName, quantity, price, weightQuantifier,packageWeight) values ( '$productName', '$quantity', '$unitPrice', '$weightQuantifier','$weight')";
                        if(mysqli_query($conn,$query)){
                            echo "<script>alert('product added succesfully')</script>";
                            echo "<script>location.replace('products.php');</script>";
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
