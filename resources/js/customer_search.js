document.getElementById('searchInput').addEventListener('keyup', function() {
    const filter = this.value.toLowerCase();
    const rows = document.querySelectorAll('.customer-result');
    
    rows.forEach(row => {
        const rowText = row.textContent.toLowerCase();
        
        if (rowText.includes(filter)) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});