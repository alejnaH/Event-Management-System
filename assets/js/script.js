var app = $.spapp({
    defaultView: "#dashboard",
    templateDir: "./views/"
});

app.run();

document.addEventListener("DOMContentLoaded", function(event) {
    // Note: No need to manually handle modal closing since Bootstrap handles it
});

function closeModal() {
    // Remove any modal backdrop
    $('.modal-backdrop').remove();
    // Close the modal using Bootstrap's method
    $('#myModal').modal('hide');
}




// Note: Bootstrap handles opening the modal via data-bs-toggle and data-bs-target attributes