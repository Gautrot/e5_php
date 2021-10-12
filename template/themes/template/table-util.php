<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Table des utilisateurs</title>
    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- ** Plugins Needed for the Project ** -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <!-- themefy-icon -->
    <link rel="stylesheet" href="plugins/themify-icons/themify-icons.css">
    <!-- animation css -->
    <link rel="stylesheet" href="plugins/animate/animate.css">
    <!-- aos -->
    <link rel="stylesheet" href="plugins/aos/aos.css">
    <!-- venobox popup -->
    <link rel="stylesheet" href="plugins/venobox/venobox.css">

    <!-- Main Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="../../../vendor/datatables/datatables/media/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../../../style/css/datatables.css">

    <!--Favicon-->
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">
</head>

<body>
<!-- preloader start -->
<div class="preloader">
    <img src="images/preloader.gif" alt="preloader">
</div>
<!-- preloader end -->

<!-- header -->
<header class="fixed-top header">
    <!-- top header -->
    <div class="top-header py-2 bg-white">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-lg-4 text-center text-lg-left">
                    <a class="text-color mr-3" href="callto:+443003030266"><strong>CALL</strong> +44 300 303 0266</a>
                    <ul class="list-inline d-inline">
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                                        class="ti-facebook"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                                        class="ti-twitter-alt"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                                        class="ti-linkedin"></i></a></li>
                        <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i
                                        class="ti-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 text-center text-lg-right">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="notice.html">notice</a></li>
                        <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="research.html">research</a></li>
                        <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                                    href="scholarship.html">SCHOLARSHIP</a></li>
                        <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"
                                    data-toggle="modal" data-target="#loginModal">Connexion</a></li>
                        <li class="list-inline-item"><a
                                    class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#"
                                    data-toggle="modal" data-target="#signupModal">Inscription</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <a class="navbar-brand" href="index.html"><img src="images/logoLPRS1.jpg" alt="logo"></a>
                <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ml-auto text-center">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item @@about">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item @@courses">
                            <a class="nav-link" href="courses.html">COURSES</a>
                        </li>
                        <li class="nav-item @@events">
                            <a class="nav-link" href="events.html">EVENTS</a>
                        </li>
                        <li class="nav-item @@blog">
                            <a class="nav-link" href="blog.html">BLOG</a>
                        </li>
                        <li class="nav-item dropdown view">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Pages
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="teacher.html">Teacher</a>
                                <a class="dropdown-item" href="teacher-single.html">Teacher Single</a>
                                <a class="dropdown-item" href="notice.html">Notice</a>
                                <a class="dropdown-item" href="notice-single.html">Notice Details</a>
                                <a class="dropdown-item" href="research.html">Research</a>
                                <a class="dropdown-item" href="scholarship.html">Scholarship</a>
                                <a class="dropdown-item" href="course-single.html">Course Details</a>
                                <a class="dropdown-item" href="event-single.html">Event Details</a>
                                <a class="dropdown-item" href="blog-single.html">Blog Details</a>
                            </div>
                        </li>
                        <li class="nav-item @@contact">
                            <a class="nav-link" href="contact.html">CONTACT</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!-- /header -->
<!-- Modal Inscription-->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>inscription</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <form action="#" class="row">
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupNom" name="signupNom"
                                   placeholder="Nom">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupPrenom" name="signupPrenom"
                                   placeholder="Prénom">
                        </div>
                        <div class="col-12">
                            <input type="date" class="form-control mb-3" id="signupDatenaissance"
                                   name="signupDatenaissance" placeholder="Date de naissance">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="signupAdresse" name="signupAdresse"
                                   placeholder="Adresse">
                        </div>
                        <div class="col-12">
                            <input type="number" class="form-control mb-3" id="signupTelephone" name="signupTelephone"
                                   placeholder="Téléphone">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control mb-3" id="signupEmail" name="signupEmail"
                                   placeholder="Email">
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="signupPassword" name="signupPassword"
                                   placeholder="Password">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">SIGN UP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal MotsDePasse-->
