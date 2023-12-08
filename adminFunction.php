<?php
require("connection.php");

/////////////////// display booking ///////////////////////
if(isset($_SESSION['id'])){
function display_product($conn,$g_id)
{ 
    $g_id= $_SESSION['id'];

    $sql = "SELECT * FROM g_booking where g_id=$g_id ORDER BY created_at DESC";
    $res = mysqli_query($conn, $sql);
    
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><?php echo $row['cus_name']; ?></td>
            <td><?php echo $row['cus_email']; ?></td>
            <td><?php echo $row['cus_mob']; ?></td>
            <td><?php echo $row['car_model']; ?></td>
            <td><?php echo $row['service']; ?></td>
            <td><?php echo $row['service_date']; ?></td>
            <td><?php echo $row['request']; ?></td>
            <td><strong><a href="jobcardweb.php?id=<?php echo $row['id'];?>">Job Card</a></strong></td>
        </tr>

    <?php $i++;
    } ?>
    <?php }}
    /////////////////// display App booking ///////////////////////
    if(isset($_SESSION['id'])){
function display_product1($conn)
{
    $g_id= $_SESSION['id'];
    $sql = "SELECT * FROM booking_detail where g_id=$g_id ORDER BY created_at DESC";
    $res = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['mobile']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <!-- <td><?php echo $row['carbrand']; ?></td> -->
            <td><?php echo $row['carmodel']; ?></td>
            <td><?php echo $row['service']; ?></td>
            <td><?php echo $row['fuel']; ?></td>
            <td><?php echo $row['insurance']; ?></td>
            <td><?php echo $row['policyperoid']; ?></td>
            <td><?php echo $row['other_car']; ?></td>
            <td><?php echo $row['spl_req']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><strong><a href="jobcardmake.php?id=<?php echo $row['id'];?>">Job Card</a></strong></td>
            
        </tr>

    <?php $i++;
    } ?>
    <?php }}
///////////////////// count booking //////////////////////

