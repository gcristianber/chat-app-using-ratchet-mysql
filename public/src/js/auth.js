let errorMessage = "";

$("#alertResponse").hide();

$("#login").on("submit", (e) => {
  e.preventDefault();

  const form = new FormData(document.getElementById("login"));

  $.ajax({
    url: Constants.BASE_URL + "auth/login/validateInput",
    method: "POST",
    data: {
      email_address: form.get("email_address"),
      password: form.get("password"),
    },
    success: function (response) {
      var successResponse = JSON.parse(response);
      console.log(successResponse.success);
      window.location.href = Constants.BASE_URL + "chat/messages";
    },
    error: function (xhr, status, error) {
      if (xhr.status === 400) {
        var errorResponse = JSON.parse(xhr.responseText);
        var errorMessage = "";
        var errorCount = 0;

        $("#alertResponse").show();

        for (const key in errorResponse.errors) {
          if (errorResponse.errors.hasOwnProperty(key)) {
            errorCount++;
            errorMessage += errorResponse.errors[key] + " and ";
          }
        }

        if (errorCount > 1) {
          errorMessage = errorMessage.substring(0, errorMessage.length - 5);
        } else {
          errorMessage = errorMessage.substring(0, errorMessage.length - 5);
        }

        alertResponse(errorMessage);
      } else {
        console.log("An error occurred:", error);
      }
    },
  });
});
