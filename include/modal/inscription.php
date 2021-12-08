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
                    <div class="text-center pb-5">
                        Inscrivez-vous en tant que :
                    </div>
                    <div class="row justify-content-center">
                        <form action="/e5_php/view/eleve/inscr-eleve" method="post">
                            <button type="submit" class="btn btn-dark m-1">Étudiant</button>
                        </form>
                        <form action="/e5_php/view/parent/inscr-parent" method="post">
                            <button type="submit" class="btn btn-info m-1">Parent</button>
                        </form>
                        <form action="/e5_php/view/prof/inscr-prof" method="post">
                            <button type="submit" class="btn btn-warning m-1">Professeur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
