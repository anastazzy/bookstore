<div>
    <div class="row p-2">
        @foreach($books as $book)
            <form class="card-group m-1" method="GET" action="{{url('/book/' . $book->id)}}">
                <button class="card" data-target="#modal-detail-{{$book->id}}">
                    <img class="card-img-top" width="500" height="280" src="{{ Storage::url($book->file->path) }}" alt="Card image cap">
                    <div class="card-body">
                        <h6 class="card-title">
                            {{ $book->name }}
                        </h6>
                        @foreach($book->authors as $author)
                            <p class="card-subtitle mb-2 text-muted"> {{ $author->first_name }} {{ mb_substr($author->last_name, 0, 1) }}. {{ mb_substr($author->patronymic, 0, 1) }}.</p>
                        @endforeach
                        <p class="card-text text-success"> {{ $book->sale_price }} рублей</p>
                        <button class="card-text text-info" value="$">
                            {{ $book->sale_price }}
                        </button>
                    </div>
                </button>
            </form>
        @endforeach
    </div>
</div>
