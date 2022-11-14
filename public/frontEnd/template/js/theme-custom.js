// File for your custom JavaScript
let selectedServiceId = 0;
const addressForm = document.querySelector('.add_new_address_form');
const addressList = document.querySelector('.address_list');

$('document').ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //service click
    $('body').on('click','.serviceBtn', function() {
        selectedServiceId = $(this).data('id');
        let serviceText = $(this).text();
        $('.serviceInfo').text('');
        $('.serviceInfo').text(serviceText);

    });

    // $('.modalShippingAddress').modal('show');

    $('body').on('click','.shippingBtn', function() {

        $('.shipping_billing_type').val('shipping');
        $('.modalShippingAddress').modal('show');
    });

    $('body').on('click','.billingBtn', function() {

        $('.shipping_billing_type').val('billing');
        $('.modalShippingAddress').modal('show');
    });

});

function openAddressForm() {
    addressForm.style.display = 'block';
    addressList.style.display = 'none';
}

function closeAddressForm() {
    addressForm.style.display = 'none';
    addressList.style.display = 'block';
}