

  <!-- Header-->
<?php

include ('/xampp/htdocs/BMS_3.0/includes/header.php');
require_once('/xampp/htdocs/BMS_3.0/assets/php/connect.php');
?>

  <!-- Content of the page-->



<div class="container-fluid px-4">
    <p class="mt-4"> Home/ <span class="small stretched-link">Prime materials</span></p>
    <h1 >Prime Materials </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">This is a summary of the Prime Materials</li>
    </ol>
<div class="card mb-4" style="z-index:90;">
  <div class="card-header">
      <i class="fas fa-table me-1"></i>
      Prime Materials
  </div>
  <div class="card-body" style="height:70vh">
      <table id="datatablesSimple" >
          <thead> 
              <tr>
                  <th>material Id</th>
                  <th>Material Name</th>
                  <th>Quantity</th>
                  <th>Unit price</th>
                  <th>Unit quantifier</th>
                  <th>Total value</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th>material Id</th>
                  <th>Material Name</th>
                  <th>Quantity</th>
                  <th>Unit price</th>
                  <th>Unit quantifier</th>
                  <th>Total value(KES)</th>
                  <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php
               $sql = "SELECT * FROM `primematerials` ";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td><?php echo $row["materialId"];?></td>
                <td><?php echo $row["materialName"];?></td>
                <td><?php echo $row["quantity"];?></td>
                <td><?php echo $row["unitPrice"];?></td>
                <td><?php echo $row["unitQuantifier"];?></td>
                <td><?php echo $row["unitPrice"]*$row["quantity"]; ?></td>
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
                echo "No prime materials  in the database";
              }
            ?>
              <!-- <tr>
                  <td>Tiger Nixon</td>
                  <td>System Architect</td>
                  <td>Edinburgh</td>
                  <td>61</td>
                  <td>2011/04/25</td>
                  <td>$320,800</td>
                  
              </tr> -->

          </tbody>
      </table>
  </div>
  <div class="card-body" style="height:100vh;">
  
  <div class="container" id="addPrimeMaterial">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Prime materials Form</h3></div>
                <div class="card-body">

                    <!--connect to the database-->
                    <!-- <form action="/Applications/MAMP/htdocs/BMS_3.0/assets/php/connect.php" method="POST"> -->
                    <form method="POST">
                        <div class="row mb-3">

                        <div class="form-floating mb-3 mb-md-0">
                                <input class="form-control" id="materialName" type="text" name="materialName" required placeholder="Enter material name" />
                                <label for="materialName">Material name</label>
                        </div>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="quantity" type="number" name="quantity" required placeholder="Enter quantity of material" />
                            <label for="quantity">Quanitity</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="unitPrice" type="number" name="unitPrice" required placeholder="Enter price of material" />
                            <label for="unitPrice">Unit price</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="unitQuantifier" type="text" name="unitQuantifier" required placeholder="Enter quantifier of material" />
                            <label for="unitQuantifier">Unit quantifier</label>
                        </div>
                        <div class="mt-4 mb-0">
                            <input type="submit" class="btn btn-primary" value="Add material"/>
                        </div>
                    </form>
                    <?php
                                          
                      if($_SERVER['REQUEST_METHOD'] == "POST")
                      {
                          //something was posted
                        $materialName = $_POST['materialName'];
                        $quantity = $_POST['quantity'];
                        $unitPrice = $_POST['unitPrice'];
                        $unitQuantifier = $_POST['unitQuantifier'];
                          //save to database
                        $query = "insert into primematerials ( materialName, quantity, unitPrice, unitQuantifier) values ( '$materialName', '$quantity', '$unitPrice', '$unitQuantifier')";
                        mysqli_query($conn,  $query);
                        echo "<script>location.replace('primeMaterials.php');</script>";

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
