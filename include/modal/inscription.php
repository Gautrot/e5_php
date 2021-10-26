<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Inscription</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <form method="POST" action="/e5_php/traitement/inscription-tr.php" style="width:100%">
                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom" required
                                   maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="prenom" name="prenom"
                                   required maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="dateNaissance">Né.e le</label>
                            <input type="date" class="form-control form-control-sm mb-3" id="dateNaissance"
                                   name="dateNaissance" required>
                        </div>
                        <div class="form-group">
                            <label for="telephone">Numéro de Téléphone</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="telephone"
                                   name="telephone" required maxlength="10">
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="adresse" name="adresse"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="mail">Adresse Mél</label>
                            <input type="email" class="form-control form-control-sm mb-3" id="mail" name="mail"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" class="form-control form-control-sm mb-3" id="login" name="login"
                                   required maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="mdp">Mot de passe</label>
                            <input type="password" class="form-control form-control-sm mb-3" id="mdp" name="mdp"
                                   required>
                        </div>
                        <!--
                        <div class="col-12">
                            <label>
                                <select name="statut" required>
                                    <option name="util" value="0">Utilisateur</option>
                                    <option name="eleve" value="1">Elève</option>
                                    <option name="parent" value="2">Parent</option>
                                    <option name="prof" value="3">Professeur</option>
                                    <option name="admin" value="4">Administrateur</option>
                                </select>
                            </label>
                        </div>
                        -->
                        <button type="submit" class="btn btn-primary">
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
