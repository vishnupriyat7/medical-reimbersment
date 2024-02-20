<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>New Application</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/suggestions.js"></script>
    <script src="js/add_new_application.js"></script>
    <script src="js/manage_invoice.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
</head>

<body>
    <div id="add_new_customer_model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ff5252; color: white">
                    <div class="font-weight-bold">Add New Customer</div>
                    <button class="close" style="outline: none;" onclick="document.getElementById('add_new_customer_model').style.display = 'none';"><i class="fa fa-close"></i></button>
                </div>
                <div class="modal-body">
                    <?php
                    include('sections/add_new_customer.html');
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
        <div class="container">

            <!-- header section -->
            <?php
            require "php/header.php";
            createHeader('clipboard', 'New Application', 'Create New Application');
            ?>
          

            <!-- header section end -->

            <!-- form content -->
            <div class="row">
                <!-- customer details content -->
                <!-- <div class="row col col-md-12">
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="customers_name">Customer Name :</label>
                        <input id="customers_name" type="text" class="form-control" placeholder="Customer Name" name="customers_name" onkeyup="showSuggestions(this.value, 'customer');">
                        <code class="text-danger small font-weight-bold float-right" id="customer_name_error" style="display: none;"></code>
                        <div id="customer_suggestions" class="list-group position-fixed" style="z-index: 1; width: 18.30%; overflow: auto; max-height: 200px;"></div>
                    </div>
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="customers_address">Address :</label>
                        <input id="customers_address" type="text" class="form-control" name="customers_address" placeholder="Address" disabled>
                    </div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="invoice_number">Invoice Number :</label>
                        <input id="invoice_number" type="text" class="form-control" name="invoice_number" placeholder="Invoice Number" disabled>
                    </div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="">Payment Type :</label>
                        <select id="payment_type" class="form-control">
                            <option value="1">Cash Payment</option>
                            <option value="2">Card Payment</option>
                            <option value="3">Net Banking</option>
                        </select>
                    </div>
                    <div class="col col-md-2 form-group">
                        <label class="font-weight-bold" for="">Date :</label>
                        <input type="date" class="datepicker form-control hasDatepicker" id="invoice_date" value='<?php echo date('Y-m-d'); ?>' onblur="checkDate(this.value, 'date_error');">
                        <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
                    </div>
                </div> -->

                <!-- Applicant details content -->
                <div class="row col col-md-12">
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="doctor_name">Doctor Name :</label>
                        <input id="doctor_name" type="text" class="form-control" name="doctor_name" placeholder="Doctor Name">
                    </div>
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="applicant_name">Applicant Name :</label>
                        <input id="applicant_name" type="text" class="form-control" placeholder="Applicant Name" name="applicant_name" onkeyup="showSuggestions(this.value, 'customer');">
                        <!-- <code class="text-danger small font-weight-bold float-right" id="customer_name_error" style="display: none;"></code>
                        <div id="customer_suggestions" class="list-group position-fixed" style="z-index: 1; width: 18.30%; overflow: auto; max-height: 200px;"></div> -->
                    </div>

                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="relative_name">Relative Name :</label>
                        <input id="relative_name" type="text" class="form-control" name="relative_name" placeholder="Relative Name">
                    </div>

                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="">Relation / Designation :</label>
                        <select id="relation_type" class="form-control">
                            <option value="0">Select</option>
                            <option value="1">MLA</option>
                            <option value="2">ExMLA</option>
                            <option value="3">Spouse/O</option>
                            <option value="4">S/O</option>
                            <option value="5">D/O</option>

                        </select>
                    </div>
                </div>

                <div class="row col col-md-12">

                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="">Date From :</label>
                        <input type="date" class="datepicker form-control hasDatepicker" id="from_date" value='<?php echo date('Y-m-d'); ?>'>
                        <!-- <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code> -->
                    </div>
                    <div class="col col-md-3 form-group">
                        <label class="font-weight-bold" for="">Date To :</label>
                        <input type="date" class="datepicker form-control hasDatepicker" id="to_date" value='<?php echo date('Y-m-d'); ?>'>
                        <!-- <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code> -->
                    </div>
                </div>
                <!-- Applicant details content end -->

                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px; border-top: 3px solid  #02b6ff;">
                </div>

                <div class="col col-md-12">
                    <hr class="col-md-12" style="padding: 0px;">
                </div>

                <div class="row col col-md-12">
                    <div id="save_button" class="col col-md-2 form-group float-right">
                        <label class="font-weight-bold" for=""></label>
                        <button class="btn btn-success form-control font-weight-bold" onclick="addApplicant();">Save</button>
                    </div>

                    <div class="alert alert-success" role="alert" style="display: none;" id="apl_save_succes">
                        Application Saved Successfully!... with Application Number <?php echo $_POST['id']; ?>
                    </div>

                    <!-- <div id="new_invoice_button" class="col col-md-2 form-group float-right" style="display: none;">
                        <label class="font-weight-bold" for=""></label>
                        <button class="btn btn-primary form-control font-weight-bold" onclick="location.reload();;">New Invoice</button>
                    </div>
                    <div id="print_button" class="col col-md-2 form-group float-right" style="display: none;">
                        <label class="font-weight-bold" for=""></label>
                        <button class="btn btn-warning form-control font-weight-bold" onclick="printInvoice(document.getElementById('invoice_number').value);">Print</button>
                    </div> -->
                    <div class="col col-md-4 form-group"></div>

                </div>
            </div>
            <!-- form content end -->
            <hr style="border-top: 2px solid #ff5252;">
        </div>
    </div>
</body>

</html>