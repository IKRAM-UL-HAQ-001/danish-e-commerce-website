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
            const quantity = btn.dataset.quantity || 1;

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update Cart Badge
                    const badge = document.getElementById('cart-badge');
                    if (badge) {
                        badge.textContent = data.cartCount;
                    }
                    alert(data.message);
                } else {
                    alert('Error adding product to cart');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong!');
            });
        }
    });
});
</script>
