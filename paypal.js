

paypal.Buttons({
    style : {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function (data, actions) {
        return actions.order.create({
            purchase_units : [{
                amount: {
                    value: parseFloat(document.getElementById('total').innerHTML) * parseFloat(document.getElementById('rate').innerHTML)
                }
            }]
        });
    },
    onApprove: function (data, actions) {
        return actions.order.capture().then(function (details) {
            console.log(details)
            
            var address = document.getElementById('placeName').value + ', ' + document.getElementById('address-line1').value 
                + ', ' + document.getElementById('address-line2').value + ', ' + document.getElementById('postal-code').value;
            
                $.ajax({
                type: "POST",
                url: 'success.php',
                data: {menuID: document.getElementById('menu').options.item(document.getElementById('menu').selectedIndex).getAttribute('id'),
                numServe: document.getElementById('numServe').value,
                decor: document.getElementById('decor').checked,
                video: document.getElementById('video').checked,
                photo: document.getElementById('photo').checked,
                pa: document.getElementById('pa').checked,
                eventDate: document.getElementById('eventDate').value,
                address: address,
                total: document.getElementById('total').innerHTML}
                
            })
        })
    },
    onCancel: function (data) {
        
        window.location.replace("customer.php?error=2")
    }
}).render('#paypal-payment-button');