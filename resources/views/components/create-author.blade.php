<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Опишите товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger align-middle">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="modal-body">
                <form class="w-60 p-3 has-required" action="{{url('/author')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="required">Фамилия</label>
                        <input required type="text" class="form-control" name="first_name">
                    </div>
                    <div class="form-group">
                        <label class="required">Имя</label>
                        <input required type="text" class="form-control" name="last_name">
                    </div>
                    <div class="form-group">
                        <label>Отчество</label>
                        <input type="text" class="form-control" name="patronymic">
                    </div>
                    <input class="btn btn-primary" type="submit" name="Save" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
</div>
