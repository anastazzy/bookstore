@extends('layouts.default')

@section('content')

@csrf
<div class="bg-light justify-content-between row">
    <button data-toggle="modal" data-target="#modal" class="btn btn-outline-success my-2 my-sm-0" type="submit">Создать товар</button>
    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Удалить товар</button>
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>
    <div class="row">
@foreach($books as $item)
        <div class="col-md-2">
            <div>
                YOUR IMAGE HERE
            </div>
            <div class="card">
                @php
                    $file = \App\Models\File::query()->find($item->file_id)
                @endphp
                {{$file->path}}
                <img class="card-img-top" src="{{ Storage::url($file->path) }}" alt="Card image cap">
                <div class="card-body">
{{--                    <p>{{$item}}</p>--}}
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
{{--                <button class="btn btn-outline-info my-1 my-sm-0" style="background: url(myimage.png)" type="submit"></button>--}}
            </div>
        </div>
@endforeach
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <form class="w-60 p-3" method="POST" enctype="multipart/form-data">
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
                            <input type="number" class="form-control" name="author_id">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Цена закупки</label>
                                <input type="number" class="form-control" name="purchase_price">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Цена продажи</label>
                                <input type="number"  class="form-control" name="sale_price">
                            </div>
                        </div>
                        <input class="btn btn-primary" type="submit" name="Save" value="Сохранить">
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $('#modal').modal("show")
</script>
@endpush
