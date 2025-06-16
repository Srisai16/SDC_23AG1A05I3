// js/cart.js

document.addEventListener('DOMContentLoaded', function() {
    // Quantity updates
    document.querySelectorAll('.quantity-input').forEach(input => {
        input.addEventListener('change', function() {
            const form = this.closest('form');
            if (form) {
                form.submit();
            }
        });
    });

    // Remove item
    document.querySelectorAll('.remove-item').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove this item?')) {
                window.location.href = this.href;
            }
        });
    });

    // Apply coupon code
    const couponForm = document.querySelector('#coupon-form');
    if (couponForm) {
        couponForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const code = this.querySelector('input[name="coupon_code"]').value;
            
            fetch('ajax/apply_coupon.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `coupon_code=${encodeURIComponent(code)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector('.subtotal-price').textContent = data.subtotal;
                    document.querySelector('.discount-price').textContent = `-${data.discount}`;
                    document.querySelector('.total-price').textContent = data.total;
                    showAlert('Coupon applied successfully!', 'success');
                } else {
                    showAlert(data.message, 'danger');
                }
            });
        });
    }
});