function countProduct($conn)
{
    $g_id= $_SESSION['id'];

    $sql = "select * from g_booking where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

///////////////////// count user //////////////////////

function countUser($conn)
{
    $sql = "select * from caruser";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}
///////////////////// count user //////////////////////

function countAppOrder($conn)
{
    $g_id= $_SESSION['id'];
    $sql = "select * from serviceorder where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

///////////////////// count user //////////////////////

function countAppbooking($conn)
{
    $g_id= $_SESSION['id'];
    $sql = "select * from booking_detail where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}
///////////////////// count jobcard //////////////////////

function countjobcard($conn)
{
    $g_id= $_SESSION['id'];

    $sql = "select * from jobcard where g_id=$g_id and work_status=1";
    // $sql = "select * from jobcard";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    } 
}
///////////////////// count complete jobcard //////////////////////

function count_complete_jobcard($conn)
{
    $g_id= $_SESSION['id'];

    $sql = "select * from jobcard where g_id=$g_id and work_status=0";
    // $sql = "select * from jobcard";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}
//////////////// delete booking///////////////////////

if (isset($_POST['uid'])) {
    $_SESSION['uid'] = $_POST['uid'];
}

if (isset($_POST['btn-del']) && isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql = "DELETE FROM bookingform WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location:dashboard.php");
        $_SESSION['msg4'] = "Booking Deleted!!";
    }
}



////////////////login admin//////////////////////

// if (isset($_POST['btn-sub'])) {
//     login($conn);
// }
// function login($conn)
// {
//     $g_mob = $_POST['g_mob'];
//     $password = $_POST['password'];
    
//     $hashed_password = hash('sha256', $password); // Hash the password using SHA-256
    
//     $sql = "SELECT * FROM garages_login WHERE g_mob='$g_mob' AND password='$hashed_password'";
//     $res = mysqli_query($conn, $sql);
//     if (mysqli_num_rows($res) > 0) {
//         $row = mysqli_fetch_assoc($res);
//         $_SESSION['user'] = $row['g_name'];
//         $_SESSION['id'] = $row['g_id'];
//         $_SESSION['img'] = $row['img'];
//         $_SESSION['g_email'] = $row['g_email'];
//         $_SESSION['g_mob'] = $row['g_mob'];
//         $_SESSION['g_address'] = $row['g_address'];
//         $_SESSION['password'] = $row['password'];
//         header("location:dashboard.php");
//         $_SESSION['msg5'] = "Welcome back!!";
//     } else {
//         header("location:login.php");
//         $_SESSION['msg'] = "Invalid Credentials!!";
//     }
// }

if (isset($_POST['btn-sub'])) {
    login($conn);
}
function login($conn)
{
    $g_mob = $_POST['g_mob'];
    $password = $_POST['password'];
    
    $hashed_password = hash('sha256', $password); // Hash the password using SHA-256
    
    $sql = "SELECT * FROM call_login WHERE g_mob='$g_mob' AND password='$hashed_password'";
    $res = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        
        // Check if the user's trial period has expired
        $trialEndDate = strtotime($row['trial_end_date']);
        $currentDate = strtotime(date('Y-m-d'));

        if ($currentDate > $trialEndDate) {
            // Trial period has expired, redirect to the plans page
            header("Location: plans.php");
            exit(); // Stop further execution of the script
        } else {
            // User's trial period is still valid
            $_SESSION['user'] = $row['g_name'];
            $_SESSION['id'] = $row['g_id'];
            $_SESSION['img'] = $row['img'];
            $_SESSION['g_email'] = $row['g_email'];
            $_SESSION['g_mob'] = $row['g_mob'];
            $_SESSION['g_gst'] = $row['g_gst'];
            $_SESSION['g_address'] = $row['g_address'];
            $_SESSION['password'] = $row['password'];
            header("location: dashboard.php");
            $_SESSION['msg5'] = "Welcome back!!";
        }
    } else {
        header("location: login.php");
        $_SESSION['msg'] = "Invalid Credentials!!";
    }
}

////////////////////////Register admin//////////////////////

// if(isset($_POST['btn-sub2'])){


//     // $username=$_POST['username'];
//     $g_name=$_POST['gname'];
//     $mobile=$_POST['mobile'];
//     $email=$_POST['email'];
//     $password=$_POST['password'];
//     $address=$_POST['address'];

//     // Check if the username already exists
//     $sql_check = "SELECT * FROM garages_login WHERE g_mob='$mobile'";
//     $res_check = mysqli_query($conn, $sql_check);
//     if (mysqli_num_rows($res_check) > 0) {
//         // If the username already exists, show an error message
//         $_SESSION['msgf'] = "An account with this Number already exists.";
//         header("Location:login.php");
//     } else {
//         // If the username doesn't exist, insert the new user into the table
//         $hashed_password = hash('sha256', $password);
//         $sql_insert = "INSERT INTO `garages_login`(`g_name`, `g_mob`, `g_email`, `g_address`, `password`) 
//         VALUES ('$g_name', '$mobile', '$email', '$address', '$hashed_password')";
//         $res_insert = mysqli_query($conn, $sql_insert);
//         if ($res_insert == 1) {
//             header("Location:login.php");
//             $_SESSION['msgf'] = "Account created!";
//         } else {
//             echo "Error!";
//         }
//     }
// }

if (isset($_POST['btn-sub2'])) {
    register($conn);
}

function register($conn)
{
    $g_name = $_POST['gname'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // Check if the mobile number already exists
    $sql_check = "SELECT * FROM call_login WHERE g_mob='$mobile'";
    $res_check = mysqli_query($conn, $sql_check);
    if (mysqli_num_rows($res_check) > 0) {
        // If the mobile number already exists, show an error message
        $_SESSION['msgf'] = "An account with this Number already exists.";
        header("Location: login.php");
    } else {
        // Calculate the trial end date (7 days from the registration date)
        $trialEndDate = date('Y-m-d', strtotime('+7 days'));

        // Hash the user's password
        $hashed_password = hash('sha256', $password);

        // Insert the user data into the database, including the trial end date
        $sql_insert = "INSERT INTO `call_login`(`g_name`, `g_mob`, `g_email`, `g_address`, `password`, `trial_end_date`) 
        VALUES ('$g_name', '$mobile', '$email', '$address', '$hashed_password', '$trialEndDate')";
        
        $res_insert = mysqli_query($conn, $sql_insert);

        if ($res_insert) {
            // Registration successful
            $_SESSION['msgf'] = "Account created! You now have a 7-day trial period.";
            header("Location: login.php");
        } else {
            // Registration failed
            echo "Error!";
        }
    }
}

////////////////Fotgot Password//////////////////////

if(isset($_POST['btn-sub3'])){
    update_password($conn);
}

function update_password($conn){
    $g_mob = $_POST['g_mob']; // Assuming you have a form field for the username
    $newPassword = $_POST['password']; // Assuming you have a form field for the new password
    

    // Check if the username exists in the garages_login table
    $check_sql = "SELECT * FROM call_login WHERE g_mob = '$g_mob'";
    $check_result = mysqli_query($conn, $check_sql);

    if(mysqli_num_rows($check_result) > 0){
        // Username exists, hash the new password
        // $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $hashed_password = hash('sha256', $newPassword); // Hash the password using SHA-256

        // Update the hashed password in the garages_login table
        $update_sql = "UPDATE call_login SET password = '$hashed_password' WHERE g_mob = '$g_mob'";
        $update_result = mysqli_query($conn, $update_sql);

        if($update_result){
            header("Location: login.php"); // Redirect to a success page
            $_SESSION['msg6'] = "Password Changed!!";
            exit();
        }else{
            echo "Error updating password!";
        }
    }else{
        // echo "Username not found!";
        header("location: login.php");
        $_SESSION['msg7'] = "User not found!";
    }
}


/////////////////// display messages ///////////////////////

function display_message($conn)
{
    $sql = "SELECT * FROM customermsg";
    $res = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['msg']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td class="project-actions text-right">
                <form action="adminFunction.php" method="post">
                    <input type="hidden" name="uid" value="<?php echo $row['id']; ?>">
                    <!-- <input type="submit" class="btn btn-danger btn-sm" name="Msg-del" value="Delete"> -->
                </form>
            </td>
        </tr>

    <?php $i++;
    } ?>
    <?php }

///////////////////// count message //////////////////////

function countMessage($conn)
{
    $g_id= $_SESSION['id'];
    $sql = "select * from customermsg where g_id=$g_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($res);
    if ($row > 0) {
        echo $row;
    } else {
        echo "N/A";
    }
}

//////////////// delete booking///////////////////////

if (isset($_POST['uid'])) {
    $_SESSION['uid'] = $_POST['uid'];
}

if (isset($_POST['Msg-del']) && isset($_POST['uid'])) {
    $id = $_POST['uid'];
    $sql = "DELETE FROM customermsg WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("location:message.php");
        $_SESSION['msg4'] = "Message Deleted!!";
    }
}
    
