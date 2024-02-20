

// function addInvoice() {
//   // save invoice
//   var customers_name = document.getElementById('customers_name');
//   var customers_contact_number = document.getElementById('customers_contact_number');
//   var invoice_number = document.getElementById('invoice_number');
//   var payment_type = document.getElementById('payment_type');
//   var invoice_date = document.getElementById('invoice_date');
//   //alert(invoice_number.value);

//   if(!notNull(customers_name.value, "customer_name_error"))
//     customers_name.focus();
//   else if(isCustomer(customers_name.value, customers_contact_number.value) == "false") {
//     document.getElementById("customer_name_error").style.display = "block";
//     document.getElementById("customer_name_error").innerHTML = "Customer doesn't exists!";
//     customers_name.focus();
//   }
//   else if(isInvoiceExist(invoice_number.value) == "true")
//     document.getElementById("invoice_acknowledgement").innerHTML = "Alreay saved Invoice!";
//   else if(!checkDate(invoice_date.value, 'date_error'))
//     invoice_date.focus();
//   else {
//     var parent = document.getElementById('invoice_medicine_list_div');
//     var row_count = parent.childElementCount;
//     var medicine_info = parent.children;

//     var medicines = new Array(row_count-1);
//     for(var i = 1; i < row_count; i++) {
//       //alert(i);
//       var elements_count = medicine_info[i].childElementCount;
//       var elements = medicine_info[i].children;

//       var medicine_name = elements[0].children[0].children[0];
//       var medicine_name_error = elements[0].children[0].children[1];

//       //var packing = elements[0].children[1].children[0];
//       //var pack_error = elements[0].children[1].children[1];

//       var batch_id = elements[0].children[1].children[0];
//       //var batch_id_error = elements[0].children[2].children[1];

//       var expiry_date = elements[0].children[3].children[0];
//       //var expiry_date_error = elements[0].children[3].children[1];

//       var quantity = elements[0].children[4].children[0];
//       var quantity_error = elements[0].children[4].children[1];

//       var mrp = elements[0].children[5].children[0];
//       //var mrp_error = elements[0].children[5].children[1];

//       var discount = elements[0].children[6].children[0];
//       var discount_error = elements[0].children[6].children[1];

//       var total = elements[0].children[7].children[0];

//       var total_amount = document.getElementById("total_amount");
//       var total_discount = document.getElementById("total_discount");
//       var net_total = document.getElementById("net_total");

//       var flag = false;
//       //alert(quantity.getAttribute('id').slice(9, 10));

//       //alert(medicine_name.value + " " + batch_id.value + " " + expiry_date.value + " " + quantity.value + " " + mrp.value + " " + discount.value + " " +total.value);
//       var isAvailable = checkAvailableQuantity(quantity.value, quantity.getAttribute('id').slice(9, 10))
//       //alert(medicine_name.value);
//       if(!notNull(medicine_name.value, medicine_name_error.getAttribute('id')))
//         medicine_name.focus();

//       else if(isMedicine(medicine_name.value) == "false") {
//         medicine_name_error.style.display = "block";
//         medicine_name_error.innerHTML = "Medicine doesn't exists!";
//         medicine_name.focus();
//       }

//       else if(!checkExpiry(expiry_date.value, medicine_name_error.getAttribute('id')) || checkExpiry(expiry_date.value, medicine_name_error.getAttribute('id')) == -1)
//         medicine_name.focus();

//       else if(isAvailable == -1) {
//         medicine_name_error.style.display = "block";
//         medicine_name.focus();
//       }

//       else if(!checkQuantity(quantity.value, quantity_error.getAttribute('id')))
//         quantity.focus();

//       else if(quantity.value == 0) {
//         quantity_error.style.display = "block";
//         quantity_error.innerHTML = "Increase quantity or remover row!";
//         quantity.focus();
//       }

//       else if(isAvailable == -2) {
//         quantity_error.style.display = "block";
//         quantity.focus();
//       }

//       else if(!checkValue(discount.value, discount_error.getAttribute('id')))
//         discount.focus();

