const search = document.getElementById('search');
        search.addEventListener('keyup', function() {
            let value = search.value.toLowerCase();
            console.log("value", value);
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                row.style.display = 'none';
                // only search in the 3rd column
                let thirdCol = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
                if (thirdCol.includes(value)) {
                    row.style.display = '';
                }
            });
        });