///////////////////////job card/////////////////////////////////////////

if(isset($_POST['btn-done'])){

    // $dir="uploads/";
    // $file1= $dir.basename($_FILES['img1']['name']);
    // move_uploaded_file($_FILES['img1']['tmp_name'], $file1);
    // $file2= $dir.basename($_FILES['img2']['name']);
    // move_uploaded_file($_FILES['img2']['tmp_name'], $file2);
    

    $gid=$_POST['g_id'];
    $uid=$_POST['uid'];
    $invoice_no=$_POST['invoice_no'];
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $c_gst=$_POST['c_gst'];
    $address=$_POST['address'];
    $brand=$_POST['carbrand'];
    $model=$_POST['carmodel'];
    $fuel=$_POST['fuel'];
    $regino=$_POST['regino'];
    $chassis_no=$_POST['chasno'];
    $odometer=$_POST['odometer'];
    $transmission=$_POST['transmission'];
    $braking=$_POST['braking'];
    $fuelmeter=$_POST['fuelmeter'];
    $doc=$_POST['doc'];
    $inventry=$_POST['inventry'];
    $srno=$_POST['srno'];
    $serviceName=$_POST['service'];
    $ser=$_POST['price'];
    $hsn=$_POST['hsn_code'];
    $gst=$_POST['gst'];
    $totalprice=$_POST['total'];

    $img1_files = $_FILES['img1'];
    $img1_dir = "uploads/";
    $img1_uploaded_files = [];
    foreach ($img1_files['tmp_name'] as $key => $tmp_name) {
        $img1_file_name = $img1_dir . basename($img1_files['name'][$key]);
        move_uploaded_file($tmp_name, $img1_file_name);
        $img1_uploaded_files[] = $img1_file_name;
    }

    // Handle multiple file uploads for img2
    $img2_files = $_FILES['img2'];
    $img2_dir = "uploads/";
    $img2_uploaded_files = [];
    foreach ($img2_files['tmp_name'] as $key => $tmp_name) {
        $img2_file_name = $img2_dir . basename($img2_files['name'][$key]);
        move_uploaded_file($tmp_name, $img2_file_name);
        $img2_uploaded_files[] = $img2_file_name;
    }
      
    $sql="INSERT INTO `jobcard`(`g_id`,`uid`,`invoice_no`,`name`,`c_gst`,`contact`,`email`,`address`,`carbrand`,`carmodel`,`fueltype`,`registration`,`chassis_no`,`odometer`,`transmission`,`braking`,`fuelmeter`,`document`,`inventory`,`img1`,`img2`,`totalprice`,`service`) 
    VALUES ('$gid','$uid','$invoice_no','$name','$c_gst','$mobile','$email','$address','$brand','$model','$fuel','$regino','$chassis_no','$odometer','$transmission','$braking','$fuelmeter','$doc','$inventry', '" . implode(",", $img1_uploaded_files) . "','" . implode(",", $img2_uploaded_files) . "','$totalprice','$service1')";
    $res=mysqli_query($conn,$sql);
    if($res==1){
        //carditems create this section
        foreach ($srno as $key => $value) {
            $insert_code_items="INSERT INTO `jobcode_service_items`(g_id, uid, service, price, hsn_code, gst, total) 
            VALUES ('$gid','$uid','".$serviceName[$key]."','$ser[$key]','$hsn[$key]','$gst[$key]','$totalprice[$key]')";
            $runQuery=mysqli_query($conn,$insert_code_items);
        }

        $pid=$_POST['pid'];
        foreach($ser as $serv){
            $sql1= "INSERT INTO `user_service`(`sid`,`contact`,`price`) VALUES('$uid','$mobile','$serv')";
            $res1=mysqli_query($conn,$sql1);
        } 
        if($res1==1){
            header("Location:ShowJobCard.php");
        }       
    }else{
        echo "error";
    }
}

