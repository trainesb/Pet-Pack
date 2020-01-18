import $ from 'jquery';
import {parse_json} from './parse_json';

export const Checkout = function() {
    $("body#checkout").ready(function(event) {
        // Create and initialize a payment form object
        const paymentForm = new SqPaymentForm({
            // Initialize the payment form elements

            applicationId: "sandbox-sq0idb-V-a9JFoWvj0VG6loYTGT-w",
            inputClass: 'sq-input',
            autoBuild: false,
            // Customize the CSS for SqPaymentForm iframe elements
            inputStyles: [{
                fontSize: '16px',
                lineHeight: '24px',
                padding: '16px',
                placeholderColor: '#a0a0a0',
                backgroundColor: 'transparent',
            }],
            // Initialize the credit card placeholders
            cardNumber: {
                elementId: 'sq-card-number',
                placeholder: 'Card Number'
            },
            cvv: {
                elementId: 'sq-cvv',
                placeholder: 'CVV'
            },
            expirationDate: {
                elementId: 'sq-expiration-date',
                placeholder: 'MM/YY'
            },
            postalCode: {
                elementId: 'sq-postal-code',
                placeholder: 'Postal'
            },
            // SqPaymentForm callback functions
            callbacks: {
                /*
                * callback function: cardNonceResponseReceived
                * Triggered when: SqPaymentForm completes a card nonce request
                */
                cardNonceResponseReceived: function (errors, nonce, cardData) {
                    if (errors) {
                        // Log errors from nonce generation to the browser developer console.
                        console.error('Encountered errors:');
                        errors.forEach(function (error) {
                            console.error('  ' + error.message);
                        });
                        alert('Encountered errors, check browser developer console for more details');
                        return;
                    }
                    alert(`The generated nonce is:\n${nonce}`);

                    let firstName = $("input#first-name").text();
                    let lastName = $("input#last-name").text();
                    let address1 = $("input#address1").text();
                    let address2 = $("input#address2").text();
                    let city = $("input#city").text();
                    let state = $("input#state").text();
                    let zip = $("input#zip").text();

                    $.ajax({
                        url: 'post/checkout.php',
                        data: {
                            nonce: nonce,
                            firstName: firstName,
                            lastName: lastName,
                            address1: address1,
                            address2: address2,
                            city: city,
                            state: state,
                            zip: zip
                        },
                        type: 'POST',
                        success: function(data) {
                            console.log(JSON.stringify(data));
                            alert('Payment complete successfully!\nCheck browser developer console for more details');
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                            alert('Payment failed to complete!\nCheck browser developer console for more details');
                        }
                    });
                }
            }
        });

        paymentForm.build();

        // onGetCardNonce is triggered when the "Pay $1.00" button is clicked
        $("#sq-creditcard").click(function(event) {
            // Don't submit the form until SqPaymentForm returns with a nonce
            event.preventDefault();
            // Request a nonce from the SqPaymentForm object
            paymentForm.requestCardNonce();
        });
    });
};