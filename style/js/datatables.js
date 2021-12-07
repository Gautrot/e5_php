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
                // Donne un bouton pour afficher les détails de l'utilisateur dans une nouvelle page
                data: 'idUtilisateur',
                render: function (data) {
                    return '<form method="post" action="/e5_php/template/themes/template/utilisateur.php">' +
                        '<button class="btn btn-xs btn-primary" type="submit" value="' + data + '" name="idUtilisateur">Voir</button>' +
                        '</form>';
                }
            },
            {
                // Montre le nom et prénom de l'utilisateur
                data: 'nom',
                render: function (data, type, row) {
                    var nom = data;
                    var prenom = row.prenom;
                    return nom + ' ' + prenom;
                }
            },
            {
                data: 'statut',
                'visible': false,
                'searchable': false
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
                        // Le bouton est désactivé s'il l'utilisateur est un admin
                        return '<button class="btn btn-xs btn-secondary" disabled> ' + value + ' </button>';
                    } else {
                        return '<form method="post" action="/e5_php/traitement/admin/' + traitement + '-util-tr">' +
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
