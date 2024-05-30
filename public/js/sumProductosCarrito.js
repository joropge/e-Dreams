document.addEventListener('DOMContentLoaded', (event) => {
    window.updateCantidad = function(id, cantidad) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(id, cantidad);
        fetch(`/user/carrito/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    cantidad: cantidad
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(cantidad);
                    location.reload();
                } else {
                    console.error('Failed to update quantity');
                }
            })
            .catch(error => console.error('Error:', error));
    };
});
