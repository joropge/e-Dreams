function updateCantidad(id, csrfToken, cantidad) {
    console.log(id, cantidad);
    fetch(`{{ url('/user/carrito') }}/${id}`, {
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
}
