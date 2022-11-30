<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\File;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Books extends Controller
{
    public function create(Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $file = $request->photo;
        $path = Storage::disk('public')->putFile('images', $file);
        $request->validate([
            'name' => 'required|max:512',
            'author_ids' => 'required|array',
            'genre_ids' => 'required|array',
            'warehouse_id' => 'required|int',
            'count' => 'required|int',
            'description' => 'required|max:2048',
            'purchase_price' => 'required',
            'sale_price' => 'required',
        ]);

        $file = new File(['path' => $path]);
        $file->save();

        $book = new Book();
        $book->fill($request->all());
        $book->file_id = $file->id;
        $book->save();

        $book->authors()->sync($request->author_ids);
        $book->warehouses()->attach($request->warehouse_id, ['count' => $request->count]);
        $book->genres()->sync($request->genre_ids);

        return \Redirect::back();
    }

  public function update(Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
  {
    $request->validate([
      'name' => 'required|max:512',
      'author_ids' => 'required|array',
      'genre_ids' => 'required|array',
      'warehouse_id' => 'required|int',
      'count' => 'required|int',
      'description' => 'required|max:2048',
      'purchase_price' => 'required',
      'sale_price' => 'required',
    ]);

    $file = $request->photo;

    DB::beginTransaction();
    try{
      $book = Book::query()->where('id', $request->id)->firstOrFail();

      $book->fill($request->all());

      if($file) {
        $oldFile = File::query()->where('id', $book->file_id)->firstOrFail();
        Storage::disk('public')->delete('images', $oldFile->path);
        //$oldFile->delete();
        $path = Storage::disk('public')->putFile('images', $file);

        $file = new File(['path' => $path]);
        $file->save();

        $book->file_id = $file->id;
      }

      $book->save();
      $book->authors()->sync($request->author_ids);
      $book->warehouses()->sync($request->warehouse_id, ['count' => $request->count]);
      $book->genres()->sync($request->genre_ids);

      DB::commit();
    }
    catch (\Exception $ex){
      DB::rollBack();

      throw $ex;
    }

    return redirect('/book-service');
  }

    public function delete(Request $request) : \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $book = Book::query()->where('id' , $request->id)->firstOrFail();

        //Storage::disk('public')->delete('images', $book->file());
        $book->file()->delete();
        $book->authors()->delete();
        $book->warehouses()->delete();
        $book->genres()->delete();

        $book->delete();

        return \Redirect::back();
    }
}