function generateInvoiceNumber() {
    return mt_rand(10, 999);
}

////////////////////////Edit JobCard//////////////////////////////////


if (isset($_POST['btn-edit'])) {
    $res = update_jobcard($conn);

    if ($res == 1) {
        // Redirect to ShowJobCard.php after a successful update
        header("Location: ShowJobCard.php");
        exit(); // Ensure that no further code is executed after redirection
    } else {
        echo "Error updating job card.";
    }
}

function update_jobcard($conn) {
    // Initialize $res variable
    $res = 0;

    // Check if all required POST variables are set
    if (
        isset($_POST['uid'], $_POST['g_id'], $_POST['srno'], $_POST['service'], $_POST['price'], $_POST['hsn_code'], $_POST['gst'], $_POST['total'])
    ) {
        $uid = $_POST['uid'];
        $g_id = $_POST['g_id'];
        $srno = $_POST['srno'];
        $serviceName = $_POST['service'];
        $ser = $_POST['price'];
        $hsn = $_POST['hsn_code'];
        $gst = $_POST['gst'];
        $totalprice = $_POST['total'];


        foreach ($srno as $key => $value) {
            $insert_code_items = $conn->prepare("INSERT INTO jobcode_service_items(g_id, uid, service, price, hsn_code, gst, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert_code_items->bind_param("iisssss", $g_id, $uid, $serviceName[$key], $ser[$key], $hsn[$key], $gst[$key], $totalprice[$key]);
            $runQuery = $insert_code_items->execute();

            if ($runQuery) {
                // Increment $res for each successful insertion
                $res++;
            }
        }

        // Close prepared statements
        $insert_code_items->close();

        // Your existing code for additional updates...

        // Close any other prepared statements if needed...

        // Close the connection
        $conn->close();
    }

    return $res;
}



///////////////////////show service on admin /////////////////////////////////

function show_service($conn){
    $sql="SELECT * FROM service";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)){
        while($row=mysqli_fetch_assoc($res)){?>
            <option value="<?php echo $row['service']; ?>"><?php echo $row['service']; ?></option>
      <?php  }
    }
}
function show_price($conn){
    $sql="SELECT * FROM service";
    $res=mysqli_query($conn,$sql);
    if(mysqli_num_rows($res)){
        while($row=mysqli_fetch_assoc($res)){?>
            <input type="text" class="form-control" name="price" value="" placeholder="Enter Price" required>
      <?php  }
    }
}

//////////////////////// update price in service table //////////////////////////

if(isset($_POST['update'])){
    update_price($conn);
}

function update_price($conn){

    $id=$_POST['sid'];
    $service=$_POST['service'];
    $price=$_POST['price'];

    $sql="UPDATE `service` SET `service`='$service', `price`='$price' WHERE id='$id'";
    $res=mysqli_query($conn,$sql);
    if($res==1){
        echo "Price Updated!!";
    }else{
        echo "Error!!";
    }
}

///////////////////////////////////View Details/////////////////////////////////////////////////////////

function view_details($conn)
{
    $id= $_GET['id'];
    $sql = "SELECT * FROM jobcard WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['invoice_no']; ?></td>
            <td><?php echo $row['name']; ?> </td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['c_gst']; ?></td>
            <!--<td><?php echo $row['carbrand']; ?></td>-->
            <td><?php echo $row['carmodel']; ?></td>
            <td><?php echo $row['fueltype']; ?></td>
            <td><?php echo $row['registration']; ?></td>
            <td><?php echo $row['chassis_no']; ?></td>
            <td><?php echo $row['odometer']; ?></td>
            <td><?php echo $row['transmission']; ?></td>
            <td><?php echo $row['braking']; ?></td>
            <td><?php echo $row['fuelmeter']; ?>%</td>
            <td><?php echo $row['document']; ?></td>
            <td><?php echo $row['inventory']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><br><img src="<?php echo implode('" alt="" style="width: 200px;"><img src="', explode(",", $row['img1'])); ?>" alt="" style="width: 200px;"></td>
            <td><br><img src="<?php echo implode('" alt="" style="width: 200px;"><img src="', explode(",", $row['img2'])); ?>" alt="" style="width: 200px;"></td>
            <td><strong><?php if($row['work_status']==1){
                echo "Working";
            }else{ 
                echo "Complete";
            } ?></a></strong><br><a class="btn btn-success float-right" href="ShowJobCard.php">Back</a></td>
        </tr>

    <?php $i++;
    } ?>
    <?php }

   

