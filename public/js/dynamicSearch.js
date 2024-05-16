const search = document.getElementById('search');
        search.addEventListener('keyup', function() {
            let value = search.value.toLowerCase();
            let rows = document.querySelectorAll('tbody tr');
            rows.forEach(row => {
                let nameCell = row.querySelector('#nameSearch'); // Select only the Name cell
                let rowText = nameCell.textContent.toLowerCase(); // Get text content of the Name cell
                if (rowText.includes(value)) {
                    row.style.display = ''; // Show the row if the search value is found in the Name cell
                } else {
                    row.style.display = 'none'; // Hide the row if the search value is not found in the Name cell
                }
            });
        });

