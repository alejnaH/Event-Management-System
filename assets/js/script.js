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
  var learnMoreButton = $('.learn-more');
  if (learnMoreButton.length) {
      learnMoreButton.on('click', function(event) {
          event.preventDefault();
          var scrollSection = $('#scroll');
          if (scrollSection.length) {
              $('html, body').animate({
                  scrollTop: scrollSection.offset().top
              },100);
          }
      });
  }
});hboard 







//Bootstrap handles opening the modal via data-bs-toggle and data-bs-target attributes

//jsonData

$(document).ready(function() {
    // Fetch the JSON data
    fetch('views/data.json')
      .then(response => response.json())
      .then(data => {
        // For each item in the data, populate the block
        $.each(data, function(i, item) {
          // Select the block and set its content
          var block = $('.col.mb-5').eq(i);
          block.find('.date p').text(item.date);
          block.find('.text-center h5').text(item.eventName);
  
          // Attach a click event handler to the block
          block.on('click', function() {
            // Select the modal and set its content
            var modal = $('#myModal');
            modal.find('.modal-title').text(item.eventName);
            modal.find('.modal-body').html(
              '<p>Date: ' + item.date + '</p>' +
              '<p>Time: ' + item.time + '</p>' +
              '<p>Country: ' + item.country + '</p>' +
              '<p>City: ' + item.city + '</p>' +
              '<p>Address: ' + item.address + '</p>' +
              '<p>Description: ' + item.description + '</p>'
            );
          });
        });
      })
      .catch(error => console.error('Error:', error));
  });