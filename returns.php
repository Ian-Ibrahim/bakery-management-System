

  <!-- Header-->
  <?php

include ('/xampp/htdocs/BMS_3.0/includes/header.php');
require_once('/xampp/htdocs/BMS_3.0/assets/php/connect.php');
?>

  <!-- Content of the page-->



  <div class="container-fluid px-4">
                        <h1 class="mt-4">Returns</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">This is a summary of the Returns. </li>
                        </ol>
<table id="datatablesSimple" >
    <h2 class="mt-4">Expenses</h2>
    <thead> 
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>

        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>

        </tr>
    </tfoot>
    <tbody>
  <?php
  $totalExpenses=0;
  $sql = "SELECT SUM(unitPrice*quantity), materialName FROM `primematerials` GROUP BY materialName";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
   // output data of each row
   while($row = $result->fetch_assoc()) {
    $totalExpenses+= $row["SUM(unitPrice*quantity)"];
  ?>
              <tr>
                <td><?php echo $row["materialName"];?></td>

                <td><?php echo $row["SUM(unitPrice*quantity)"];?></td>

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
  }

  ?>
  <tr>
    <td >total Expenses</td>
    <td><?php echo $totalExpenses;?></td>
  </tr>
            </tbody>
      </table>
      
  
  <!-- Footer-->
<?php

include('/xampp/htdocs/BMS_3.0/includes/footer.php');
//include ('includes/footer.php');
include ('/xampp/htdocs/BMS_3.0/includes/scripts.php');

?>
