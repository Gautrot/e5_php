<?php session_start(); ?>
<header class="fixed-top header">

    <!-- navbar -->
    <div class="navigation w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand" href="index"><img src="images/logoLPRS1.jpg" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- navbar sans connexion -->
                <?php if (empty($_SESSION["user"])) { ?>
                    <div class="collapse navbar-collapse" id="navigation">
                        <ul class="navbar-nav ml-auto text-center">
                            <li class="nav-item active">
                                <a class="nav-link" href="index">Accueil</a>
                            </li>
                            <li class="nav-item @@about">
                                <a class="nav-link" href="about">Qui sommes-nous ?</a>
                            </li>
                            <li class="nav-item @@courses">
                                <a class="nav-link" href="courses">Formations</a>
                            </li>
                            <li class="nav-item dropdown view">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    Profil
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#loginModal">Connexion</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#signupModal">Inscription</a>
                                </div>
                            </li>
                            <li class="nav-item @@contact">
                                <a class="nav-link" href="contact">Contact</a>
                            </li>

                        </ul>
                    </div>
                    <!-- navbar avec connexion -->
                <?php } else if (isset($_SESSION["user"])) {
                ?>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="index">Accueil</a>
                        </li>
                        <li class="nav-item @@about">
                            <a class="nav-link" href="about">Qui sommes-nous ?</a>
                        </li>
                        <li class="nav-item @@courses">
                            <a class="nav-link" href="courses">Formations</a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Profil
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="modif-util.php">Modification</a>
                                <a class="dropdown-item" href="#">Prise de RDV</a>
                                <a class="dropdown-item" href="teacher">Evènements</a>
                                <a class="dropdown-item" href="notice">Discussion</a>
                                <a class="dropdown-item" href="deconnexion">Deconnexion</a>
                            </div>
                        </li>
                        <li class="nav-item @@contact">
                            <a class="nav-link" href="contact">Contact</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <?php } ?>
        </div>
    </div>
</header>