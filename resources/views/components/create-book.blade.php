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
            @php
                $authors = \App\Models\Author::query()->get();
            @endphp
            <div class="modal-body">
                <form class="w-60 p-3" action="{{url('/book')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label>Загрузить фото</label>
                            <input type="file" class="form-control-file" name="photo">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Артикль</label>
                            <input type="number" class="form-control" name="article_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label>Автор</label>
                        <select class="form-control" name="author_id">
                            @foreach($authors as $author)
                                <option value="{{$author->id}}">
                                    {{$author->first_name}} {{$author->last_name}} {{$author->patronymic}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Описание</label>
                        <input type="text" class="form-control" name="description">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Цена закупки</label>
                            <div class="input-group-append">
                                <input type="number" class="form-control" name="purchase_price">
                                <span class="input-group-text">рублей</span>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Цена продажи</label>
                            <div class="input-group-append">
                                <input type="number"  class="form-control" name="sale_price">
                                <span class="input-group-text">рублей</span>
                            </div>
                        </div>
                    </div>
                    <input class="btn btn-primary" type="submit" name="Save" value="Сохранить">
                </form>
            </div>
        </div>
    </div>
</div>
