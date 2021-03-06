<header class="fixed-top header">
    <!-- navbar -->
    <div class="navigation w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand" href="/e5_php/index.php"><img src="/e5_php/style/images/logoLPRS1.jpg" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="/e5_php/index.php">Accueil et Presentation</a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php if (empty($_SESSION['user'])) { ?>
                                    <!-- navbar sans connexion -->
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#loginModal">Connexion</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#signupModal">Inscription</a>
                                <?php } else if (isset($_SESSION['user'])) { ?>
                                    <!-- navbar avec connexion -->
                                    <a class="dropdown-item" href="/e5_php/view/profil.php">Voir votre profil</a>
                                    <a class="dropdown-item" href="/e5_php/view/modif-util.php">Modifier
                                        votre compte</a>
                                    <?php switch ($_SESSION['user']['statut']) {
                                        case '1':
                                            ?>
                                            <a class="dropdown-item" href="/e5_php/view/discussion/discussions.php">Discussion</a>
                                            <?php break;
                                        case '2': ?>
                                            <a class="dropdown-item" href="/e5_php/view/rdv/rdv.php">Rendez-vous</a>
                                            <a class="dropdown-item" href="/e5_php/view/discussion/discussions.php">Discussion</a>
                                            <?php break;
                                        case '3':
                                        case '4':
                                            ?>
                                            <a class="dropdown-item" href="/e5_php/view/discussion/discussions.php">Discussion</a>
                                            <a class="dropdown-item" href="/e5_php/view/pee/pee.php">Projets ??ducatifs de l?????tablissement</a>
                                            <a class="dropdown-item" href="/e5_php/view/rdv/rdv.php">Rendez-vous</a>
                                            <?php break;
                                    } ?>
                                    <a class="dropdown-item" href="/e5_php/view/evenement/evenements.php">??v??nements</a>
                                    <a class="dropdown-item" href="/e5_php/view/deconnexion.php">D??connexion</a>
                                <?php } ?>
                            </div>
                        </li>
                        <li class="nav-item @@contact">
                            <a class="nav-link" href="/e5_php/view/contact.php">Contact</a>
                        </li>
                        <?php if (isset($_SESSION['user']['statut']) && $_SESSION['user']['statut'] === '4') { ?>
                            <li class="nav-item dropdown view">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Administration
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/e5_php/view/admin/table-util.php">Liste d'utilisateurs</a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