function display_jobcard($conn)
{
    $g_id= $_SESSION['id'];
    $sql_1 = "SELECT * FROM jobcard WHERE g_id=$g_id ORDER BY created_at DESC";
    $res = mysqli_query($conn, $sql_1);
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['name']; ?><br><a class="btn btn-primary" href="viewdetail.php?id=<?php echo $row['id'];?>">View</a>
            <a class="btn btn-success" href="editjobcard.php?id=<?php echo $row['id'];?>">Edit</a>
            <a class="btn btn-danger" href="delete_jobcard.php?id=<?php echo $row['id']; ?>">Delete</a> </td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><strong><?php if($row['work_status']==1){
                echo "Working";
            }else{ 
                echo "Complete";
            } ?></a></strong></td>
             
            <td><?php if($row['work_status']==1){?> 
                <form action="" method="post">
                <input type="hidden" name="user_id" value="<?php echo $row['uid'];?>">
                <input type="hidden" name="g_id" value="<?php echo $row['g_id'];?>">
                <input type="hidden" name="uid" value="<?php echo $row['id'];?>">
                <input type="hidden" name="u_name" value="<?php echo $row['name'];?>">
                <input type="hidden" name="u_contact" value="<?php echo $row['contact'];?>">

                <input type="hidden" name="status" value="<?php echo $row['work_status'];?>">
                    <?php
                echo "<input type='submit' value='Make Done' name='btn-proccess' class='btn btn-danger'>";
                
              ?> </form>
          <?php }else{
                if($row['work_status']==0){?>
                       <a class="btn btn-primary" href="invoice.php?id=<?php echo $row['id'];?>">Invoice</a> 
                      
             <?php }
            }; ?></td>
            
            <!-- <td class="text-center"><a class="btn btn-danger" href="service-reminder.php?id=<?php echo $row['id'];?>" >Send</a></td> -->
            <td><a href="https://wa.me/+91<?php echo $row['contact'];?>" class="btn btn-primary"><i></i>Send MSG On WhatsApp</a></td>
        </tr>

    <?php $i++;
    } ?>
    <?php }

  if(isset($_POST['btn-proccess'])){
    $uid=$_POST['uid'];
    
    $update_sql="UPDATE `jobcard` SET `work_status`=0 WHERE id='$uid'";

    if(mysqli_query($conn,$update_sql)){
        header("Location:ShowJobCard.php");
    }
  } 



///////////////////////Add garage/////////////////////////////////////////

