// Main JS

const URLROOT = 'http://localhost:8080'; // Updated for local PHP server

document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
});

function updateCartCount() {
    fetch(`${URLROOT}/cart/count`) // Corrected URL construction
        .then(response => response.json())
        .then(data => {
            const cartCount = document.getElementById('cart-count');
            if (cartCount) {
                cartCount.innerText = data.count;
            }
        })
        .catch(err => console.log('Cart count error', err));
}

// Global Add to Cart (used in grid)
function addToCart(id) {
    // Prevent default if called from link
    if (event) {
        event.preventDefault();
        event.stopPropagation();
    }

    fetch(`${URLROOT}/cart/add`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id, qty: 1 })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Show toast or updated UI
                updateCartCount();

                // Simple toast
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-brand-800 text-white px-6 py-3 rounded shadow-lg z-50 animate-bounce';
                toast.innerText = 'Added to Cart! 🌸';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            }
        })
        .catch(err => console.error(err));
}

// Detail Page Add to Cart
function addToCartDetail(id) {
    const qtyInput = document.getElementById('qty');
    const qty = qtyInput ? parseInt(qtyInput.value) : 1;

    fetch(`${URLROOT}/cart/add`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id, qty: qty })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateCartCount();
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-brand-800 text-white px-6 py-3 rounded shadow-lg z-50 animate-bounce';
                toast.innerText = 'Added to Cart! 🌸';
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2000);
            }
        });
}

function buyNow(id) {
    const qtyInput = document.getElementById('qty');
    const qty = qtyInput ? parseInt(qtyInput.value) : 1;

    fetch(`${URLROOT}/cart/add`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ id: id, qty: qty })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = `${URLROOT}/orders/checkout`;
            }
        });
}
