$(document).ready(function () {

    //Table Utilisateur
    $('#utilisateur').DataTable({
        // Traduction française
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        // AJAX : montre les données de la table 'utilisateur'
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': '/e5_php/manager/datatables/datatables-util.php',
            'type': 'POST',
            "datatype": "json",
        },
        'columns': [
            {
                // Cache la colonne 'idUtilisateur'.
                data: 'idUtilisateur',
                'visible': false,
                'searchable': false
            },
            {
                // Donne un lien pour afficher les détails de l'utilisateur dans une nouvelle page
                data: 'nom',
                render: function (data, type, row) {
                    var id = row.idUtilisateur;
                    var nom = data;
                    var prenom = row.prenom;
                    return '<a href="/e5_php/traitement/cherche-util-admin-tr?idUtilisateur=' + id + '"/>' +
                        nom + ' ' + prenom +
                        '</a>';
                }
            },
            {data: 'dateNaissance'},
            {data: 'adresse'},
            {
                data: 'telephone',
                render: function (data) {
                    var tel = '';

                    // Ajoute un espace pour tout les deux chiffres du tel
                    for (var i = 0; i < data.length; i = i + 2) {
                        tel += data.charAt(i) + data.charAt(i + 1) + ' ';
                    }
                    return tel;
                }
            },
            {data: 'mail'},
            {data: 'login'},
            {data: 'mdp'},
            {
                data: 'statut',
                render: function (data) {
                    switch (data) {
                        case '1':
                            return 'Eleve'
                        case '2':
                            return 'Parent'
                        case '3':
                            return 'Professeur'
                        case '4':
                            return 'Administrateur'
                        default:
                            return 'Utilisateur'
                    }
                }
            },
            {
                data: 'validUtilisateur',
                render: function (data, type, row) {
                    var id = row.idUtilisateur;
                    var statut = row.statut;
                    var value = 'Activer';
                    var traitement = 'activer';

                    // Affiche le bouton "Désactiver" pour chaque ligne si valid = 1
                    if (data === '1') {
                        value = 'Désactiver';
                        traitement = 'desactiver';
                    }
                    // Affiche le bouton "Activer" pour chaque ligne si valid = 0
                    if (statut === '4') {
                        return '<button class="btn btn-xs btn-secondary" disabled> ' + value + ' </button>';
                    } else {
                        return '<form method="post" action="/e5_php/traitement/' + traitement + '-util-tr/' + id + '">' +
                            '<button class="btn btn-xs btn-primary" type="submit" value="' + id + '" name="idUtilisateur"> ' + value + ' </button>' +
                            '</form>';
                    }
                }
            }
        ],
        // Organise automatiquement par ID, dans l'ordre croissant.
        "order": [0, 'asc']
    });
});
