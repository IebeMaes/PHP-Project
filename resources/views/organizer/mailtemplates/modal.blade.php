<div class="modal" id="modal-mailtemplate">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">modal-mailtemplate-title</h5>
            <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="post">
                @method('')
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name"
                           class="form-control"
                           placeholder="Naam"
                           minlength="3"
                           required
                           value="">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label for="mailcontent">Inhoud</label>
                    <textarea placeholder="Inhoud" class="form-control h-100" name="mailcontent" id="mailcontent"></textarea>
                    <div class="invalid-feedback"></div>
                </div>
                <button type="submit" class="btn btn-success">Save mailtemplate</button>
            </form>
        </div>
    </div>
</div>
</div>