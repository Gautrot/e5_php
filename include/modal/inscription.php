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
                    <form method="POST" action="../../../traitement/inscription-tr.php" class="row">
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="nom" name="nom"
                                   placeholder="nom">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="prenom" name="prenom"
                                   placeholder="prénom">
                        </div>
                        <div class="col-12">
                            <input type="date" class="form-control mb-3" id="dateNaissance"
                                   name="dateNaissance" placeholder="Date de naissance">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="adresse" name="adresse"
                                   placeholder="Adresse">
                        </div>
                        <div class="col-12">
                            <input type="number" class="form-control mb-3" id="telephone" name="telephone"
                                   placeholder="Téléphone">
                        </div>
                        <div class="col-12">
                            <input type="email" class="form-control mb-3" id="mail" name="mail"
                                   placeholder="Mail">
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control mb-3" id="login" name="login"
                                   placeholder="Login">
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="mdp" name="mdp"
                                   placeholder="Password">
                        </div>
                        
                        <div class="col-12">
                        <select name="statut" required>
                            <option name="util" value="0">Utilisateur</option>
                            <option name="eleve" value="1">Elève</option>
                            <option name="parent" value="2">Parent</option>
                            <option name="prof" value="3">Professeur</option>
                            <option name="admin" value="4">Administrateur</option>
                        </select>
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
