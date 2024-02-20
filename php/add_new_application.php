<?php



if (isset($_GET['action']) && $_GET['action'] == "add_new_application")
    addNewApplication();



function addNewApplication()
{
    //   $customer_id = getCustomerId(strtoupper($_GET['customers_name']), $_GET['customers_contact_number']);
    //   $invoice_date = $_GET['invoice_date'];
    //      $payment_status = ($_GET['payment_type'] == "");
    //   $total_amount = $_GET['total_amount'];
    //   $total_discount = $_GET['total_discount'];
    //   $net_total = $_GET['net_total'];
    // $aplctn_id = $_GET['id'];
    $doctor_name = $_GET['doctor_name'];
    $applicant_name = $_GET['applicant_name'];
    $relative_name = $_GET['relative_name'];
    $relation = $_GET['relation'];
    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
    $date = date("Y-m-d H:i:s");

    require "db_connection.php";
    if ($con) {
        // $query = "INSERT INTO application (CUSTOMER_ID, INVOICE_DATE, TOTAL_AMOUNT, TOTAL_DISCOUNT, NET_TOTAL) VALUES($customer_id, '$invoice_date', $total_amount, $total_discount, $net_total)";
        $query = "INSERT INTO application (applicant_name, relative_name, relation_desig_id, doctor, date_from, date_to, updated_date, status) VALUES('$applicant_name', '$relative_name', '$relation', '$doctor_name', '$date_from', '$date_to', '$date', 0)";
        // var_dump($query);

        $result = mysqli_query($con, $query);
        echo ($result) ? "Application saved..." : "falied to save Application...";
    }
}
