<?php require("../app/views/components/navbar.view.php"); ?>
<section class="container mt-4">
    <div class="mb-4 d-flex flex-column gap-3">
        <ul id="messages" class="list-group">
        </ul>
        <p class="fst-italic" id="typing_identifier">Typing...</p>
    </div>

    <div class="mb-3">
        <form id="chat_form">
            <input type="hidden" name="token_id" value="<?= $token_id ?>">
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="message_box" name="message_box" placeholder="Aa">
                <button class="btn btn-primary" type="submit" id="button-addon2">Send</button>
            </div>
        </form>
    </div>
</section>

<script src="<?= ROOT ?>src/js/chat.js"></script>