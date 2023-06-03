@extends('layout.index')
@section('content')

    <script src="https://cdn.tailwindcss.com"></script>
    <div id="app" style="display: flex;flex-direction: row">
        <chats-list :user="{{ auth()->user() }}">
        </chats-list>
    </div>
@endsection
