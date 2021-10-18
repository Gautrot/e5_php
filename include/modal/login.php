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
                <form action="../../../traitement/connexion-tr" method="POST" class="row">
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
