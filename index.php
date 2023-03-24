
<?php

include ('includes/header.php');

require_once('/xampp/htdocs/BMS_3.0/assets/php/connect.php');

?>


<a href="/BMS_3.0/logout.php"></a>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">This is a summary of the Bakery Performance</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Prime Materials</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/BMS_3.0/primeMaterials.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-info text-white mb-4">
                                    <div class="card-body">Products</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/BMS_3.0/products.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-secondary text-white mb-4">
                                    <div class="card-body">Retailers</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/BMS_3.0/retailer.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Manage Orders</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/BMS_3.0/manageOrders.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Total Orders</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/BMS_3.0/totalOrders.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Returns</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="/BMS_3.0/returns.php">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area me-1"></i>
                                       Total Sales
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-1"></i>
                                        Total Orders
                                    </div>
                                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Retailers
                            </div>
                            <div class="card-body">
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
                        </div>
                    </div>
               
               
 <?php

include ('includes/footer.php');
include ('includes/scripts.php');

?>
