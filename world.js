document.addEventListener('DOMContentLoaded', function () {
    // Lookup button click event
    document.getElementById('lookup').addEventListener('click', function () {
        lookup('country');
    });

    // Lookup Cities button click event
    document.getElementById('lookupCities').addEventListener('click', function () {
        lookup('cities');
    });

    // Function to handle both types of lookups
    function lookup(type) {
        var countryName = document.getElementById('country').value;

        // Fetch data using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'world.php?country=' + encodeURIComponent(countryName) + '&lookup=' + type, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Print the data into the div with id "result"
                document.getElementById('result').innerHTML = xhr.responseText;

                // Show/hide tables based on lookup type
                document.getElementById('tableCountries').style.display = (type === 'country') ? 'block' : 'none';
                document.getElementById('tableCities').style.display = (type === 'cities') ? 'block' : 'none';
            }
        };

        xhr.send();
    }
});
