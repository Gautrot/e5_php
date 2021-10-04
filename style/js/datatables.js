$(document).ready(function () {
    //Table Utilisateur
    var table = $('#utilisateur').DataTable({
        // Traduction française
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
        },
        // AJAX : montre les données de la table 'utilisateur'
        'processing': true,
        'serverSide': true,
        'ajax': {
            'url': '../../manager/datatables/datatables-util.php',
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
                render: function (data, type, row, meta) {
                    return '<a href="../../traitement/cherche-util-tr/' + row.idUtilisateur + '"/>' +
                        data + ' ' + row.prenom +
                        '</a>';
                }
            },
            // {data: 'prenom'},
            {data: 'dateNaissance'},
            {data: 'adresse'},
            {data: 'telephone'},
            {data: 'mail'},
            {data: 'login'},
            {data: 'mdp'},
            {data: 'statut'},
            {
                // Affiche le bouton "Valider" pour chaque ligne
                data: 'validUtilisateur',
                render: function (data, type, row) {
                    console.log(data);
                    switch (data) {
                        case 1:
                            // console.log('Test 1');
                            return '<button type="submit" value="Validé.e" disabled/>';
                        default:
                            // console.log('Test 2');
                            return '<form method="post" action="../../traitement/valid-util-tr/' + row.idUtilisateur + '">' +
                                '<input name="' + data + '" value="' + data + '" hidden/>' +
                                '<button type="submit">Valider</button>' +
                                '</form>';
                    }
                }
            }
        ],
        // Organise automatiquement par ID, dans l'ordre croissant.
        "order": [0, 'asc']
    });

    /*
    $('#utilisateur tbody').on( 'click', 'tr', function () {
        var data = table.row( this ).data() ;
        alert(data['idUtilisateur']);
    });
    */
});
