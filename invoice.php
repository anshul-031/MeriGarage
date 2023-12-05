<?php require "adheader.php"; ?>
<?php require "slidebar.php"; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Invoice</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Invoice</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <?php
  $id = $_GET['id'];
  $query = "SELECT * FROM jobcard WHERE id='$id'";
  $res = mysqli_query($conn, $query);
  
  if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) { ?>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="invoice p-3 mb-3">
                <div class="row">
                  <div class="col-12">
                    <h4>
                      <img src="<?php
              if (isset($_SESSION['user'])) {

                echo $_SESSION['img'];
              }; ?>" alt="" style="width: 100px;"> <?php echo $_SESSION['user']; ?>
                      <small class="float-right">Date: <?php echo $row['created_at']; ?></small>
                    </h4>
                  </div>
                </div>
                <div class="row invoice-info">
                  <div class="col-sm-4 invoice-col">
                    From
                    <address>
                      <strong><?php echo $_SESSION['user']; ?></strong><br>
                      <?php echo $_SESSION['g_address']; ?><br>
                      Phone:<?php echo $_SESSION['g_mob']; ?><br>
                      Email: <?php echo $_SESSION['g_email']; ?><br>
                      GST: <strong><?php echo $_SESSION['g_gst']; ?></strong>
                    </address>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    Bill To
                    <address>
                     
                    <strong>Name: </strong>  <?php echo $row['name']; ?><br>
                    <strong>Address:</strong>     <?php echo $row['address']; ?><br>
                    <strong> Contact:</strong>   <?php echo $row['contact']; ?><br>
                    <strong> Email:</strong>   <?php echo $row['email']; ?><br>
                    <strong> GST:</strong> <?php echo $row['c_gst']; ?>
                    </address>
                  </div>
                  <div class="col-sm-4 invoice-col">
                    <b>Tax Invoice #<?php echo $row['invoice_no']; ?></b><br>
                    <strong>Registration No:</strong>   <?php echo $row['registration']; ?><br>
                    <strong>Car Model:</strong>   <?php echo $row['carmodel']; ?><br>
                    <strong>Chassis No:</strong>   <?php echo $row['chassis_no']; ?><br>
                    <br>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Service</th>
                          <th>HSN Code</th>
                          <th>Taxable Amt</th>
                          <th>GST%</th>
                          <th>MRP</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $itemId = $row['uid'];
                        $query = "SELECT * FROM jobcode_service_items WHERE uid = '$itemId'";
                        $res = mysqli_query($conn, $query);
                        if (mysqli_num_rows($res) > 0) {
                          $i=1;
                          while ($row = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $row['service']; ?></td>
                              <td><?php echo $row['hsn_code']; ?></td>
                              <td>₹<?php echo $row['total']; ?>.00</td>
                              <td><?php echo $row['gst']; ?>%</td>
                              <td>₹<?php echo $row['price']; ?>.00</td>
                            </tr>
                        <?php $i++; }
                        } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.row -->

                <div class="row">
                  <div class="col-6">
                    <p class="lead">Payment Methods:</p>
                    <img src="dist/img/credit/visa.png" alt="Visa">
                    <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="dist/img/credit/american-express.png" alt="American Express">
                    <img src="dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">

                    </p>
                  </div>
                  <div class="col-6">
                    <div class="table-responsive">
                    <table class="table">
                        <tr>
                          <th>Sub Total:</th>
                          <?php ?>
                          <td>₹
                            <?php
                            // get user uid
                            $user_id = $_GET['id'];
                            $ischek = "SELECT uid FROM `jobcard` WHERE id = $user_id";
                            $ischeck_query = mysqli_query($conn, $ischek);
                            $get_uid = mysqli_fetch_array($ischeck_query);
                            //end get user uid
                            $service_item_id= (int)$get_uid[0];
                            // echo  $service_item_id;
                            $query_item = "SELECT sum(total) FROM jobcode_service_items WHERE uid = $service_item_id";
                            $run_item = mysqli_query($conn, $query_item);
                            $data_item1 = mysqli_fetch_array($run_item);
                            echo $data_item1[0];
                         
                            ?>.00
                          </td>
                        </tr>
                       
                        <tr>
                          <th>Grand Total:</th>
                          <?php ?>
                          <td>₹
                            <?php
                            $job_id = $_SESSION['uid'];
                            $query_item = "SELECT sum(price) FROM jobcode_service_items WHERE uid = $service_item_id";
                            $run_item = mysqli_query($conn, $query_item);
                            $data_item2 = mysqli_fetch_array($run_item);
                            echo $data_item2[0];
                            ?>.00
                            
                          </td>
                        </tr>
                        
                      </table>
                      <tr>
                          <th><strong>GST Value:</strong></th>₹
                          <?php $gst= $data_item2[0] - $data_item1[0];?>
                          <strong><?php echo $gst; ?>.00</strong>
                        </tr>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <strong>Note:</strong><br> Please Note That Grand Total Is GST Included Payable Amount, Terms And Conditions Apply.

                <div class="row no-print">
                  <div class="col-12">
                    <a href="invoiceprint.php?id=<?php echo $_GET['id']; ?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  </div>
                </div>
              </div>
              <!-- /.invoice -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
  <?php }
  } ?>

  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer no-print">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.2.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://merigarage.com">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>

</html>