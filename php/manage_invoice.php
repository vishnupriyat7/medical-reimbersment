<?php
if (isset($_GET["action"]) && $_GET["action"] == "delete") {
  require "db_connection.php";
  $invoice_number = $_GET["invoice_number"];
  $selappln = "SELECT * FROM application WHERE id = $invoice_number";
  $selqry = mysqli_query($con, $selappln);
  if ($selqry) {
    // Select bills related to the application
    $selbill = "SELECT * FROM bills WHERE application_id = $invoice_number";
    $selbillqry = mysqli_query($con, $selbill);

    if ($selbillqry) {
      // Loop through bills and delete related medicines_list records
      while ($row = mysqli_fetch_assoc($selbillqry)) {
        $bill_id = $row['id']; // Corrected column name
        $delmedicine = "DELETE FROM medicines_list WHERE bill_id = $bill_id";
        mysqli_query($con, $delmedicine);
      }
      // Delete bills related to the application
      $delBillQuery = "DELETE FROM bills WHERE application_id = $invoice_number";
      mysqli_query($con, $delBillQuery);
    }
    // Delete the application record
    $delAppQuery = "DELETE FROM application WHERE id = $invoice_number";
    mysqli_query($con, $delAppQuery);
    // Check if any rows were affected
    if (mysqli_affected_rows($con) > 0) {
      // echo "Invoice deleted successfully.";
      showInvoices();
    } else {
      echo "Error: Unable to delete invoice.";
    }
  } else {
    echo "Error: Unable to fetch application details.";
  }
  mysqli_close($con);
}
//   $delAppQuery = "DELETE FROM application WHERE id = $invoice_number";
//   mysqli_query($con, $delAppQuery);
// Check if any rows were affected
// var_dump($resultselappln);
//   if (!empty($result))
//     showInvoices();
// }
if (isset($_GET["action"]) && $_GET["action"] == "refresh")
  showInvoices();

if (isset($_GET["action"]) && $_GET["action"] == "search")
  searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);

// if (isset($_GET["action"]) && $_GET["action"] == "print_invoice")
//   printInvoice($_GET["invoice_number"]);
// printInvoice($_GET["id"]);


function showInvoices()
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT a.*, SUM(m.price) AS total_price FROM application a JOIN bills b ON a.id = b.application_id JOIN medicines_list m ON b.id = m.bill_id GROUP BY a.id";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      // var_dump($row['id']);
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}

function showInvoiceRow($seq_no, $row)
{
?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['applicant_name']; ?></td>
    <td><?php echo $row['date_from']; ?></td>
    <td><?php echo $row['date_to']; ?></td>
    <td><?php echo $row['total_price']; ?></td>

    <td>
      <!-- <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['id']; ?>);">
        <i class="fa fa-fax"></i>
      </button> -->
      <button href="" class="btn btn-info btn-sm" onclick="editInvoice(<?php echo $row['id']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteInvoice(<?php echo $row['id']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
<?php
}

function searchInvoice($text, $column)
{
  require "db_connection.php";
  if ($tag == "applno")
    $column = "id";
  if ($tag == "applcnt_name")
    $column = "applicant_name";

  if ($con) {
    $seq_no = 0;
    // $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE CAST(invoices.$column AS VARCHAR(9)) LIKE '%$text%'";
    $query = "SELECT * FROM application WHERE $column LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}


?>