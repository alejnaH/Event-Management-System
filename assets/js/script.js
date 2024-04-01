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



//dashboard
$(document).ready(function() {
    // Add the event listener for the "Learn More" button here
    $(document).on('click', '.learn-more', function(event) {
        event.preventDefault();
        var scrollSection = $('#scroll');
        if (scrollSection.length) {
            $('html, body').animate({
                scrollTop: scrollSection.offset().top
            }, 100);
        }
    });
  });




//Bootstrap handles opening the modal via data-bs-toggle and data-bs-target attributes

