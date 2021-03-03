window.onload = function () {
    attachListeners();
};

function attachListeners() {
    btnSubmit = document.getElementById("btnSubmit");
    btnSubmit.addEventListener("click", checkForms);
}

function checkForms() {
    var contactForm = document.getElementById("contactForm");

    var contactName = document.getElementById("contactName");
    var txtContactName = contactName.value;
    var isContactNameValid = false;

    var email = document.getElementById("email");
    var txtEmail = email.value;
    var isEmailValid = false;

    var contactPhoneNumber = document.getElementById("contactNumber");
    var txtContactPhoneNumber = contactPhoneNumber.value;
    var isContactPhoneNumberValid = false;

    var contactMessage = document.getElementById("feedback");
    var txtContactMessage = contactMessage.value;
    var isContactMessageValid = false;

    if (txtContactName === "") {
        contactName.style.borderColor = "red";
        contactName.setCustomValidity("This is a required field!");
        isContactNameValid = false;
    } else {
        if (!chkNameSyntax(txtContactName)) {
            contactName.style.borderColor = "red";
            contactName.setCustomValidity("Please enter a proper first name!");
            isContactNameValid = false;
        } else {
            contactName.style.borderColor = "green";
            contactName.setCustomValidity("");
            isContactNameValid = true;
        }
    }

    if (txtEmail === "") {
        email.style.borderColor = "red";
        email.setCustomValidity("This is a required field!");
        isEmailValid = false;
    } else {
        if (!chkEmailSyntax(txtEmail)) {
            email.style.borderColor = "red";
            email.setCustomValidity("Please enter a proper email!");
            isEmailValid = false;
        } else {
            email.style.borderColor = "green";
            email.setCustomValidity("");
            isEmailValid = true;
        }
    }

    if (txtContactPhoneNumber === "") {
        contactPhoneNumber.style.borderColor = "red";
        contactPhoneNumber.setCustomValidity("This is a required field!");
        isContactPhoneNumberValid = false;
    } else {
        if (!chkNumber(txtContactPhoneNumber)) {
            contactPhoneNumber.style.borderColor = "red";
            contactPhoneNumber.setCustomValidity("Please enter a valid number!");
            isContactPhoneNumberValid = false;
        } else {
            contactPhoneNumber.style.borderColor = "green";
            contactPhoneNumber.setCustomValidity("");
            isContactPhoneNumberValid = true;
        }
    }

    if (txtContactMessage === "") {
        contactMessage.style.borderColor = "red";
        contactMessage.setCustomValidity("This is a required field!");
        isContactMessageValid = false;
    } else {
        if (!chkComment(txtContactMessage)) {
            contactMessage.style.borderColor = "red";
            contactMessage.setCustomValidity("Please enter a valid feedback!");
            isContactMessageValid = false;
        } else {
            contactMessage.style.borderColor = "green";
            contactMessage.setCustomValidity("");
            isContactMessageValid = true;
        }
    }

    if (isContactNameValid && isEmailValid && isContactPhoneNumberValid && isContactMessageValid) {
        contactForm.submit();
    }
}


function chkEmailSyntax(email) { //this is to check whether syntax of email is correct format or not
    return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email);
}

function chkNameSyntax(name) { //this is to check whether syntax of name is correct format or not
    return /^([A-z ]+)$/.test(name);
}

function chkNumber(number) { //this is to check whether syntax of number is correct format or not
    return /^([0-9]{8})$/.test(number);
}

function chkComment(comment) { ////this is to check whether syntax of comment is correct format or not
    return /^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$/.test(comment);
}
