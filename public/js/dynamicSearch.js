    document.addEventListener('DOMContentLoaded', function () {
        const search = document.getElementById('search');
        search.addEventListener('keyup', function () {
            let value = search.value.toLowerCase();
            console.log("value", value);
            let cards = document.querySelectorAll('.product-card');
            cards.forEach(card => {
                let name = card.getAttribute('data-name').toLowerCase();
                if (name.includes(value)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