if(isset($_POST['Add-garage'])){

    $dir="uploads/";
    $file1= $dir.basename($_FILES['img1']['name']);
    move_uploaded_file($_FILES['img1']['tmp_name'], $file1);

    $name=$_POST['name'];
    $g_gst=$_POST['g_gst'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $address=$_POST['address'];

    $sql="INSERT INTO `garages`(`g_name`,`g_gst`,`g_mob`,`g_email`,`g_address`,`state`,`city`,`img`) 
    VALUES ('$name','$g_gst','$mobile','$email','$address','$state','$city','$file1')";
    $res=mysqli_query($conn,$sql);
    if($res==1){
        $app_price="INSERT INTO `app_price`(`basic_s_car_ser_petrol`, `basic_h_car_ser_petrol`, `basic_m_car_ser_petrol`, `basic_se_car_ser_petrol`, `basic_su_car_ser_petrol`, `basic_pr_car_ser_petrol`, `basic_s1_car_ser_diesel`, `basic_s2_car_ser_diesel`, `basic_s3_car_ser_diesel`, `basic_s4_car_ser_diesel`, `basic_s5_car_ser_diesel`, `stand1`, `stand2`, `stand3`, `stand4`, `stand5`, `stand6`, `stand7`, `stand8`, `stand9`, `stand10`, `stand11`, `stand12`, `stand13`, `stand14`, `stand15`, `stand16`, `stand17`, `stand18`, `stand19`, `stand20`, `stand21`, `stand22`, `spa1`, `spa2`, `spa3`, `spa4`, `spa5`, `spa6`, `paint1`, `paint2`, `paint3`, `paint4`, `paint5`, `paint6`, `ac1`, `ac2`, `ac3`, `ac4`, `ac5`, `ac6`, `ac7`, `ac8`, `ac9`, `ac10`, `ac11`, `ac12`) 
        VALUES ('1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1','1')";
        $result=mysqli_query($conn,$app_price);
        if($result==1){
            header("Location:login.php"); 
        }
    }else{
        echo "Error!!";
    }
}

/////////////////// display garage///////////////////////

    function display_garage($conn)
    { 
    
        $sql = "SELECT * FROM garages";
        $res = mysqli_query($conn, $sql);
        
        $i = 1;
        while ($row = mysqli_fetch_assoc($res)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['g_name']; ?></td>
                <td><?php echo $row['g_email']; ?></td>
                <td><?php echo $row['g_mob']; ?></td>
                <td><img src="<?php echo $row['img']; ?>" alt="" style="width :100px"></td>
                <td><?php echo $row['state']; ?></td>
                <td><?php echo $row['city']; ?></td>
                <td><?php echo $row['g_address']; ?></td>
           </tr>
    
        <?php $i++;
        } ?>
        <?php }

////////////////// display App order ///////////////////////

function order($conn){
    $g_id= $_SESSION['id'];
    $sqll="SELECT * FROM serviceorder WHERE g_id=$g_id ORDER BY created_at DESC";
    $res1=mysqli_query($conn,$sqll);
    $i=1;
    while($row=mysqli_fetch_assoc($res1)){?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['customerName']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['contact']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['order_service']; ?></td>
            <td><?php echo $row['order_price']; ?></td>
            <td><?php echo $row['total_price']; ?></td>
            <td><?php echo $row['created_at']; ?></td>


        </tr>
  <?php $i++;  }
}
/////////////////////create user details//////////////////////////////////

if(isset($_POST['jobcard'])){
   
    $gid=$_POST['g_id'];
    $name=$_POST['name'];
    $email=$_POST['cus_email'];
    $mobile=$_POST['mobile'];
    $car_brand=$_POST['brand'];
    $car_model=$_POST['model'];
    $gst=$_POST['c_gst'];
   
    $sql="INSERT INTO `g_booking`(`g_id`,`cus_name`,`cus_email`,`cus_mob`,`car_brand`,`car_model`,`c_gst`) 
    VALUES ('$gid','$name','$email','$mobile','$car_brand','$car_model','$gst')";
    $res=mysqli_query($conn,$sql);
    if($res==1){
        header("Location:dashboard.php");      
    }else{
        echo "Error!!";
    }
}

function selectCarmodel($conn)
{ 
    $sql = "SELECT * FROM mericar_model";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <option value="<?php echo $row['modelTitle']; ?>"><?php echo $row['modelTitle'];?></option>
    <?php }
}

function selectCarbrand($conn)
{ 
    $sql = "SELECT * FROM mericar_make";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) { ?>
        <option value="<?php echo $row['makeTitle']; ?>"><?php echo $row['makeTitle'];?></option>
    <?php }
}

///////////////////////Add Price on google App/////////////////////////////////////////

