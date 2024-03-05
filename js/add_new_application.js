function addApplicant() {
  var doctor_name = document.getElementById("doctor_name");
  var applicant_name = document.getElementById("applicant_name");
  var relative_name = document.getElementById("relative_name");
  var relation = document.getElementById("relation_type");
  var date_from = document.getElementById("from_date");
  var date_to = document.getElementById("to_date");

  //alert(invoice_number.value);

  addNewApplication(
    doctor_name.value,
    applicant_name.value,
    relative_name.value,
    relation.value,
    date_from.value,
    date_to.value
  );
  // document.getElementById("save_button").style.display = "none";
  // document.getElementById("apl_save_succes").style.display = "block";
  // document.getElementById("print_button").style.display = "block";

  return false;
}

// function addNewApplication(doctor_name, applicant_name, relative_name, relation, date_from, date_to) {
//   var xhttp = new XMLHttpRequest();
//   xhttp.onreadystatechange = function() {
//     if(xhttp.readyState = 4 && xhttp.status == 200)
//      xhttp.responseText;
//   };
//   xhttp.open("GET", "php/add_new_application.php?action=add_new_application&doctor_name=" + doctor_name + "&applicant_name=" + applicant_name + "&relative_name=" + relative_name + "&relation=" + relation + "&date_from=" + date_from + "&date_to=" + date_to, true);
//   xhttp.send();
// }

function addNewApplication(
  doctor_name,
  applicant_name,
  relative_name,
  relation,
  date_from,
  date_to
) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (xhttp.readyState == 4) {
      if (xhttp.status == 200) {
        var response = JSON.parse(xhttp.responseText);
        if (response.success) {
          var applicationNumber = response.application_number;
          document.getElementById("apl_save_succes").innerHTML =
            "Application Saved Successfully! Application Number is " +
            applicationNumber;
          document.getElementById("apl_save_succes").style.display = "block";
          document.getElementById("invoice_button").style.display = "block";
        } else {
          console.log("Error: " + response.message);
        }
      } else {
        console.log("Error: " + xhttp.statusText);
      }
    }
  };
  xhttp.open(
    "GET",
    "php/add_new_application.php?action=add_new_application&doctor_name=" +
      doctor_name +
      "&applicant_name=" +
      applicant_name +
      "&relative_name=" +
      relative_name +
      "&relation=" +
      relation +
      "&date_from=" +
      date_from +
      "&date_to=" +
      date_to,
    true
  );
  xhttp.send();
}

function showPatient() {
  var application_type = document.getElementById('application_type');
  if(application_type.value == '6') {    
    document.getElementById("patient_div").style.display = "none";
  } else {
    document.getElementById("patient_div").style.display = "block";
  }
}