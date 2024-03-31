// Form validation and submission logic
$(".event-form").validate({
    rules: {
        event_name: {
            required: true,
            minlength: 5
        },
        date: {
            required: true
        },
        time: {
            required: true,
        },
        country: {
            required: true,
            minlength: 5
        },
        city: {
            required: true,
            minlength: 5
        },
        description: {
            required: true,
            minlength: 100
        },
    },
    submitHandler: function(form, event) {
        event.preventDefault(); // Prevent default form submission
        blockUi(".event-form");

        // Serialize form data
        let formData = $(form).serializeArray();
        let jsonData = {};
        formData.forEach(item => {
            jsonData[item.name] = item.value;
        });

        // Update data.json file
        updateDataJson(jsonData);
    }
});

// Helper functions
function blockUi(element) {
    $(element).block({
        message: '<div class="spinner-border text-primary" role="status"></div>',
        css: {
            backgroundColor: "transparent",
            border: "0",
        },
        overlayCSS: {
            backgroundColor: "#000",
            opacity: 0.25,
        }
    });
}

function updateDataJson(formData) {
    // Read existing data from data.json file
    $.getJSON("data.json", function(data) {
        // Append new form data to existing data
        data.push(formData);
        // Write updated data back to data.json file
        $.ajax({
            type: "POST",
            url: "data.json",
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function(response) {
                console.log("Form data submitted successfully:", response);
                unblockUi(".event-form");
                // Optionally, you can redirect the user to another page or show a success message here
            },
            error: function(xhr, status, error) {
                console.error("Error submitting form data:", error);
                unblockUi(".event-form");
                // Optionally, you can show an error message to the user here
            }
        });
    });
}

function unblockUi(element) {
    $(element).unblock({});
}
