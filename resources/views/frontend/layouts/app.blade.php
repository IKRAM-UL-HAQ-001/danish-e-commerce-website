@include('frontend.layouts.partials.header')

<main>
    @yield('content')
</main>

@include('frontend.layouts.partials.footer')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Global Add to Cart Handler
    document.addEventListener('click', function(e) {
        if (e.target.closest('.add-to-cart')) {
            e.preventDefault();
            const btn = e.target.closest('.add-to-cart');
            const productId = btn.dataset.id;
            const offerId = btn.dataset.offer_id;
            const quantity = btn.dataset.quantity || 1;

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    offer_id: offerId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                const toast = document.createElement('div');
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 25px;
                    background: #EE2D7A;
                    color: white;
                    border-radius: 10px;
                    box-shadow: 0 10px 30px rgba(238, 45, 122, 0.3);
                    z-index: 9999;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                    font-weight: 600;
                    transform: translateY(-100px);
                    transition: all 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                    opacity: 0;
                `;
                
                if (data.status === 'success') {
                    // Update Cart Badge
                    const badge = document.getElementById('cart-badge');
                    if (badge) {
                        badge.textContent = data.cartCount;
                    }
                    toast.innerHTML = `<i class="fa-solid fa-circle-check"></i> Success! Added to cart.`;
                } else {
                    toast.style.background = '#dc3545';
                    toast.innerHTML = `<i class="fa-solid fa-circle-exclamation"></i> Error adding product.`;
                }

                document.body.appendChild(toast);
                
                // Show toast
                setTimeout(() => {
                    toast.style.transform = 'translateY(0)';
                    toast.style.opacity = '1';
                }, 100);

                // Hide and remove toast
                setTimeout(() => {
                    toast.style.transform = 'translateY(-100px)';
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
                // Fallback for network errors
            });
        }
    });
});
</script>