<div class="modal fade" id="MDPModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Mots de passe oublié</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1.0">

                    <meta name="description" content=""/>
                    <link rel="icon" sizes="16x16" href="../../images/logoLPRS1.jpg">
                    <meta name="author" content=""/>
                    <!-- Bootstrap css -->
                    <?php include $_SERVER['DOCUMENT_ROOT'] . "/Projet_snack/include/link_css.php";
                    include $_SERVER['DOCUMENT_ROOT'] . "/Projet_snack/include/link_js.php"; ?>
                </head>

                <body style="background-image: url('../../Design/image/backgroundImage.png');">


                <a class="navbar-brand" href="index.html"><img src="images/logoLPRS1.jpg" alt="logo"></a>

                <div class="text-center mt-3">
                    <p class="maintTitle mt-4 ">Recevez un mail pour votre mot de passe oublié</p>
                    <a> Chaque <a class="asterix">*</a>est obligatoire</a>
                </div>

                <!-- Formulaire mot de passe oublié  -->
                <form action="/Projet_snack/traitement/Mdp&Connexion/traitement_mot_de_passe_oublie.php" method="POST">
                    <div class="text-center mb-4 mt-5">
                        <p class="se_connecter">Je ne parviens pas à me connecter à mon compte LPRS </p>
                        <p class="asterix"><?= ((array_key_exists("err", $_GET) && $_GET["err"] == "mail") ? "Une erreur est survenue, l'email saisi n'a pas été reconnu" : "") ?></p>
                        <input type="email" class="inputform" placeholder="Entrez un mail" name="mail"
                               required <?= ((array_key_exists("mail", $_GET)) ? 'value="' . $_GET["mail"] . '"' : "") ?>
                        <button type="submit" name="submit" class="btn btn-primary">Recevoir un mail</button>

                        <br>
                        <!--a href="#" id="cancel_reset"><i class="fas fa-angle-left" aria-hidden="true"></i> Retour</a-->
                    </div>
                </form>
                </body>
                </html>

            </div>
        </div>
    </div>
</div>
<!-- Modal Login-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Login</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../../traitement/connexion-tr.php" class="row">
                    <div class="col-12">
                        <input type="text" class="form-control mb-3" id="login" name="login" placeholder="Login">
                    </div>
                    <div class="col-12">
                        <input type="password" class="form-control mb-3" id="loginMdp" name="loginMdp"
                               placeholder="Mot de passe">

                        <div class="text-center">
                            <div class="text-danger text-center"><?php echo $error_password; ?></div>
                            <div class="text-danger text-center"><?php echo $error_captcha; ?></div>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" href="#"
                                    data-toggle="modal" data-target="#MDPModal" aria-label="Close">Mots de passe oublié
                            </button>
                        </div>

                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="@@page-link">Liste des
                            utilisateurs</a></li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">La liste des utilisateurs inscrit sur le site.</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- table -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table id="utilisateur" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Né.e le</th>
                        <th>Adresse</th>
                        <th>Tél.</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        <th>Activation</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Né.e le</th>
                        <th>Adresse</th>
                        <th>Tél.</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Mot de passe</th>
                        <th>Statut</th>
                        <th>Activation</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- ajouter un utilisateur -->
<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h2 class="text-white">Ajouter un utilisateur</h2>
                    <form method="post" action="../../../traitement/creer-util-tr">
                        <table>
                            <thead></thead>
                            <tbody>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="nom" placeholder="Nom" required maxlength="40">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="prenom" placeholder="Prénom" required maxlength="40">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="date" name="dateNaissance" placeholder="Date de naissance"
                                               required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="adresse" placeholder="Adresse" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="telephone" placeholder="No. Téléphone" required
                                               maxlength="10">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="email" name="mail" placeholder="E-mail" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="text" name="login" placeholder="Login" required maxlength="40">
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <input type="password" name="mdp" placeholder="Mot de passe" required>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label>
                                        <select name="statut" required>
                                            <option name="util" value="0">Utilisateur</option>
                                            <option name="eleve" value="1">Elève</option>
                                            <option name="parent" value="2">Parent</option>
                                            <option name="prof" value="3">Professeur</option>
                                            <option name="admin" value="4">Administrateur</option>
                                        </select>
                                    </label>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                        <td>
                            <input type="submit" value="Ajouter"/>
                        </td>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /table -->

