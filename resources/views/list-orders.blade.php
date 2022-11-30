<div>
  <div class="row p-2">
    @foreach($books as $book)
      <div class="card-group m-1">
        <div class="card"
             id="card">
          <div onclick="window.location.href = '{{url('/book/' . $book->id)}}'">
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
          </div>
          <div class="card-footer">
            @php
              $count = \App\Basket::getItemCount(Auth::id(), $book->id)
            @endphp
            @if ($book->warehousesCount > $count)
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
            @else
              <div class="input-group mb-1">
                <span class="input-group-text">В корзине {{$count}}</span>
                <div class="input-group-append" id="example" data-toggle="popover" data-content="В наличи всего {{$book->warehousesCount}} шт.!">
                  <button style="pointer-events: none;" type="button" class="btn btn-outline-secondary">+</button>
                </div>
              </div>
            @endif
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

<script>
  $('#example').popover({
    trigger: 'hover'
  })
</script>
