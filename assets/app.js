/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

document.getElementById("payment_form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    const paymentform = document.getElementById("payment_form");
    const payment_form_product = document.getElementById('payment_form_product');
    const payment_form_taxNumber = document.getElementById('payment_form_taxNumber');
    const payment_form_couponCode = document.getElementById('payment_form_couponCode');
    const payment_form_paymentProcessor = document.getElementById('payment_form_paymentProcessor');
    const paymentformData = new FormData();
    paymentformData.append('product', payment_form_product.value);
    paymentformData.append('taxNumber', payment_form_taxNumber.value);
    paymentformData.append('paymentProcessor', payment_form_paymentProcessor.value);
    paymentformData.append('couponCode', payment_form_couponCode.value);

    // Send the form data to the backend using the fetch API
    fetch("Transaction/getPrice", {
        method: "POST",
        body:paymentformData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Handle the response from the backend
            // Perform any additional actions you need here
        })
        .catch(error => {
            console.error("Error:", error);
        });
});
