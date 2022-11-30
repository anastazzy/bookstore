@extends('layouts.default')

@section('content')
<div>
    <div class="col-md-6 offset-3 modal-dialog-centered justify-content-center" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Редактируйте товар</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="w-60 p-3 has-required" method="POST" enctype="multipart/form-data">
                    @csrf
                  <input hidden name="id" value="{{$book->id}}">
                    <div class="form-row">
                      <picture class="rounded mx-auto d-block col-md-5">
                        <img height="300" width="220" src="{{ Storage::url($book->file->path) }}">
                      </picture>
                      <div class="form-group col-md-5">
                        <label>Загрузить новое фото</label>
                        <input type="file" class="form-control-file" name="photo">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="required">Название</label>
                        <input required type="text" value="{{$book->name}}" class="form-control" name="name">
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
                                      @if ($book->authors->firstWhere("id", $author->id))
                                        <input checked type="checkbox" name="author_ids[]" value="{{$author->id}}" />
                                      @else
                                        <input type="checkbox" name="author_ids[]" value="{{$author->id}}" />
                                      @endif
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
                                    @if ($book->genres->firstWhere("id", $genre->id))
                                      <input checked type="checkbox" name="genre_ids[]" value="{{$genre->id}}" />
                                    @else
                                      <input type="checkbox" name="genre_ids[]" value="{{$genre->id}}" />
                                    @endif
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
                                @if ($book->warehouses->firstWhere("id", $warehouse->id))
                                  <option selected="{{$warehouse->id}}" value="{{$warehouse->id}}">
                                    {{$warehouse->region}}, {{$warehouse->street}}
                                  </option>
                                @else
                                <option value="{{$warehouse->id}}">
                                  {{$warehouse->region}}, {{$warehouse->street}}
                                </option>
                                @endif
                              @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="required">Количество</label>
                            <input required type="number" value="{{$book->warehousesCount}}" class="form-control" name="count"/>
                        </div>
                    </div>
                    <div class="form-row col-md-10">
                        <label class="required">Описание</label>
                        <input required type="text" value="{{$book->description}}" class="form-control" name="description">
                    </div>
                    <div class="form-row justify-content-between">
                        <div class="form-group col-md-5">
                            <label class="required">Цена закупки</label>
                            <div class="input-group-append">
                                <input required type="number" value="{{$book->purchase_price}}" min="1" class="form-control" name="purchase_price">
                                <span class="input-group-text">рублей</span>
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <label class="required">Цена продажи</label>
                            <div class="input-group-append">
                                <input required type="number" min="1" value="{{$book->sale_price}}" class="form-control" name="sale_price">
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
@stop
