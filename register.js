function validateForm() {
    var username = document.forms["home1"]["username"].value;
    var username1 = document.forms["home"]["username"].value;
    var password1 = document.forms["home"]["password"].value;
    var email = document.forms["home1"]["email"].value;
    //var password = document.getElementById("pass").value;
    //var confirmPassword = document.getElementById("pass2").value;
    var password = document.forms["home1"]["password"].value;
    var confirmPassword = document.forms["home1"]["confirmPassword"].value;
  
    clearErrorMessages();
  
    if (username === "" || email === "" || password === "" || confirmPassword === "" || username1 === "" || password1 === "") {
      displayErrorMessage("All fields are required");
      return false;
    }
  
    var emailRegex = /^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/;
    if (!emailRegex.test(email)) {
      displayErrorMessage("Please enter a valid email address");
      return false;
    }
  
    if (password !== confirmPassword) {
      displayErrorMessage("Passwords do not match");
      return false;
    }
  }
  
  function displayErrorMessage(message) {
    var errorContainer = document.getElementById("error-container");
    var errorMessage = document.createElement("p");
    errorMessage.innerText = message;
    errorContainer.appendChild(errorMessage);
  }
  
  function clearErrorMessages() {
    var errorContainer = document.getElementById("error-container");
    errorContainer.innerHTML = "";
  }
  
 


    
