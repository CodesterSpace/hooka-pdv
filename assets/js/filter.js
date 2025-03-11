// Récupérer l'élément de champ de recherche
let searchInput = document.getElementById('searchInput');
let searchDiv = document.getElementById('search-div');
let allProduct = document.getElementById('all-product');

// Récupérer tous les éléments à filtrer
let elementsToFilter = document.querySelectorAll('.product-list');

// Fonction pour ajouter ou supprimer la classe 'no-print' en fonction de l'état du champ de recherche
function toggleNoPrintClass() {
    if (searchInput.value.trim() !== '') {
        searchDiv.classList.remove('no-print');
    } else {
        searchDiv.classList.add('no-print');
    }
}

// Parcourir tous les éléments de produit
// Écouter les événements de saisie dans le champ de recherche
searchInput.addEventListener('input', function() {
    let filter = searchInput.value.toLowerCase();

    // Parcourir tous les éléments à filtrer
    elementsToFilter.forEach(function(element) {
        let textContent = element.textContent.toLowerCase();

        // Vérifier si la saisie de l'utilisateur correspond à l'élément
        if (textContent.includes(filter)) {
            element.style.display = ''; // Afficher l'élément si la correspondance est trouvée
        } else {
            element.style.display = 'none'; // Masquer l'élément si aucune correspondance n'est trouvée
        }
    });
    // Écouter l'événement click sur allProduct pour réafficher tous les éléments
    allProduct.addEventListener('click', function() {
        elementsToFilter.forEach(function(element) {
            element.style.display = ''; // Afficher tous les éléments
        });
        // Reset the input field
        searchInput.value = '';
    });

    // Si le filtre est vide, réinitialiser l'affichage des éléments
    toggleNoPrintClass();
});

// Écouter l'événement focus pour afficher les éléments même s'ils ne correspondent pas
searchInput.addEventListener('focus', toggleNoPrintClass);

// Écouter l'événement blur pour réinitialiser l'affichage des éléments lorsque le champ de recherche perd le focus
searchInput.addEventListener('blur', toggleNoPrintClass);