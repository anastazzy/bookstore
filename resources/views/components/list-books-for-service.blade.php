<div>
    <div class="row p-2">
        @foreach($books as $book)
            <div class="card-group m-1">
                <div class="card"
                     id="card"
                     onclick="window.location.href = '{{url('/update-book/' . $book->id)}}'">
                    <img class="card-img-top" width="500" height="280" src="{{ Storage::url($book->file->path) }}" alt="Card image cap">
                    <div class="card-body text-center">
                        <h6 class="card-title">
                            {{ $book->name }}
                        </h6>
                        @foreach($book->authors as $author)
                            <p class="card-subtitle mb-2 text-muted">
                                {{ $author->first_name }} {{ mb_substr($author->last_name, 0, 1) }}. {{ mb_substr($author->patronymic, 0, 1) }}.
                            </p>
                        @endforeach
                        <div class = "card-text">
                            Цена продажи: {{ $book->sale_price }} ₽ <br>
                            Цена закупки: {{ $book->purchase_price }} ₽ <br>
                            @php
                                $count = 0;
                            foreach($book->warehouses as $warehouse){
                                $count = $count + $warehouse->pivot->count;
                            }
                            @endphp
                            На складах: {{ $count }} шт. <br>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <form method="POST" action="{{url('/book-service/update-book')}}">
                                @csrf
                                <button class="btn btn-outline-info small" type="submit">Изменить</button>
                                <input type="hidden" name="id" value="{{$book->id}}">
                            </form>
                            <form method="POST" action="{{url('/book-service')}}">
                                @csrf
                                <button class="btn btn-outline-danger small" type="submit">Удалить</button>
                                <input type="hidden" name="id" value="{{$book->id}}">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<style>
    .card:hover {
        outline: 1px solid #6c757d;
    }
</style>