if(isset($_POST['save_price'])){

    // $g_id=$_POST['g_id'];
    $basic_s_car_ser_petrol=$_POST['basic_s_car_ser_petrol'];
    $basic_h_car_ser_petrol=$_POST['basic_h_car_ser_petrol'];
    $basic_m_car_ser_petrol=$_POST['basic_m_car_ser_petrol'];
    $basic_se_car_ser_petrol=$_POST['basic_se_car_ser_petrol'];
    $basic_su_car_ser_petrol=$_POST['basic_su_car_ser_petrol'];
    $basic_pr_car_ser_petrol=$_POST['basic_pr_car_ser_petrol'];
    $basic_s1_car_ser_diesel=$_POST['basic_s1_car_ser_diesel'];
    $basic_s2_car_ser_diesel=$_POST['basic_s2_car_ser_diesel'];
    $basic_s3_car_ser_diesel=$_POST['basic_s3_car_ser_diesel'];
    $basic_s4_car_ser_diesel=$_POST['basic_s4_car_ser_diesel'];
    $basic_s5_car_ser_diesel=$_POST['basic_s5_car_ser_diesel'];

    $stand1=$_POST['stand1'];
    $stand2=$_POST['stand2'];
    $stand3=$_POST['stand3'];
    $stand4=$_POST['stand4'];
    $stand5=$_POST['stand5'];
    $stand6=$_POST['stand6'];
    $stand7=$_POST['stand7'];
    $stand8=$_POST['stand8'];
    $stand9=$_POST['stand9'];
    $stand10=$_POST['stand10'];
    $stand11=$_POST['stand11'];
    $stand12=$_POST['stand12'];
    $stand13=$_POST['stand13'];
    $stand14=$_POST['stand14'];
    $stand15=$_POST['stand15'];
    $stand16=$_POST['stand16'];
    $stand17=$_POST['stand17'];
    $stand18=$_POST['stand18'];
    $stand19=$_POST['stand19'];
    $stand20=$_POST['stand20'];
    $stand21=$_POST['stand21'];
    $stand22=$_POST['stand22'];

    $spa1=$_POST['spa1'];
    $spa2=$_POST['spa2'];
    $spa3=$_POST['spa3'];
    $spa4=$_POST['spa4'];
    $spa5=$_POST['spa5'];
    $spa6=$_POST['spa6'];

    $paint1=$_POST['paint1'];
    $paint2=$_POST['paint2'];
    $paint3=$_POST['paint3'];
    $paint4=$_POST['paint4'];
    $paint5=$_POST['paint5'];
    $paint6=$_POST['paint6'];
    
    $ac1=$_POST['ac1'];
    $ac2=$_POST['ac2'];
    $ac3=$_POST['ac3'];
    $ac4=$_POST['ac4'];
    $ac5=$_POST['ac5'];
    $ac6=$_POST['ac6'];
    $ac7=$_POST['ac7'];
    $ac8=$_POST['ac8'];
    $ac9=$_POST['ac9'];
    $ac10=$_POST['ac10'];
    $ac11=$_POST['ac11'];
    $ac12=$_POST['ac12'];

    $sql="INSERT INTO `app_price`(`basic_s_car_ser_petrol`, `basic_h_car_ser_petrol`, `basic_m_car_ser_petrol`, `basic_se_car_ser_petrol`, `basic_su_car_ser_petrol`, `basic_pr_car_ser_petrol`, `basic_s1_car_ser_diesel`, `basic_s2_car_ser_diesel`, `basic_s3_car_ser_diesel`, `basic_s4_car_ser_diesel`, `basic_s5_car_ser_diesel`, `stand1`, `stand2`, `stand3`, `stand4`, `stand5`, `stand6`, `stand7`, `stand8`, `stand9`, `stand10`, `stand11`, `stand12`, `stand13`, `stand14`, `stand15`, `stand16`, `stand17`, `stand18`, `stand19`, `stand20`, `stand21`, `stand22`, `spa1`, `spa2`, `spa3`, `spa4`, `spa5`, `spa6`, `paint1`, `paint2`, `paint3`, `paint4`, `paint5`, `paint6`, `ac1`, `ac2`, `ac3`, `ac4`, `ac5`, `ac6`, `ac7`, `ac8`, `ac9`, `ac10`, `ac11`, `ac12`) 
    VALUES ('$basic_s_car_ser_petrol','$basic_h_car_ser_petrol','$basic_m_car_ser_petrol','$basic_se_car_ser_petrol','$basic_su_car_ser_petrol','$basic_pr_car_ser_petrol','$basic_s1_car_ser_diesel','$basic_s2_car_ser_diesel','$basic_s3_car_ser_diesel','$basic_s4_car_ser_diesel','$basic_s5_car_ser_diesel','$stand1','$stand2','$stand3','$stand4','$stand5','$stand6','$stand7','$stand8','$stand9','$stand10','$stand11','$stand12','$stand13','$stand14','$stand15','$stand16','$stand17','$stand18','$stand19','$stand20','$stand21','$stand22','$spa1','$spa2','$spa3','$spa4','$spa5','$spa6','$paint1','$paint2','$paint3','$paint4','$paint5','$paint6','$ac1','$ac2','$ac3','$ac4','$ac5','$ac6','$ac7','$ac8','$ac9','$ac10','$ac11','$ac12')";
    $res=mysqli_query($conn,$sql);
    if($res==1){
        header("Location:change_price.php");      
    }else{
        echo "Error!!";
    }
   
}

////////////////// update App Price ///////////////////////

if(isset($_POST['update_price'])){
    update_app_price($conn);
}

