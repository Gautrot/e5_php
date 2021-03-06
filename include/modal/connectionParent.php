<div class="modal fade" id="ConnectionParent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Connection - Parent</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/e5_php/traitement/parent/connexion-tr.php" method="POST" style="width: 100%;">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control mb-3" id="loginParent" name="login" required>
                    </div>
                    <div class="form-group">
                        <label for="loginMdp">Mot de passe</label>
                        <input type="password" class="form-control mb-3" id="loginMdpParent" name="mdp" required>
                    </div>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary m-1" data-dismiss="modal" href="#"
                                data-toggle="modal" data-target="#MDPModal" aria-label="Mot de passe oublié ?">Mot de
                            passe oublié ?
                        </button>
                        <button type="submit" id="submitParent" class="btn btn-primary m-1">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
