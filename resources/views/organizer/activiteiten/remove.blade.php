<div class="modal" tabindex="-1" role="dialog" id="verwijderactiviteit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activiteit verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u deze activiteit wil verwijderen?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <form id="verwijderform" action="" method="post">

                    @method('delete')
                    @csrf


                    <button type="submit" class="btn btn-danger">Verwijderen</button>
                </form>

            </div>
        </div>
    </div>
</div>