<div class="modal" id="modal-tasks">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-tasks-title</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" name="name" id="name"
                               class="form-control"
                               placeholder="Naam"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="description">Beschrijving</label>
                        <input type="text" name="description" id="description"
                               class="form-control"
                               placeholder="Beschrijving"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="activity">Voor activiteit</label>
                        <select class="form-control" name="activity" id="activity">
                            @foreach($activities as $activity)
                                <option value="{{ $activity->id }}">{{$activity->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Opmerking</label>
                        <input type="text" name="comment" id="comment"
                               class="form-control"
                               placeholder="Opmerking"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="minhelper">Min. aantal inschrijvingen</label>
                        <input type="text" name="minhelper" id="minhelper"
                               class="form-control"
                               placeholder="0"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="maxhelper">Max. aantal inschrijvingen</label>
                        <input type="text" name="maxhelper" id="maxhelper"
                               class="form-control"
                               placeholder="0"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="beginuur">Beginuur</label>
                        <input type="time" name="beginuur" id="beginuur"
                               class="form-control"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group">
                        <label for="einduur">Einduur</label>
                        <input type="time" name="einduur" id="einduur"
                               class="form-control"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Taak bewaren</button>
                </form>
            </div>
        </div>
    </div>
</div>