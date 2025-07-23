function validate(theForm) {
    var invalid = false;

    if (requiredFieldEmpty(document.getElementById("firstName"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("lastName"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("email"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("phone"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("application_notes"))) invalid = true;

    if (invalid == true) {
        document.getElementById("formError").style.display = "inline-block";
        document.getElementById("formPass").style.display = "none";
        return false;
    } 
    
    else {
        document.getElementById("formError").style.display = "none";
        document.getElementById("formPass").style.display = "inline-block";
        return true;
    }
}

function validateUpdate(theForm) {
    var invalid = false;

    if (requiredFieldEmpty(document.getElementById("name"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("species"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("age"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("gender"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("breed"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("descriptionBox"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("suburb"))) invalid = true;
    if (requiredFieldEmpty(document.getElementById("fee"))) invalid = true;

    if (invalid == true) {
        document.getElementById("formError").style.display = "inline-block";
        document.getElementById("formPass").style.display = "none";
        return false;
    } 
    
    else {
        document.getElementById("formError").style.display = "none";
        document.getElementById("formPass").style.display = "inline-block";
        return true;
    }
}

function requiredFieldEmpty(element) {
    if (!element.value.length || element == '' || element == null) {
        element.style.outline = "1px solid red";
        return true;
    } else {
        element.style.outline = "none";
        return false;
    }
}