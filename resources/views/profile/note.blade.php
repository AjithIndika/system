<div class="mt-1 mb-1">
    <button type="button" class="btn btn-success mb-5 mt-1" class="btn btn-primary" data-toggle="modal"
        data-target="#newNote"> <i class="bi bi-plus" style="">New Note</i></button>
    <!----  <i class="bi bi-journals text-success" style="font-size: 1.5rem;" data-toggle="modal" data-target="#newNote"></i> !------>
</div>




@foreach ($data['profileNotes'] as $profileNotes)
    <div class="card">
        <div class="card-header">
            {{ $profileNotes->new_titel }}
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p>{{ $profileNotes->new_note }}</p>
                <footer class="blockquote-footer">{{ $profileNotes->note_by }}<cite title="Source Title">&nbsp; &nbsp;
                        {{ $profileNotes->note_date }}</cite></footer>
            </blockquote>
        </div>
    </div>
@endforeach







<div class="modal fade " id="newNote">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">New Note</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <form action="/new-notes-addd" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Titel:</label>
                        <input type="text" class="form-control" id="email" name="new_titel" required>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Note:</label>
                        <textarea class="form-control" name="new_note" required></textarea>
                    </div>


                    <input type="hidden" value="{{ $profile[0]->profile_id }}" name="account_profile_id">
                    <input type="hidden" value="{{ $profile[0]->profile_number }}" name="profile_number">
                    <input type="hidden" value="{{ $profile[0]->profile_sug }}" name="profile_sug">

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

