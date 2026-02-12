document.querySelectorAll('.ajoutJeu').forEach(function(button) {
    button.addEventListener('click', function() {
        // Récupération des données du jeu
        let id = button.getAttribute('data-id');
        let nom = button.getAttribute('data-name');
        let prix = button.getAttribute('data-price');

        // Ajout du jeu au panier
        ajouterJeu(id, nom, prix);
    });
});

function ajouterJeu(id, nom, prix) {
    // Récupération du panier
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Vérification si le jeu est déjà dans le panier
    let jeu = panier.find(j => j.id == id);
    if (jeu) {
        jeu.quantite++;
    } else {
        panier.push({ id: id, nom: nom, prix: prix, quantite: 1 });
    }

    // Enregistrement du panier
    localStorage.setItem('panier', JSON.stringify(panier));
}

document.addEventListener('DOMContentLoaded', function() {
    // Récupération du panier
    // détecter si un élément avec l'id panier existe, si oui appeler la fonction afficherPanier
    if (document.getElementById('panier')) {
        afficherPanier();
    }
});


function afficherPanier() {
    // Récupération du panier
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    // Affichage du panier
    let panierElement = document.getElementById('panier');
    panierElement.innerHTML = '';
    panier.forEach(function(jeu) {
        let options = '';
        for (let i = 1; i <= 10; i++) {
            options += `<option value="${i}" ${jeu.quantite == i ? 'selected' : ''}>${i}</option>`;
        }

        let tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${jeu.nom}</td>
            <td>${jeu.prix} €</td>

            <td>
                <select class="changeQuantity" data-id="${jeu.id}">
                    ${options}
                </select>
            </td>

            <td>${jeu.prix * jeu.quantite} €</td>

            <td>
                <button 
                    class="cart-item-delete"
                    data-id=${jeu.id}
                >
                    Supprimer
                </button>
            </td>
        `;
        panierElement.appendChild(tr);
    });

    // Delete
    document.querySelectorAll('.cart-item-delete').forEach(function (button) {
        button.addEventListener('click', function() {
            console.log('clickkkk')
            let id = button.getAttribute('data-id')
            deleteGame(id)
        })
    })

    // Modify
    document.querySelectorAll('.changeQuantity').forEach(function(button) {
        button.addEventListener('change', function() {
            modifyQuantity(button.dataset.id, button.value)
        })
    })

    // Clear
    document.querySelector('.clear').addEventListener('click', function() {
        clearCart()
    })
}

function deleteGame(id) {
    let panier = JSON.parse(localStorage.getItem('panier')) || [];

    panier = panier.filter(jeu => jeu.id != id);
    localStorage.setItem('panier', JSON.stringify(panier));

    afficherPanier(); 
}

function modifyQuantity(id, quantity) {
    let panier = JSON.parse(localStorage.getItem('panier')) || []

    let game = panier.find(j => j.id == id)
    if (game) {
        game.quantite = parseInt(quantity)
    }

    localStorage.setItem('panier', JSON.stringify(panier))
    afficherPanier()
}

function clearCart() {
  localStorage.removeItem('panier')
  afficherPanier()
}