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
                </head>

                <body style="background-image: url('../../Design/image/backgroundImage.png');">


                <a class="navbar-brand" href="index.html"><img src="images/logoLPRS1.jpg" alt="logo"></a>

                <div class="text-center mt-3">
                    <p class="maintTitle mt-4 ">Recevez un mail pour votre mot de passe oublié</p>
                    <a> Chaque <a class="asterix">*</a>est obligatoire</a>
                </div>

                <!-- Formulaire mot de passe oublié  -->
                <form action="/e5_php/traitement/MDPoublie.php" method="POST">
                    <div class="text-center mb-4 mt-5">
                        <p class="se_connecter">Je n'arrive pas à me connecter à mon compte LPRS </p>
                        <p class="asterix"><?= ((array_key_exists("err", $_GET) && $_GET["err"] == "mail") ? "Une erreur est survenue, l'email saisi n'a pas été reconnu" : "") ?></p>
                        <input type="email" class="inputform" placeholder="Entrez un mail" name="mail"
                               required <?= ((array_key_exists("mail", $_GET)) ? 'value="' . $_GET["mail"] . '"' : "") ?> />
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
