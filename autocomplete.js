document.getElementById('model').addEventListener('input', function() {
    var searchQuery = this.value.trim();

    if (searchQuery.length >= 3) {  // Trigger AJAX if input has at least 3 characters
        fetch('autocomplete.php?model=' + encodeURIComponent(searchQuery))
            .then(response => response.json())
            .then(data => {
                var resultsDiv = document.getElementById('autocomplete-results');
                resultsDiv.innerHTML = '';  // Clear previous results

                if (data.length > 0) {
                    data.forEach(function(jet) {
                        var resultItem = document.createElement('div');
                        resultItem.classList.add('autocomplete-item');
                        resultItem.innerHTML = jet.model_name;
                        resultItem.addEventListener('click', function() {
                            document.getElementById('model').value = jet.model_name;  // Set the input field value
                            resultsDiv.innerHTML = '';  // Clear suggestions
                        });
                        resultsDiv.appendChild(resultItem);
                    });

                    // Adjust the position of the autocomplete results
                    var modelInput = document.getElementById('model');
                    var rect = modelInput.getBoundingClientRect();
                    resultsDiv.style.position = 'absolute';
                    resultsDiv.style.top = rect.bottom + window.scrollY + 'px'; // Position below the input
                    resultsDiv.style.left = rect.left + 'px'; // Align with the input field
                    resultsDiv.style.width = rect.width + 'px'; // Match the width of the input
                } else {
                    resultsDiv.innerHTML = '<p>No results found.</p>';
                }
            })
            .catch(error => console.log('Error:', error));
    } else {
        document.getElementById('autocomplete-results').innerHTML = '';
    }
});