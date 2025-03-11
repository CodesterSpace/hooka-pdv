function printInvoiceAsPDF() {
    const element = document.getElementById('invoice-content');
    const searchInput = document.getElementById('searchInput');

    function toggleNoPrintClass() {
        if (searchInput.value.trim() !== '') {
            searchDiv.classList.remove('no-print');
        } else {
            searchDiv.classList.add('no-print');
        }
    }
    // Si le filtre est vide, réinitialiser l'affichage des éléments
    toggleNoPrintClass();

    // Hide elements with class 'no-print'
    const NoPrint = document.querySelectorAll('.no-print');
    NoPrint.forEach(element => {
        element.style.display = 'none';
    });

    // Remove the href attribute from all links and store their original href values
    const links = document.querySelectorAll('a');
    const originalHrefs = [];
    links.forEach(link => {
        originalHrefs.push(link.getAttribute('href'));
        link.removeAttribute('href');
    });

    html2pdf(element, {
        margin:       10,
        filename:     'liste.pdf',
        image:        { type: 'jpeg', quality: 1 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'mm', format: 'a3', orientation: 'portrait' }
    })
    // .then(() => {
    //     // Restore the href attributes after generating PDF
    //     links.forEach((link, index) => {
    //         link.setAttribute('href', originalHrefs[index]);
    //     });
    //     NoPrint.forEach(element => {
    //         element.style.display = '';
    //     });
    // });
    setTimeout(function() {
        window.location.reload();
    }, 5000); // Reload after 8 seconds
}