function update_app_price($conn){

    $G_id=$_SESSION['id'];
    $basic_s_car_ser_petrol=$_POST['basic_s_car_ser_petrol'];
    $basic_h_car_ser_petrol=$_POST['basic_h_car_ser_petrol'];
    $basic_m_car_ser_petrol=$_POST['basic_m_car_ser_petrol'];
    $basic_se_car_ser_petrol=$_POST['basic_se_car_ser_petrol'];
    $basic_su_car_ser_petrol=$_POST['basic_su_car_ser_petrol'];
    $basic_pr_car_ser_petrol=$_POST['basic_pr_car_ser_petrol'];
    $basic_s1_car_ser_diesel=$_POST['basic_s1_car_ser_diesel'];
    $basic_s2_car_ser_diesel=$_POST['basic_s2_car_ser_diesel'];
    $basic_s3_car_ser_diesel=$_POST['basic_s3_car_ser_diesel'];
    $basic_s4_car_ser_diesel=$_POST['basic_s4_car_ser_diesel'];
    $basic_s5_car_ser_diesel=$_POST['basic_s5_car_ser_diesel'];

    $stand1=$_POST['stand1'];
    $stand2=$_POST['stand2'];
    $stand3=$_POST['stand3'];
    $stand4=$_POST['stand4'];
    $stand5=$_POST['stand5'];
    $stand6=$_POST['stand6'];
    $stand7=$_POST['stand7'];
    $stand8=$_POST['stand8'];
    $stand9=$_POST['stand9'];
    $stand10=$_POST['stand10'];
    $stand11=$_POST['stand11'];
    $stand12=$_POST['stand12'];
    $stand13=$_POST['stand13'];
    $stand14=$_POST['stand14'];
    $stand15=$_POST['stand15'];
    $stand16=$_POST['stand16'];
    $stand17=$_POST['stand17'];
    $stand18=$_POST['stand18'];
    $stand19=$_POST['stand19'];
    $stand20=$_POST['stand20'];
    $stand21=$_POST['stand21'];
    $stand22=$_POST['stand22'];

    $spa1=$_POST['spa1'];
    $spa2=$_POST['spa2'];
    $spa3=$_POST['spa3'];
    $spa4=$_POST['spa4'];
    $spa5=$_POST['spa5'];
    $spa6=$_POST['spa6'];

    $paint1=$_POST['paint1'];
    $paint2=$_POST['paint2'];
    $paint3=$_POST['paint3'];
    $paint4=$_POST['paint4'];
    $paint5=$_POST['paint5'];
    $paint6=$_POST['paint6'];
    
    $ac1=$_POST['ac1'];
    $ac2=$_POST['ac2'];
    $ac3=$_POST['ac3'];
    $ac4=$_POST['ac4'];
    $ac5=$_POST['ac5'];
    $ac6=$_POST['ac6'];
    $ac7=$_POST['ac7'];
    $ac8=$_POST['ac8'];
    $ac9=$_POST['ac9'];
    $ac10=$_POST['ac10'];
    $ac11=$_POST['ac11'];
    $ac12=$_POST['ac12'];

    $sql="UPDATE `app_price` SET `basic_s_car_ser_petrol`='$basic_s_car_ser_petrol',`basic_h_car_ser_petrol`='$basic_h_car_ser_petrol',`basic_m_car_ser_petrol`='$basic_m_car_ser_petrol',`basic_se_car_ser_petrol`='$basic_se_car_ser_petrol',`basic_su_car_ser_petrol`='$basic_su_car_ser_petrol',`basic_pr_car_ser_petrol`='$basic_pr_car_ser_petrol',
    `basic_s1_car_ser_diesel`='$basic_s1_car_ser_diesel',`basic_s2_car_ser_diesel`='$basic_s2_car_ser_diesel',`basic_s3_car_ser_diesel`='$basic_s3_car_ser_diesel',`basic_s4_car_ser_diesel`='$basic_s4_car_ser_diesel',`basic_s5_car_ser_diesel`='$basic_s5_car_ser_diesel',`stand1`='$stand1',`stand2`='$stand2',`stand3`='$stand3',`stand4`='$stand4',
    `stand5`='$stand5',`stand6`='$stand6',`stand7`='$stand7',`stand8`='$stand8',`stand9`='$stand9',`stand10`='$stand10',`stand11`='$stand11',`stand12`='$stand12',`stand13`='$stand13',`stand14`='$stand14',`stand15`='$stand15',`stand16`='$stand16',`stand17`='$stand17',`stand18`='$stand18',`stand19`='$stand19',`stand20`='$stand20',`stand21`='$stand21',
    `stand22`='$stand22',`spa1`='$spa1',`spa2`='$spa2',`spa3`='$spa3',`spa4`='$spa4',`spa5`='$spa5',`spa6`='$spa6',`paint1`='$paint1',`paint2`='$paint2',`paint3`='$paint3',`paint4`='$paint4',`paint5`='$paint5',`paint6`='$paint6',`ac1`='$ac1',`ac2`='$ac2',`ac3`='$ac3',`ac4`='$ac4',`ac5`='$ac5',`ac6`='$ac6',`ac7`='$ac7',`ac8`='$ac8',`ac9`='$ac9',
    `ac10`='$ac10',`ac11`='$ac11',`ac12`='$ac12' WHERE g_id='$G_id'";
    $res=mysqli_query($conn,$sql);
    if($res==1){
        header("Location:change_price.php"); 
    }else{
        echo "Error!!";
    }
}


?>