//       else {
//         flag = true;
//         //alert("row " + i + "perfect...");
//         medicines[i-1] = new MedicineInfo(medicine_name.value, batch_id.value, expiry_date.value, quantity.value, mrp.value, discount.value, total.value);
//       }

//       if(!flag)
//         return false;
//     }

//     for(var i = 0; i < row_count - 1; i++) {
//       updateStock(medicines[i].name, medicines[i].batch_id, medicines[i].quantity);
//       addSale(customers_name.value, customers_contact_number.value, invoice_number.value, medicines[i].name, medicines[i].batch_id, medicines[i].expiry_date, medicines[i].quantity, medicines[i].mrp, medicines[i].discount, medicines[i].total);
//     }
//     addNewInvoice(customers_name.value, customers_contact_number.value, invoice_date.value, total_amount.value, total_discount.value, net_total.value);
//     document.getElementById("save_button").style.display = "none";
//     document.getElementById("new_invoice_button").style.display = "block";
//     document.getElementById("print_button").style.display = "block";
//   }
//   return false;
// }

// function updateStock(name, batch_id, quantity) {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if(xhttp.readyState = 4 && xhttp.status == 200)
//       xhttp.responseText;
//         //alert("Stock result : " + xhttp.responseText);
//   };
//   xhttp.open("GET", "php/add_new_invoice.php?action=update_stock&name=" + name + "&batch_id=" + batch_id + "&quantity=" + quantity, true);
//   xhttp.send();
// }

// function addSale(customers_name, customers_contact_number, invoice_number, medicine_name, batch_id, expiry_date, quantity, mrp, discount, total) {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if(xhttp.readyState = 4 && xhttp.status == 200)
//       xhttp.responseText;
//       //alert("Sales result : " + xhttp.responseText);
//   };
//   xhttp.open("GET", "php/add_new_invoice.php?action=add_sale&customers_name=" + customers_name + "&customers_contact_number=" + customers_contact_number + "&invoice_number=" + invoice_number + "&medicine_name=" + medicine_name + "&batch_id=" + batch_id + "&expiry_date=" + expiry_date +  "&quantity=" + quantity + "&mrp=" + mrp + "&discount=" + discount + "&total=" + total, true);
//   xhttp.send();
// }

// function addNewInvoice(customers_name, customers_contact_number, invoice_date, total_amount, total_discount, net_total) {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if(xhttp.readyState = 4 && xhttp.status == 200)
//       document.getElementById("invoice_acknowledgement").innerHTML =  xhttp.responseText;
//   };
//   xhttp.open("GET", "php/add_new_invoice.php?action=add_new_invoice&customers_name=" + customers_name + "&customers_contact_number=" + customers_contact_number + "&invoice_date=" + invoice_date + "&total_amount=" + total_amount + "&total_discount=" + total_discount + "&net_total=" + net_total, true);
//   xhttp.send();
// }

function addApplicant() {
  // save invoice
  var doctor_name = document.getElementById('doctor_name');
  // alert(doctor_name.value);
  var applicant_name = document.getElementById('applicant_name');
  // alert(applicant_name.value);
  var relative_name = document.getElementById('relative_name');
  var relation = document.getElementById('relation_type');
  var date_from = document.getElementById('from_date');
  var date_to = document.getElementById('to_date');
 
  //alert(invoice_number.value);

  
  addNewApplication(doctor_name.value, applicant_name.value, relative_name.value, relation.value, date_from.value, date_to.value);
    // document.getElementById("save_button").style.display = "none";
    document.getElementById("apl_save_succes").style.display = "block";
    // document.getElementById("print_button").style.display = "block";
  
  return false;
}


function addNewApplication(doctor_name, applicant_name, relative_name, relation, date_from, date_to) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if(xhttp.readyState = 4 && xhttp.status == 200)
     xhttp.responseText;
  };
  xhttp.open("GET", "php/add_new_application.php?action=add_new_application&doctor_name=" + doctor_name + "&applicant_name=" + applicant_name + "&relative_name=" + relative_name + "&relation=" + relation + "&date_from=" + date_from + "&date_to=" + date_to, true);
  xhttp.send();
}


