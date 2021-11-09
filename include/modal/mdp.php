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
                <a class="navbar-brand" href="index">
                    <img src="images/logoLPRS1.jpg" alt="logo">
                </a>
                <div class="text-center mt-3">
                    <p class="maintTitle mt-4 ">Recevez un mail pour votre mot de passe oublié.</p>
                </div>
                <!-- Formulaire mot de passe oublié  -->
                <form action="/e5_php/traitement/MDPoublie.php" method="POST">
                    <div class="text-center mb-4 mt-5">
                        <p class="asterix">
                            <?= ((array_key_exists("err", $_GET) && $_GET["err"] == "mail") ? "Une erreur est survenue, l'email saisi n'a pas été reconnu" : "") ?>
                        </p>
                        <label>
                            <input type="mail" class="inputform" placeholder="Entrer votre mail ICI" name="mail"
                                   required

                        </label>
                        <br>
                        <button type="submit" name="submit" class="btn btn-primary">Recevoir un mail</button>
                        <br>
                        <!--a href="#" id="cancel_reset"><i class="fas fa-angle-left" aria-hidden="true"></i> Retour</a-->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
