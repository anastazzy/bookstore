<div>
    <div class="row p-2">
        @foreach($books as $book)
            <div class="col-md-2">
                <div class="card">
                    @php
                        $file = \App\Models\File::query()->find($book->file_id)
                    @endphp
                    <img class="card-img-top" src="{{ Storage::url($file->path) }}" alt="Card image cap">
                    <div class="card-body">
                        <p class="card-text"> {{$book->name}}</p>
                        <p class="card-text"> {{$book->sale_price}}</p>
                    </div>
                    {{--                <button class="btn btn-outline-info my-1 my-sm-0" style="background: url(myimage.png)" type="submit"></button>--}}
                </div>
            </div>
</div>
