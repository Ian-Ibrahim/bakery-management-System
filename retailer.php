

  <!-- Header-->
  <?php

include ('/xampp/htdocs/BMS_3.0/includes/header.php');
require_once('/xampp/htdocs/BMS_3.0/assets/php/connect.php');
?>

  <!-- Content of the page-->
<div class="container-fluid px-4">
    <p class="mt-4"> Home/ <span class="small stretched-link">Retailers</span></p>
    <h1 >Retailers </h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">This is a summary of the retailers that are working with us.</li>
    </ol>
<div class="card mb-4" style="z-index:90;">
  <div class="card-header">
      <i class="fas fa-table me-1"></i>
      retailers
  </div>
  <div class="card-body" style="height:70vh">
      <table id="datatablesSimple" >
          <thead> 
              <tr>
                  <th>Retailer Name</th>
                  <th>Retailer Phone</th>
                  <th>Retailer Email</th>
                  <th>Retailer Location</th>
                  <th>Retailer County</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tfoot>
              <tr>
                  <th>Retailer Name</th>
                  <th>Retailer Phone</th>
                  <th>Retailer Email</th>
                  <th>Retailer Location</th>
                  <th>Retailer County</th>
                  <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            <?php
               $sql = "SELECT * FROM `retailers` ";
               $result = $conn->query($sql);
               if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td><?php echo $row["retailerName"];?></td>
                <td><?php echo $row["retailerPhone"];?></td>
                <td><?php echo $row["retailerEmail"];?></td>
                <td><?php echo $row["retailerLocation"];?></td>
                <td><?php echo $row["retailerCounty"];?></td>
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
                //echo "No retailers  in the database";
              }
            ?>
          </tbody>
      </table>
  </div>
  <div class="card-body" style="height:100vh;">
  
  <div class="container" id="addretailer">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header"><h3 class="text-center font-weight-light my-4">Retailers Form</h3></div>
                <div class="card-body">

                    <!--connect to the database-->
                    <!-- <form action="/Applications/MAMP/htdocs/BMS_3.0/assets/php/connect.php" method="POST"> -->
                    <form method="POST">

                        <div class="form-floating mb-3 ">
                                <input class="form-control" id="retailerName" type="text" name="retailerName" required placeholder="Enter retailer name" />
                                <label for="retailerName">retailer name</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="retailerPhone" type="tel" name="retailerPhone" required placeholder="Enter price of retailer" />
                            <label for="retailerPhone">Retailer Phone Number</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="retailerEmail" type="email" name="retailerEmail" required placeholder="Enter email of retailer" />
                            <label for="retailerEmail">Retailer Email</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="retailerLocation" type="text" name="retailerLocation" required placeholder="Enter location of retailer" />
                            <label for="retailerLocation">Retailer Location</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <input class="form-control" id="retailerCounty" type="text" name="retailerCounty" required placeholder="Enter county  of retailer" />
                            <label for="retailerCounty">Retailer County</label>
                        </div>
                        
                        <div class="mt-4 mb-0">
                            <input type="submit" class="btn btn-primary" value="Add retailer"/>
                        </div>
                    </form>
                    <?php
                                          
                      if($_SERVER['REQUEST_METHOD'] == "POST")
                      {
                          //something was posted
                        $retailerName = $_POST['retailerName'];
                        $retailerLocation = $_POST['retailerLocation'];
                        $retailerPhone = $_POST['retailerPhone'];
                        $retailerCounty = $_POST['retailerCounty'];
                        $retailerEmail = $_POST['retailerEmail'];
                          //save to database
                        $query = "insert into retailers ( retailerName, retailerLocation, retailerPhone, retailerCounty,retailerEmail) values ( '$retailerName', '$retailerLocation', '$retailerPhone', '$retailerCounty','$retailerEmail')";
                        if(mysqli_query($conn,$query)){
                            echo "<script>alert('retailer added succesfully')</script>";
                            echo "<script>location.replace('retailer.php');</script>";
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
