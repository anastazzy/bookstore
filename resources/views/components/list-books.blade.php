<div>
    <div class="row p-2">
        @foreach($books as $book)
            <div class="card-group m-1">
                <div class="card"
                     id="card"
                     onclick="window.location.href = '{{url('/book/' . $book->id)}}'">
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
                        <p class="card-text text-success"> {{ $book->sale_price }} ₽</p>
                    </div>
                    <div class="card-footer">
                        @php
                            $count = \App\Basket::getItemCount(Auth::id(), $book->id)
                        @endphp
                        <form method="POST">
                            <div class="input-group mb-1">
                                @csrf
                                <span class="input-group-text">В корзине {{$count}}</span>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" name="count" value="{{$count+1}}" type="submit">+</button>
                                </div>
                                <input type="hidden" name="bookId" value="{{$book->id}}">
                            </div>
                        </form>
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
