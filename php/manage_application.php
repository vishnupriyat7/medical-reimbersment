<?php
require "db_connection.php";
if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id = $_GET["id"];
    $query = "DELETE FROM application WHERE id = $id";
    $result = mysqli_query($con, $query);
    if (!empty($result))
      showApplictndtls(0);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id = $_GET["id"];
    showApplictndtls($id);
  }

  // if(isset($_GET["action"]) && $_GET["action"] == "update") {
  //   $id = $_GET["id"];
  //   $name = ucwords($_GET["name"]);
  //   $packing = strtoupper($_GET["packing"]);
  //   $generic_name = ucwords($_GET["generic_name"]);
  //   $suppliers_name = ucwords($_GET["suppliers_name"]);
  //   updateMedicine($id, $name, $packing, $generic_name, $suppliers_name);
  // }
  if (isset($_GET["action"]) && $_GET["action"] == "update") {
    $id = $_GET["id"];
    // var_dump($id);
    $doctor_name = $_GET["doctor"];
    // var_dump($doctor_name);
    $aplicant_name = $_GET["applicant"];
    // var_dump($aplicant_name);
    $relative_name = $_GET["relative"];
    // var_dump($relative_name);
    $relation_desg = $_GET["relation"];
    // var_dump($relation_desg);
    $date_from = $_GET["datefrom"];
    // var_dump($date_from);
    $date_to = $_GET["dateto"];
    // var_dump($date_to);
    $date_updtd = date("Y-m-d H:i:s");
    // var_dump($date_updtd);
    updateApplication($id, $doctor_name, $aplicant_name, $relative_name, $relation_desg, $date_from, $date_to, $date_updtd);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showApplictndtls(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchApplcn(strtoupper($_GET["text"]), $_GET["tag"]);
}

function showApplictndtls($id)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    // $query = "SELECT * FROM application";

    $query = "SELECT ap.*,rl.* FROM application ap JOIN relation rl ON ap.relation_desig_id = rl.relation_id ORDER BY ap.id ASC";
    $result = mysqli_query($con, $query);
    // var_dump($result);die;
    while ($row = mysqli_fetch_array($result)) {
      // var_dump($row);die;
      $seq_no++;
      if ($row['id'] == $id)
        showEditOptionsRow($seq_no, $row);
      else
        showApplcnRow($seq_no, $row);
    }
  }
}

function showApplcnRow($seq_no, $row)
{
?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['doctor']; ?></td>
    <td><?php echo $row['applicant_name']; ?></td>
    <td><?php echo $row['relative_name']; ?></td>
    <td><?php echo $row['relation']; ?></td>
    <td><?php echo $row['date_from']; ?></td>
    <td><?php echo $row['date_to']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editApplication(<?php echo $row['id']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteApplication(<?php echo $row['id']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
<?php
}

function showEditOptionsRow($seq_no, $row)
{
?>
  <!-- <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['NAME']; ?>" placeholder="Medicine Name" id="medicine_name" onblur="notNull(this.value, 'medicine_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="medicine_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['PACKING']; ?>" placeholder="Packing" id="packing" onblur="notNull(this.value, 'pack_error');">
      <code class="text-danger small font-weight-bold float-right" id="pack_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['GENERIC_NAME']; ?>" placeholder="Generic Name" id="generic_name" onblur="notNull(this.value, 'generic_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="generic_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['SUPPLIER_NAME']; ?>" placeholder="Supplier Name" id="suppliers_name" onblur="notNull(this.value, 'supplier_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="supplier_name_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateMedicine(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr> -->

  <tr>
    <td><?php echo $seq_no; ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['id']; ?>" placeholder="Application No" id="appln_no" onblur="notNull(this.value, 'appln_no_error');" disabled>
      <code class="text-danger small font-weight-bold float-right" id="appln_no_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['doctor']; ?>" placeholder="Doctor Name" id="doctor" onblur="notNull(this.value, 'doctor_error');">
      <code class="text-danger small font-weight-bold float-right" id="doctor_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['applicant_name']; ?>" placeholder="Applicant Name" id="aplicant_name" onblur="notNull(this.value, 'aplicant_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="aplicant_name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['relative_name']; ?>" placeholder="Relative Name" id="relative_name" onblur="notNull(this.value, 'relative_name_error');">
      <code class="text-danger small font-weight-bold float-right" id="relative_name_error" style="display: none;"></code>
    </td>
    <!-- <td>
      <input type="text" class="form-control" value="<?php echo $row['relation']; ?>" placeholder="Relation / Designation" id="relation_desg" onblur="notNull(this.value, 'relation_desg_error');">
      <code class="text-danger small font-weight-bold float-right" id="relation_desg_error" style="display: none;"></code>
    </td> -->
    <td>
      <?php 
       require "db_connection.php";
       $relSelQry = "SELECT * FROM relation"; 
      $relResult = mysqli_query($con, $relSelQry);
      ?>
      <select id="relation_desg" class="form-control" placeholder="Relation / Designation" onblur="notNull(this.value, 'relation_desg_error');">
      <option value="0">Select</option>
      <?php while ($relation = mysqli_fetch_array($relResult)) { ?>       
        <option value="<?= $relation[0]?>" <?php echo $row['relation_id'] == $relation[0] ? 'Selected' : '';  ?>><?= $relation[1] ?></option>
      <?php } ?>
      </select>
    </td>
    <td>
      <input type="text" class="datepicker form-control hasDatepicker" value="<?php echo $row['date_from']; ?>" placeholder="Date From" id="date_from" onblur="notNull(this.value, 'date_from_error');">
      <code class="text-danger small font-weight-bold float-right" id="date_from_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="datepicker form-control hasDatepicker" value="<?php echo $row['date_to']; ?>" placeholder="Date To" id="date_to" onblur="notNull(this.value, 'date_to_error');">
      <code class="text-danger small font-weight-bold float-right" id="date_to_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateApplication(<?php echo $row['id']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
<?php
}

// function updateMedicine($id, $name, $packing, $generic_name, $suppliers_name) {
//   require "db_connection.php";
//   $query = "UPDATE medicines SET NAME = '$name', PACKING = '$packing', GENERIC_NAME = '$generic_name', SUPPLIER_NAME = '$suppliers_name' WHERE ID = $id";
//   $result = mysqli_query($con, $query);
//   if(!empty($result))
//     showApplictndtls(0);
// }

function updateApplication($id, $doctor_name, $aplicant_name, $relative_name, $relation_desg, $date_from, $date_to, $date_updtd)
{
  require "db_connection.php";
  $query = "UPDATE  application SET doctor='$doctor_name', applicant_name ='$aplicant_name', relative_name ='$relative_name', relation_desig_id= '$relation_desg', date_from = '$date_from', date_to = '$date_to', updated_date = '$date_updtd' WHERE id = $id";
  // var_dump($query);
  $result = mysqli_query($con, $query);
  // var_dump($result);die;
  // if (!empty($result))
    showApplictndtls(0);
}

function searchApplcn($text, $tag)
{
  require "db_connection.php";
  if ($tag == "applno")
    $column = "id";
  if ($tag == "applcnt_name")
    $column = "applicant_name";
  // if($tag == "suppliers_name")
  //   $column = "SUPPLIER_NAME";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM application WHERE $column LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showApplcnRow($seq_no, $row);
    }
  }
}

?>