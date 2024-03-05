<?php

if (isset($_GET['action']) && $_GET['action'] == "add_new_application")
    addNewApplication();


function addNewApplication()
{

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
        // var_dump($result);
        // echo ($result) ? "Application saved..." : "falied to save Application...";

        if ($result) {
            // Get the last inserted ID
            $application_number = mysqli_insert_id($con);
            // Close the statement
            mysqli_stmt_close($statement);

            echo json_encode(array("success" => true, "application_number" => $application_number));
        } else {
            echo json_encode(array("success" => false, "message" => "Failed to save application"));
        }

        // Close the database connection
        mysqli_close($con);
    }
}
