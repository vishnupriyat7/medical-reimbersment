function deleteApplication(id) {
    var confirmation = confirm("Are you sure?");
    if(confirmation) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if(xhttp.readyState = 4 && xhttp.status == 200)
          document.getElementById('manageapln_div').innerHTML = xhttp.responseText;
      };
      xhttp.open("GET", "php/manage_application.php?action=delete&id=" + id, true);
      xhttp.send();
    }
  }
  
  function editApplication(id) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('manageapln_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_application.php?action=edit&id=" + id, true);
    xhttp.send();
  }
  
  // function updateMedicine(id) {
  //   var medicine_name = document.getElementById("medicine_name");
  //   var packing = document.getElementById("packing");
  //   var generic_name = document.getElementById("generic_name");
  //   var suppliers_name = document.getElementById("suppliers_name");
  
  //   if(!notNull(medicine_name.value, "medicine_name_error"))
  //     medicine_name.focus();
  //   else if(!notNull(packing.value, "pack_error"))
  //     packing.focus();
  //   else if(!notNull(generic_name.value, "generic_name_error"))
  //     generic_name.focus();
  //   else {
  //     var xhttp = new XMLHttpRequest();
  //     xhttp.onreadystatechange = function() {
  //       if(xhttp.readyState = 4 && xhttp.status == 200)
  //         document.getElementById('medicines_div').innerHTML = xhttp.responseText;
  //     };
  //     xhttp.open("GET", "php/manage_application.php?action=update&id=" + id + "&name=" + medicine_name.value + "&packing=" + packing.value + "&generic_name=" + generic_name.value + "&suppliers_name=" + suppliers_name.value, true);
  //     xhttp.send();
  //   }
  // }
  
  function updateApplication(id) {
    // alert("Hii");
    // var appln_no = document.getElementById("appln_no");
    // alert(appln_no);
    var doctor = document.getElementById("doctor");
    // alert(doctor);
    var aplicant_name = document.getElementById("aplicant_name");
    // alert(aplicant_name);
    var relative_name = document.getElementById("relative_name");
    // alert(relative_name);
    var relation_desg = document.getElementById("relation_desg");
    // alert(relation_desg);
    var date_from = document.getElementById("date_from");
    // alert(date_from);
    var date_to = document.getElementById("date_to");
    // alert(date_to);
  
    // if(!notNull(appln_no.value, "appln_no_error"))
    // appln_no.focus();
    if(!notNull(doctor.value, "doctor_error"))
    doctor.focus();
    // else if(!notNull(aplicant_name.value, "aplicant_name_error"))
    // aplicant_name.focus();
    // else if(!notNull(relative_name.value, "relative_name_error"))
    // relative_name.focus();
    // else if(!notNull(relation_desg.value, "relation_desg_error"))
    // relation_desg.focus();
    // else if(!notNull(date_from.value, "date_from_error"))
    // date_from.focus();
    // else if(!notNull(date_to.value, "date_to_error"))
    // date_to.focus();
    else {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if(xhttp.readyState = 4 && xhttp.status == 200)
          document.getElementById('manageapln_div').innerHTML = xhttp.responseText;
      };
      xhttp.open("GET", "php/manage_application.php?action=update&id=" + id + "&doctor=" + doctor.value + "&applicant=" + aplicant_name.value + "&relative=" + relative_name.value + "&relation=" + relation_desg.value + "&datefrom=" + date_from.value + "&dateto=" + date_to.value, true);
      xhttp.send();
    }
  }
  
  function cancel() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('manageapln_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_application.php?action=cancel", true);
    xhttp.send();
  }
  
  function searchApplcn(text, tag) {
    if(tag == "applno") {
      document.getElementById("by_applno").value = "";
      // document.getElementById("by_suppliers_name").value = "";
    }
    if(tag == "applcnt_name") {
      document.getElementById("by_applcnt_name").value = "";
      // document.getElementById("by_suppliers_name").value = "";
    }
    // if(tag == "suppliers_name") {
    //   document.getElementById("by_name").value = "";
    //   document.getElementById("by_generic_name").value = "";
    // }
  
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if(xhttp.readyState = 4 && xhttp.status == 200)
        document.getElementById('manageapln_div').innerHTML = xhttp.responseText;
    };
    xhttp.open("GET", "php/manage_application.php?action=search&text=" + text + "&tag=" + tag, true);
    xhttp.send();
  }
  