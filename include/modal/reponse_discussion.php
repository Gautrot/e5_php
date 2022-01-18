<div class="modal fade" id="reponseDiscusModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Répondre</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <div class="text-center pb-5">
                        Répondre à <?php if (isset($show['idCreateurEleve'])) {
                            echo $show['idCreateurEleve'];
                        } else {
                            echo $show['idCreateurProf'];
                        } ?>:
                    </div>
                    <div class="row justify-content-center">
                        <form method="POST" action="/e5_php/traitement/discussion/reponse-discussion-tr.php"
                              style="width:100%">
                            <div class="form-group">
                                <label for="reponse"></label>
                                <textarea type="text" class="form-control form-control-sm mb-3" id="reponse"
                                          name="reponse" required></textarea>
                            </div>
                            <button type="submit" value="<?= $show['idDiscussion']; ?>"
                                    name="idDiscussion" class="btn btn-primary">Répondre
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
