var rows = 0;

class MedicineInfo {
  constructor(name, chemical_name, price, remark) {
    this.name = name;
    this.chemical_name = chemical_name;
    this.price = price;
    this.remark = remark;
  }
}

function addRow() {
  if (typeof addRow.counter == 'undefined')
    addRow.counter = 1;
  var previous = document.getElementById("invoice_medicine_list_div").innerHTML;
  var node = document.createElement("div");
  var cls = document.createAttribute("id");
  var cls1 = document.createAttribute("class");
  cls.value = "medicine_row_" + addRow.counter;
  cls1.value = "row col col-md-12";
  node.setAttributeNode(cls);
  node.setAttributeNode(cls1);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200) {
      node.innerHTML = xhttp.responseText;
      document.getElementById("invoice_medicine_list_div").appendChild(node);
    }
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=add_row&row_id=" + cls.value + "&row_number=" + addRow.counter, true);
  xhttp.send();
  addRow.counter++;
  rows++;
}

function removeRow(row_id) {
  if (rows == 1)
    alert("Can't delete only one row is there!");
  else {
    document.getElementById(row_id).remove();
    rows--;
  }
}

function medicineOptions(text, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(id).innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=medicine_list&text=" + text.trim(), true);
  xhttp.send();
}

function applicationOptions(text, id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(id).innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=application_list&text=" + text.trim(), true);
  xhttp.send();
}

function fillFields(medicine_name, id) {
  fill(medicine_name, 'chemical_' + id, 'GENERIC_NAME');
  document.getElementById("medicine_name_" + id).blur();
}

function fill(name, field_name, column) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById(field_name).value = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=fill&name=" + name + "&column=" + column, false);
  xhttp.send();
}

function getTotal(id) {
  var parent = document.getElementById('invoice_medicine_list_div');
  var row_count = parent.childElementCount;
  var medicine_info = parent.children;
  var total_amount = 0;
  for (var i = 1; i < row_count; i++) {
    mrp = Number.parseFloat(medicine_info[i].children[2].children[0].value);
    total_amount += mrp;
  }
  document.getElementById("total_amount").value = total_amount;
}

function checkAvailableQuantity(value, id) {
  var medicine_name = document.getElementById("medicine_name_" + id).value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=check_quantity&medicine_name=" + medicine_name, false);
  xhttp.send();
  if (Number.parseInt(xhttp.responseText) == 0) {
    document.getElementById("medicine_name_error_" + id).style.display = "block";
    document.getElementById("medicine_name_error_" + id).innerHTML = "Out of Stock!";
    return -1;
  }
  else if (value > Number.parseInt(xhttp.responseText)) {
    document.getElementById("quantity_error_" + id).style.display = "block";
    document.getElementById("quantity_error_" + id).innerHTML = "only " + xhttp.responseText + " in stock!";
    return -2;
  }
  return 999;
}

function getChange(paid_amt) {
  var net_total = document.getElementById("net_total").value;
  document.getElementById("change_amt").value = paid_amt - net_total;
}

function isCustomer(name, contact_number) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=is_customer&name=" + name + "&contact_number=" + contact_number, false);
  xhttp.send();
}

function isBill(bill_no, bill_dt) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=is_bill&name=" + name + "&contact_number=" + contact_number, false);
  xhttp.send();
  return xhttp.responseText;
} return xhttp.responseText;

function isInvoiceExist(invoice_number) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=is_invoice&invoice_number=" + invoice_number, false);
  xhttp.send();
  return xhttp.responseText;
}

function isMedicine(name) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=is_medicine&name=" + name, false);
  xhttp.send();
  return xhttp.responseText;
}

function addInvoice() {
  var aplcnno = document.getElementById('application_no');
  var billno = document.getElementById('bill_no');
  var billdate = document.getElementById('bill_dt');
  if (!notNull(billno.value, "bill_no"))
    billno.focus();
  else if (isInvoiceExist(billno.value) == "true")
    document.getElementById("invoice_acknowledgement").innerHTML = "Alreay saved Invoice!";
  else if (!checkDate(billdate.value, 'date_error')) {
    billdate.focus();
  } else {
    var parent = document.getElementById('invoice_medicine_list_div');
    var row_count = parent.childElementCount;
    var medicine_info = parent.children;
    var medicines = new Array(row_count - 1);
    for (var i = 1; i < row_count; i++) {
      var elements_count = medicine_info[i].childElementCount;
      var elements = medicine_info[i].children;
      var medicine_name = elements[0].children[0];
      var medicine_name_error = elements[0].children[1];
      var chemical_name = elements[1].children[0];
      var price = elements[2].children[0];
      var remark = elements[3].children[0];
      var total_amount = document.getElementById("total_amount");
      var flag = false;
      if (!notNull(medicine_name.value, medicine_name_error.getAttribute('id')))
        medicine_name.focus();

      else if (isMedicine(medicine_name.value) == "false") {
        medicine_name_error.style.display = "block";
        medicine_name_error.innerHTML = "Medicine doesn't exists!";
        medicine_name.focus();
      }
      else {
        flag = true;
        medicines[i - 1] = new MedicineInfo(medicine_name.value, chemical_name.value, price.value, remark.value);
      }
      console.log(medicines);
      if (!flag)
        return false;
    }
    addNewInvoice(aplcnno.value, billno.value, billdate.value, medicines);
    document.getElementById("save_button").style.display = "none";
    document.getElementById("new_invoice_button").style.display = "block";
    document.getElementById("print_button").style.display = "block";
  }
  return false;
}

function updateStock(name, batch_id, quantity) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=update_stock&name=" + name + "&batch_id=" + batch_id + "&quantity=" + quantity, true);
  xhttp.send();
}

function addSale(customers_name, customers_contact_number, invoice_number, medicine_name, batch_id, expiry_date, quantity, mrp, discount, total) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=add_sale&customers_name=" + customers_name + "&customers_contact_number=" + customers_contact_number + "&invoice_number=" + invoice_number + "&medicine_name=" + medicine_name + "&batch_id=" + batch_id + "&expiry_date=" + expiry_date + "&quantity=" + quantity + "&mrp=" + mrp + "&discount=" + discount + "&total=" + total, true);
  xhttp.send();
}

function addNewInvoice(aplcn_no, bill_no, bill_dt, list_medicine) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState = 4 && xhttp.status == 200)
      document.getElementById("invoice_acknowledgement").innerHTML = xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_invoice.php?action=add_new_invoice&app_no=" + aplcn_no + "&bill_no=" + bill_no + "&bill_dt=" + bill_dt + "&bill_med=" + JSON.stringify(list_medicine), true);
  xhttp.send();
}
