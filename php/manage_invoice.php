<?php

if (isset($_GET["action"]) && $_GET["action"] == "delete") {
  require "db_connection.php";
  $invoice_number = $_GET["invoice_number"];
  $query = "DELETE FROM invoices WHERE INVOICE_ID = $invoice_number";
  $result = mysqli_query($con, $query);
  if (!empty($result))
    showInvoices();
}

if (isset($_GET["action"]) && $_GET["action"] == "refresh")
  showInvoices();

if (isset($_GET["action"]) && $_GET["action"] == "search")
  searchInvoice(strtoupper($_GET["text"]), $_GET["tag"]);

if (isset($_GET["action"]) && $_GET["action"] == "print_invoice")
  printInvoice($_GET["invoice_number"]);

function showInvoices()
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    // $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID";
    // $query = "SELECT ap.*,rl.* FROM application ap JOIN relation rl ON ap.relation_desig_id = rl.relation_id ORDER BY ap.id ASC";
    $query = "SELECT * FROM application a JOIN bills b ON a.id = b.application_id JOIN medicines_list m ON b.id = m.bill_id";

    $result = mysqli_query($con, $query);

    while ($row = mysqli_fetch_array($result)) {
      // var_dump($row);
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
    <td><?php echo $row['price']; ?></td>

    <td>
      <button class="btn btn-warning btn-sm" onclick="printInvoice(<?php echo $row['INVOICE_ID']; ?>);">
        <i class="fa fa-fax"></i>
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
  if ($con) {
    $seq_no = 0;
    if ($column == 'INVOICE_ID')
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE CAST(invoices.$column AS VARCHAR(9)) LIKE '%$text%'";
    else if ($column == "INVOICE_DATE")
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE invoices.$column = '$text'";
    else
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.ID WHERE UPPER(customers.$column) LIKE '%$text%'";

    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showInvoiceRow($seq_no, $row);
    }
  }
}

