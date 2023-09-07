$(document).ready(function () {
  const ws_connection = new WebSocket("ws://localhost:8080");
  ws_connection.onopen = (e) => {
    console.log("Connection Established!");
  };

  ws_connection.onmessage = (e) => {
    var data = JSON.parse(e.data);

    console.log(data.message);
    console.log(e);

    $("#messages").append(
      `<li class="list-group-item ${
        data.from === "me" ? "text-end" : "text-start"
      }">
      <p class="m-0">${data.message}</p>
      <small>${data.sent_date}</small>
      </li>`
    );
  };

  ws_connection.onclose = (e) => {
    console.log("Connection Closed!");
  };

  $("#chat_form").submit((e) => {
    e.preventDefault();
    let form = new FormData(document.getElementById("chat_form"));

    var data = {
      user_id: form.get("token_id"),
      message: form.get("message_box"),
    };

    ws_connection.send(JSON.stringify(data));

    $("#chat_form")[0].reset();
  });
});
