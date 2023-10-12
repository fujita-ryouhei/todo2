<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')->get();
        $categories = Category::all();
        return view('index', compact('todos', 'categories'));
    }

    public function store(TodoRequest $request)
    {
        $todos = $request->only(['content', 'category_id']);
        Todo::create($todos);

        return redirect('/')->with('message', 'Todoを作成しました');
    }

    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();

        return redirect('/')->with('message', 'Todoを削除しました');
    }
}
