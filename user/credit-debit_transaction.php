<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$pageName = "Credit Debit Transaction";
//session_start();
// include_once("layouts/tranheader.php");
const rootDir = "/home/multistream6/domains/dashboard.trustwaveunion.online/public_html/";
include_once(rootDir . "user/layouts/header.php");

//require_once("../include/config.php");

//require_once("../include/userFunction.php");
//require_once('../include/userClass.php');
//$conn = dbConnect();
//$acct_id = userDetails('id');
// $crypto_name = cryptoName('crypto_name');



if (!$_SESSION['acct_no']) {
    header("location:../login.php");
    die;
}

//get user acct details
$get_acct_details_q = "SELECT * FROM users WHERE id = :acct_user_id";
$wire = $conn->prepare($get_acct_details_q); // Use $get_acct_details_q instead of $sql2
$wire->execute(['acct_user_id' => $row['id']]);
$result = $wire->fetch(PDO::FETCH_ASSOC);
$acct_id = $result['id'];
?>
    <div id="content" class="main-content">
    <div class="layout-px-spacing">
    <div class="row layout-top-spacing" id="cancel-row">

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <table id="default-ordering" class="table table-hover" style="width:100%">

                <thead>
                <tr>
                    <th>S/N</th>
                    <th>AMOUNT</th>
                    <th>TYPE</th>
                    <th>SENDER / RECEIVER</th>
                    <th>DESCRIPTION</th>
                    <th>CREATED AT</th>
                    <th>TIME CREATED</th>
                    <th>STATUS</th>
                </tr>
                </thead>
                <tbody>


                <?php

                $sql="SELECT * FROM transactions LEFT JOIN users ON transactions.user_id =users.id WHERE transactions.user_id =:acct_id order by transactions.trans_id DESC";
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'acct_id'=>$acct_id
                ]);



                $sn=1;

                while ($result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $transStatus = transStatus($result);

                    if($result['trans_type'] === '1'){
                        $trans_type = "<span class='text-success'>Credit</span>";
                    }else if($result['trans_type']=== '2'){
                        $trans_type = "<span class='text-danger'>Debit</span>
";
                    }
                    ?>
                    <tr>
                        <td><?= $sn++ ?></td>
                        <td><?=$currency. $result['amount'] ?></td>
                        <td><?= $trans_type ?></td>
                        <td><?= $result['sender_name'] ?></td>
                        <td><?=$result['description'] ?></td>
                        <td><?= $result['created_at'] ?></td>
                        <td><?= $result['time_created'] ?></td>
                        <!--<td><?= $transStatus ?></td>-->
                        <td>Completed</td>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>S/N</th>
                    <th>AMOUNT</th>
                    <th>TYPE</th>
                    <th>SENDER / RECEIVER</th>
                    <th>DESCRIPTION</th>
                    <th>CREATED AT</th>
                    <th>TIME CREATED</th>
                    <th>STATUS</th>
                </tr>
                </tfoot>
            </table>
            
            <div class="d-print-none">
                                    <div class="float-end">
                                        <a href="javascript:window.print()"
                                            class="btn btn-success waves-effect waves-light me-1"><i
                                                class="fa fa-print"></i> Print Statement</a>
                                    </div>
                                </div>
        </div>
    </div>


<?php
include_once("layouts/footer.php");
?>