var app = $.spapp({
    defaultView: "#dashboard",
    templateDir: "./views/"
});

app.run();
        var currentTab = 0;
            document.addEventListener("DOMContentLoaded", function(event) {
                showTab(currentTab);
            });

            function showTab(n) {
                var x = document.getElementsByClassName("tab");
                if (x[n]) { // Add null check
                    x[n].style.display = "block";
                    if (n == 0) {
                        document.getElementById("prevBtn").style.display = "none";
                        var firstInput = x[n].getElementsByTagName("input")[0]; // Get the first input field in the current tab
                        if (firstInput) {
                            firstInput.setAttribute("maxlength", "19"); // Set the maxlength attribute to 19
                        }
                    } else {
                        document.getElementById("prevBtn").style.display = "inline";
                    }
                    if (n == (x.length - 1)) {
                        document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
                    } else {
                        document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
                    }
                    fixStepIndicator(n);
                }
            }

              function nextPrev(n) {
              var x = document.getElementsByClassName("tab");
              if (n == 1 && !validateForm()) return false;
              x[currentTab].style.display = "none";
              currentTab = currentTab + n;
              if (currentTab >= x.length) {
            
              document.getElementById("nextprevious").style.display = "none";
              document.getElementById("all-steps").style.display = "none";
              document.getElementById("register").style.display = "none";
              document.getElementById("text-message").style.display = "block";




              }
              showTab(currentTab);
              }

              function validateForm() {
                   var x, y, i, valid = true;
                   x = document.getElementsByClassName("tab");
                   y = x[currentTab].getElementsByTagName("input");
                   for (i = 0; i < y.length; i++) {
                       if (y[i].value == "") {
                           y[i].className += " invalid";
                           valid = false;
                       }


                   }
                   if (valid) {
                       document.getElementsByClassName("step")[currentTab].className += " finish";
                   }
                   return valid;
               }

               function fixStepIndicator(n) {
                   var i, x = document.getElementsByClassName("step");
                   for (i = 0; i < x.length; i++) {
                       x[i].className = x[i].className.replace(" active", "");
                   }
                   x[n].className += " active";
               }
               

               var modal = document.getElementById("myModal");

               // Get all the "View more" buttons that open the modal
               var btns = document.getElementsByClassName("btn-outline-dark");
               
               // Get the <span> element that closes the modal
               var span = document.getElementsByClassName("close")[0];
               
               // Attach an event listener to each "View more" button
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // Attach an event listener to each "View more" button
            for (var i = 0; i < btns.length; i++) {
                btns[i].onclick = function() {
                    modal.style.display = "block";
                }
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
               
               // When the user clicks anywhere outside of the modal, close it
               window.onclick = function(event) {
                 if (event.target == modal) {
                   modal.style.display = "none";
                 }
               }


