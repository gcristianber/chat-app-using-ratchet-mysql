const Constants = {
  BASE_URL: "http://localhost/development/realtime_chat_application_v1/public/",
};

function alertResponse(response) {
  console.log(response);
  $("#alertResponse").html(response);
}
