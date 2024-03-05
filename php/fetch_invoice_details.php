<?php
// Include database connection and any necessary functions
require_once 'db_connection.php';

// Check if invoice ID is provided
if (isset($_GET['id'])) {
    // Retrieve the invoice details from the database
    $invoice_id = $_GET['id'];
    $query = "SELECT * FROM application WHERE id = $invoice_id";
    $result = mysqli_query($con, $query);

    if ($result) {
        // Fetch the invoice details
        $invoice = mysqli_fetch_assoc($result);
        ?>
        <!-- HTML form to edit invoice details -->
        <form id="editInvoiceForm">
            <input type="hidden" name="invoice_id" value="<?php echo $invoice['id']; ?>">
            <div class="form-group">
                <label for="applicant_name">Applicant Name</label>
                <input type="text" class="form-control" id="applicant_name" name="applicant_name" value="<?php echo $invoice['applicant_name']; ?>">
            </div>
            <!-- Add more form fields for other invoice details -->
            <!-- For example: Date, Total Amount, etc. -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
        <?php
    } else {
        // Handle error if invoice details cannot be retrieved
        echo "Error: Unable to fetch invoice details.";
    }
} else {
    // Handle error if invoice ID is not provided
    echo "Error: Invoice ID not provided.";
}
?>
