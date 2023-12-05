<?php require "adheader.php"; ?>
<?php require "slidebar.php";

//  require "function.php";
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2"> 
                <div class="col-sm-6">
                    <h1>Add Services </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Job Card</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        <div class="row">
            <!-- ./col -->
        </div>
    </section>

    <!-- /.modal -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
        
            <div class="col-md-12">
                <div class="card card-primary">
                    
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add Service</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <div id="wrapper">
                <form action="adminFunction.php" method="post" enctype="multipart/form-data">
                <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM jobcard WHERE id='$id'";
                    $res = mysqli_query($conn, $sql);
                    $res = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($res) > 0) {
                        while ($row = mysqli_fetch_assoc($res)) { ?>
                    <div id="form_div">
                        <div>
                            <input type="hidden" name="g_id" value="<?php echo $row['g_id']; ?>">
                            <input type="hidden" name="uid" value="<?php echo $row['uid']; ?>">
                        </div>
                        <!-- <div class="col-md-12"> -->
                            <div class="table-responsive">
                            <table class="table" id="dynamicTable">
                                <thead>
                                    <tr> 
                                        <th>Service Name/Part Name</th>
                                        <th>MRP</th>
                                        <th>HSN Code</th>
                                        <th>GST%</th>
                                        <th>Taxable Amt</th> 
                                        <th>Action</th>                                  
                                    </tr>
                                </thead>
                                <tbody>
                                <tr id="1">
                                <!-- <div id="output"></div> -->
                                    <td><input type="hidden" name="srno[]" class="srno" value="1" readonly/> <input type="text" name="service[]" id="service1" placeholder="Enter Service Name" class="form-control-sm"></td>
                                    <td><input type="text" name="price[]" id="price1" placeholder="Price" class="form-control-sm"></td>
                                    <td><input type="text" name="hsn_code[]" id="hsn_code1" placeholder="Enter HSN code" class="form-control-sm"></td>
                                    <td><input type="text" name="gst[]" id="gst1" placeholder="GST%" class="form-control-sm gs_t" style="width: 4rem;"></td>
                                    <td><input type="text" name="total[]" id="total1" class="form-control-sm order_item_price"></td>
                                    <td> <button type="button" disabled name="add"class="btn btn-danger btn-sm w-100">Remove</button></td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        <!-- </div> -->
                            <div class="col-md-12">
                                <div class="form-inline">
                                    <div>
                                        <input type="button" class="btn btn-primary" id="add" value="Add">
                                        <!-- <input type="submit" name="btn-done" value="SUBMIT"> -->
                                    </div>
                                    <div class="form-inline" style="margin-left: 2rem;">
                                        <label style="padding-right: 8px;">Total</label>
                                        <!-- <span class="text-success" id="grandtotal"></span> -->
                                        <input type="text" id="grandtotal">
                                    </div>
                                </div>
                            </div>
                        </div>
                    

                </div>
                
            </div>
            <!-- /.card-body -->
        </div>
        
        <?php }
                    } ?>
        <div class="row">
            <div class="col-12">
                <a href="ShowJobCard.php" class="btn btn-secondary">Cancel</a>
                <input type="submit" name="btn-edit" value="Save Changes" class="btn btn-success float-right">
                </form>
            </div>
        </div>
    </div>
        </div>
        </div>
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">

    <strong>Copyright &copy;2022 <a href="">Garage Software Pvt Ltd</a>.</strong> All rights reserved.
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
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(function Readdata() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script>
    var total = 0;

    function UpdateCost(elem) {

        if (elem.checked == true) {
            total += Number(elem.value);
        } else {
            total -= Number(elem.value);
        }

        document.getElementById('total').value = total.toFixed(0);
    }
</script>
<script type="text/javascript">
     var i = 1;
    $("#add").click(function(){
        var length = $('.srno').length;
        console.log(length, 'length');
        ++i;
        var html_code = '';
        html_code += '<tr id="'+i+'">';
        html_code += '<td><input type="hidden" class="srno" name="srno[]" value="'+i+'" readonly/><input type="text" name="service[]" id="service'+i+'" placeholder="Enter Service Name" class="form-control-sm"></td>';
        html_code += '<td><input type="text" name="price[]" id="price'+i+'" placeholder="Price" class="form-control-sm"></td>';
        html_code += '<td><input type="text" name="hsn_code[]" id="hsn_code'+i+'" placeholder="Enter HSN code" class="form-control-sm"></td>';
        html_code += '<td><input type="text" name="gst[]" id="gst'+i+'" placeholder="GST%" class="form-control-sm gs_t" style="width: 4rem;"></td>';
        html_code += '<td><input type="text" name="total[]" id="total'+i+'" class="form-control-sm order_item_price"></td>';
        html_code += '<td><button type="button" name="remove_row" id="'+i+'" class="btn btn-danger btn-sm remove-tr w-100 remove_row">Remove</button></td>';
        $("#dynamicTable").append(html_code);
    });
    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
    //this section calculation gst amount and total grand total amount
    function cal_final_total(i)
{
    var final_item_total = 0;
    var sum = 0;
    var sum1 = 0;
    var price = 0;
    var gst = 0;
    
    for(j=1; j<=i; j++)
    {
        price = $('#price'+j).val();
        gst = $('#gst'+j).val();
        pergst = price * gst / 100;
        var sum = parseFloat(price) - parseFloat(pergst);
        var sum1 = parseFloat(sum) + parseFloat(sum1);
        $('#total'+j).val(sum.toFixed(2));        
    }
    $('#grandtotal').val(sum1.toFixed(2));

}
$(document).on('keyup', '.gs_t', function(){
    if($('#gst'+i).val() ==''){
        $('#order_item_price'+i).val(0);
    }
    cal_final_total(i);
});

    //remove button click
    $(document).on('click', '.remove-tr', function(){
    var ntrid = $(this).closest('tr').attr('id');
    var grandtotal = $('#grandtotal').val();
    var ntotal = $('#total'+ntrid).val();
    var nfinal =  parseFloat(grandtotal) - parseFloat(ntotal);
    // console.log(nfinal, 'ntrid');
    $('#grandtotal').val(nfinal.toFixed(2));
    $(this).parents('tr').remove();
    i--;  
});
</script>
</body>

</html>