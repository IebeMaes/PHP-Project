<div class="modal" tabindex="-1" role="dialog" id="verwijderorganisator">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Organisator verwijderen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Weet u zeker dat u deze organisator wil verwijderen?</p>
            </div>
            <div class="modal-footer">
                <button data-toggle="toolip" data-title="Gaat terug naar het overzicht." type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                <form id="verwijderform" action="" method="post">

                    @method('delete')
                    @csrf


                    <button data-toggle="tooltip" data-title="Deze knop verwijdert de organisator. LET OP: dit kan niet ongedaan gemaakt worden." type="submit" class="btn btn-danger">Verwijderen</button>
                </form>

            </div>
        </div>
    </div>
</div>