<div>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Опишите товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @php
                $authors = \App\Models\Author::query()->get();
                $warehouses = \App\Models\Warehouse::query()->get();
                $genres = \App\Models\Genre::query()->get();
            @endphp
            <div class="modal-body">
                <form class="w-60 p-3 has-required" action="{{url('/book')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label class="required">Загрузить фото</label>
                            <input required type="file" class="form-control-file" name="photo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required">Название</label>
                        <input required type="text" class="form-control" name="name">
                    </div>
                    <div class="form-row justify-content-around">
                        <div class="form-group required">
                            <button class="btn btn-success dropdown-toggle" type="button"
                                    id="sampleDropdownMenu" data-toggle="dropdown">
                                Выберите авторов
                            </button>
                            <div class="dropdown-menu">
                                @foreach($authors as $author)
                                    <label>
                                        <input type="checkbox" name="author_ids[]" value="{{$author->id}}" />
                                        {{$author->first_name}} {{$author->last_name}} {{$author->patronymic}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group required">
                            <button class="btn btn-success dropdown-toggle" type="button"
                                    id="sampleDropdownMenu" data-toggle="dropdown">
                                Выберите жанр
                            </button>
                            <div class="dropdown-menu">
                                @foreach($genres as $genre)
                                    <label>
                                        <input type="checkbox" name="genre_ids[]" value="{{$genre->id}}" />
                                        {{$genre->name}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-around">
                        <div class="form-group col-md-6">
                          <label class="required">
                            Выберите склад
                          </label>
                            <select required class="form-control" name="warehouse_id">
                                @foreach($warehouses as $warehouse)
                                        <option value="{{$warehouse->id}}">
                                            {{$warehouse->region}}, {{$warehouse->street}}
                                        </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">Количество</label>
                            <input required type="number" class="form-control" name="count"/>
                        </div>
                    </div>
                    <div class="form-row col-md-10">
                        <label class="required">Описание</label>
                        <input required type="text" class="form-control" name="description">
                    </div>
                    <div class="form-row justify-content-between">
                        <div class="form-group col-md-5">
                            <label class="required">Цена закупки</label>
                            <div class="input-group-append">
                                <input required type="number" min="1" class="form-control" name="purchase_price">
                                <span class="input-group-text">рублей</span>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="required">Цена продажи</label>
                            <div class="input-group-append">
                                <input required type="number" min="1" class="form-control" name="sale_price">
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