function printInvoice($invoice_number)
{
  require "db_connection.php";
  if ($con) {
    $query = "SELECT * FROM sales INNER JOIN customers ON sales.CUSTOMER_ID = customers.ID WHERE INVOICE_NUMBER = $invoice_number";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $customer_name = $row['NAME'];
    $address = $row['ADDRESS'];
    $contact_number = $row['CONTACT_NUMBER'];
    $doctor_name = $row['DOCTOR_NAME'];
    $doctor_address = $row['DOCTOR_ADDRESS'];

    $query = "SELECT * FROM invoices WHERE INVOICE_NUMBER = $invoice_number";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $invoice_date = $row['INVOICE_DATE'];
    $total_amount = $row['TOTAL_AMOUNT'];
    $total_discount = $row['TOTAL_DISCOUNT'];
    $net_total = $row['NET_TOTAL'];
  }

?>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/sidenav.css">
  <link rel="stylesheet" href="css/home.css">
  <div class="row">
    <div class="col-md-1"></div>
    <!-- <div class="col-md-10 h3" style="color: #ff5252;">Customer Invoice<span class="float-right">Invoice Number : <?php echo $invoice_number; ?></span></div> -->
    <div class="col-md-10 mt-5 text-center">
      <h3>ESSENTIALITY CERTIFICATE</h3>
      <h5>[Vide rule 2(f)(iii)and (vi) and rule 7(1)]</h5>
    </div>
  </div>
  <div class="row font-weight-bold">
    <div class="col-md-1"></div>
    <!-- <div class="col-md-10"><span class="h4 float-right">Invoice Date. : <?php echo $invoice_date; ?></span></div> -->
  </div>
  <div class="row text-center pr-1 pl-1">
    <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
  </div>
  <div class="row pr-1 pl-1">
    <div class="col-md-1"></div>
    <div class="col-md-4 text-justify">
      <!-- <span class="h4">Customer Details : </span><br><br>
      <span class="font-weight-bold">Name : </span><?php echo $customer_name; ?><br>
      <span class="font-weight-bold">Address : </span><?php echo $address; ?><br>
      <span class="font-weight-bold">Contact Number : </span><?php echo $contact_number; ?><br>
      <span class="font-weight-bold">Doctor's Name : </span><?php echo $doctor_name; ?><br>
      <span class="font-weight-bold">Doctor's Address : </span><?php echo $doctor_address; ?><br> -->
      <span class="fs-4 font-weight-normal font-monospace fw-normal lh-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Certified that the following Medicines/Vaccines/Sera/of this therapeutic
        substances prescribed to Smt. P. VASANTHAM w/o Sri. SATHYAN MOKERI
        Ex.M.L.A., the following material used in her treatment, the special nursing provided to
        her the following diagnostic and treatment methods applied in her case during
        aforementioned treatment, were essential for the recovery /for the prevention of serious
        deterioration in her condition and that the medicines do not include therapeutic
        substances ordinarily available in Government hospitals, the preparation which are
        primarily used as food, tonics, toilet or disinfectant and such costly drugs, tonics,
        laxatives and other elegant and proprietary preparations for which, drugs of equal
        therapeutic value are available. Certified also that among the fees claimed below the fees
        for administering injections and the fees paid to the nurses for having attended to her at
        residence are not included.</span>
    </div>
    <div class="col-md-3"></div>

    <?php

    $query = "SELECT * FROM admin_credentials";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    $p_name = $row['PHARMACY_NAME'];
    $p_address = $row['ADDRESS'];
    $p_email = $row['EMAIL'];
    $p_contact_number = $row['CONTACT_NUMBER'];
    ?>

    <div class="col-md-4">
      <!-- <span class="h4">Shop Details : </span><br><br>
      <span class="font-weight-bold"><?php echo $p_name; ?></span><br>
      <span class="font-weight-bold"><?php echo $p_address; ?></span><br>
      <span class="font-weight-bold"><?php echo $p_email; ?></span><br>
      <span class="font-weight-bold">Mob. No.: <?php echo $p_contact_number; ?></span> -->
    </div>
    <div class="col-md-1"></div>
  </div>
  <div class="row text-center pr-1 pl-1">
    <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
  </div>

  <div class="row pr-1 pl-1">
    <div class="col-md-1"></div>
    <div class="col-md-10 table-responsive">
      <table class="table table-bordered table-striped table-hover" id="purchase_report_div">
        <thead>
          <tr>
            <!-- <th>SL</th>
            <th>Medicine Name</th>
            <th>Expiry Date</th>
            <th>Quantity</th>
            <th>MRP</th>
            <th>Discount</th>
            <th>Total</th> -->
            <th style="width: 5%;">Sl.No</th>
            <th style="width: 10%;">Bill No</th>
            <th style="width: 10%;">Bill Date</th>
            <th style="width: 20%;">Medicine Name</th>
            <th style="width: 25%;">Chemical/Pharmacological Name</th>
            <th style="width: 10%;">Price</th>
            <th style="width: 10%;">Bill Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $seq_no = 0;
          $total = 0;
          // $query = "SELECT * FROM sales WHERE INVOICE_NUMBER = $invoice_number";
          $query = "SELECT * FROM application a JOIN bills b ON a.id = b.application_id JOIN medicines_list ml ON b.id = ml.bill_id JOIN medicines m ON m.id = ml.medicine_id";   
          $result = mysqli_query($con, $query);
          while ($row = mysqli_fetch_array($result)) {
            $seq_no++;
          ?>
            <tr>
              <td><?php echo $seq_no; ?></td>
              <td><?php echo $row['bill_no']; ?></td>
              <td><?php echo $row['bill_date']; ?></td>
              <td><?php echo $row['NAME']; ?></td>
              <td><?php echo $row['GENERIC_NAME']; ?></td>
              <!-- <td><?php echo $row['DISCOUNT'] . "%"; ?></td> -->
              <td><?php echo $row['price']; ?></td>
              <td><?php echo $row['TOTAL']; ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
        <tfoot class="font-weight-bold">
          <!-- <tr style="text-align: right; font-size: 18px;">
            <td colspan="6">&nbsp;Total Amount</td>
            <td><?php echo $total_amount; ?></td>
          </tr>
          <tr style="text-align: right; font-size: 18px;">
            <td colspan="6">&nbsp;Total Discount</td>
            <td><?php echo $total_discount; ?></td>
          </tr> -->
          <tr style="text-align: right; font-size: 22px;">
            <td colspan="6" style="color: green;">&nbsp;Net Amount</td>
            <td class="text-primary"><?php echo $net_total; ?></td>
          </tr>
        </tfoot>
      </table>
    </div>
    <div class="col-md-1"></div>
  </div>
  <div class="row text-center">
    <hr class="col-md-10" style="padding: 0px; border-top: 2px solid  #ff5252;">
  </div>
<?php
}

?>