<!-- footer -->
<footer>
    <!-- footer content -->
    <div class="footer bg-footer section border-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
                    <!-- logo -->
                    <a class="logo-footer" href="index.html"><img class="img-fluid mb-4" src="images/logo.png"
                                                                  alt="logo"></a>
                    <ul class="list-unstyled">
                        <li class="mb-2">5 avenue du Général de Gaulle, 93440 Dugny</li>
                        <li class="mb-2">01.48.37.74.26</li>
                        <li class="mb-2">admin@lprs.fr</li>
                    </ul>
                </div>
                <!-- company -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">COMPANY</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="about.html">About Us</a></li>
                        <li class="mb-3"><a class="text-color" href="teacher.html">Our Teacher</a></li>
                        <li class="mb-3"><a class="text-color" href="contact.html">Contact</a></li>
                        <li class="mb-3"><a class="text-color" href="blog.html">Blog</a></li>
                    </ul>
                </div>
                <!-- links -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">LINKS</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="courses.html">Courses</a></li>
                        <li class="mb-3"><a class="text-color" href="event.html">Events</a></li>
                        <li class="mb-3"><a class="text-color" href="gallary.html">Gallary</a></li>
                        <li class="mb-3"><a class="text-color" href="faqs.html">FAQs</a></li>
                    </ul>
                </div>
                <!-- support -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">SUPPORT</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="#">Forums</a></li>
                        <li class="mb-3"><a class="text-color" href="#">Documentation</a></li>
                        <li class="mb-3"><a class="text-color" href="#">Language</a></li>
                        <li class="mb-3"><a class="text-color" href="#">Release Status</a></li>
                    </ul>
                </div>
                <!-- support -->
                <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
                    <h4 class="text-white mb-5">RECOMMEND</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="text-color" href="#">WordPress</a></li>
                        <li class="mb-3"><a class="text-color" href="#">LearnPress</a></li>
                        <li class="mb-3"><a class="text-color" href="#">WooCommerce</a></li>
                        <li class="mb-3"><a class="text-color" href="#">bbPress</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- copyright -->
    <div class="copyright py-4 bg-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-7 text-sm-left text-center">
                    <p class="mb-0">Copyright
                        <script>
                            var CurrentYear = new Date().getFullYear()
                            document.write(CurrentYear)
                        </script>
                        © themefisher
                    </p>
                </div>
                <div class="col-sm-5 text-sm-right text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i
                                        class="ti-facebook text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i
                                        class="ti-twitter-alt text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i
                                        class="ti-linkedin text-primary"></i></a></li>
                        <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i
                                        class="ti-instagram text-primary"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- /footer -->

<!-- jQuery -->
<script type="text/javascript" src="../../../vendor/components/jquery/jquery.min.js"></script>
<!-- DataTables -->
<script type="text/javascript"
        src="../../../vendor/datatables/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../../style/js/datatables.js"></script>
<!-- Bootstrap JS -->
<script src="plugins/bootstrap/bootstrap.min.js"></script>
<!-- slick slider -->
<script src="plugins/slick/slick.min.js"></script>
<!-- aos -->
<script src="plugins/aos/aos.js"></script>
<!-- venobox popup -->
<script src="plugins/venobox/venobox.min.js"></script>
<!-- filter -->
<script src="plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
<script src="plugins/google-map/gmap.js"></script>

<!-- Main Script -->
<script src="js/script.js"></script>

</body>

</html>
