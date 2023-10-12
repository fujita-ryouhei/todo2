@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
    @if(session('message'))
    <div class="todo__alert-success">
        <p>{{ session('message') }}</p>
    </div>
    @endif
    @if($errors->any())
    <div class="todo__alert-error">
        <ul>
            @foreach($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div class="todo">

    <div class="todo__create">
        <div class="todo__create-ttl">
            <h2 class="create-ttl">新規作成</h2>
        </div>
        <form action="/todos" class="create-form" method="post">
            @csrf
            <div class="create-form__item">
                <input type="text" class="create-form__item--input" name="content" value="{{ old('content') }}">
            </div>
            <div class="create-form__category">
                <select name="" id="" class="create-form__category--select">
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-form__button">
                <button class="create-form__button--submit" type="submit">作成</button>
            </div>
        </form>
    </div>

    <div class="todo__search">
        <div class="todo__search-ttl">
            <h2 class="search-ttl">Todo検索</h2>
        </div>
        <form action="/todos" class="search-form" method="post">
            @csrf
            <div class="search-form__item">
                <input type="text" class="search-form__item--input" name="" value="">
            </div>
            <div class="search-form__category">
                <select name="" id="" class="search-form__category--select">
                    @foreach($categories as $category)
                    <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__button">
                <button class="search-form__button--submit" type="submit">検索</button>
            </div>
        </form>
    </div>

    <div class="todo-table">
        <table class="todo-table__inner">

            <tr class="todo-table__row">
                <th class="todo-table__header">
                    <span class="todo-table__header-span">Todo</span>
                    <span class="todo-table__header-span">カテゴリ</span>
                </th>
            </tr>

            @foreach($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form action="/todos/update" method="post" class="todo-table__update">
                        @method('patch')
                        @csrf
                        <div class="update-form-item">
                            <input type="text" class="update-form__item--input" name="content" value="{{ $todo['content'] }}">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        <div class="update-form__item">
                            <p class="update-form__item-p">{{ $todo['category']['name'] }}</p>
                        </div>
                        <div class="update-form__button">
                            <button class="update-form__button--submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="/todos/delete" method="post" class="todo-table__delete">
                        @method('delete')
                        @csrf
                        <div class="delete-form">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class="delete-form__submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>
    </div>
</div>
@endsection