<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Book;

class BookController extends Controller
{
    public function index() {

        // DBから全てのBookオブジェクトを取得
        $books = Book::all();

        // ルーティング, ビューに渡す値。 値は連想配列(ハッシュで)
        // compact関数は連想配列の記述を簡略化している
        // compact('books')は['books' => $books]と同じ
        // $booksの値をbooks/indexに渡す
        return view('book/index', compact('books'));
    }

    // idを引数に取る
    public function edit($id) {
        // 引数で受け取ったidでBookモデルを取得
        $book = Book::findorFail($id);

        // デバッグ
        // eval(\Psy\sh());

        // $bookの値をbook/editに渡す
        return view('book/edit', ['book' => $book]);
    }

    // $requestにはクライアントからのリクエスト情報が入っている
    // 内容を見る場合は$request->hogeとする
    public function update(BookRequest $request, $id) {

        $book = Book::findorFail($id);

        // フォームから飛んできた値を代入
        $book->name = $request->name;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->save();

        // 更新したら/bookにリダイレクトする
        return redirect('/book');
    }

    public function destroy($id) {
        $book = Book::findorFail($id);
        $book->delete();

        return redirect('/book');
    }

    // createは新規登録ページ
    public function create() {
        // フォーム用の受け皿として空のBookを作成
        $book = new Book();

        // 新規登録ページを表示し、$bookの値を渡す
        return view('book/create', compact('book'));
    }

    // 新規登録用アクション
    public function store(BookRequest $request) {
        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->author = $request->author;
        $book->save();

        return redirect('/book');
    }
}