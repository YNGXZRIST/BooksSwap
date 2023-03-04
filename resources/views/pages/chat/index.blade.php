@extends('layout.index')
@section('content')

    <style>
        .chat-online {
            color: #34ce57
        }

        .chat-offline {
            color: #e4606d
        }

        .chat-messages {
            display: flex;
            flex-direction: column;
            max-height: 800px;
            overflow-y: scroll
        }

        .chat-message-left,
        .chat-message-right {
            display: flex;
            flex-shrink: 0
        }

        .chat-message-left {
            margin-right: auto
        }

        .chat-message-right {
            flex-direction: row-reverse;
            margin-left: auto
        }
        .py-3 {
            padding-top: 1rem!important;
            padding-bottom: 1rem!important;
        }
        .px-4 {
            padding-right: 1.5rem!important;
            padding-left: 1.5rem!important;
        }
        .flex-grow-0 {
            flex-grow: 0!important;
        }
        .border-top {
            border-top: 1px solid #dee2e6!important;
        }
    </style>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>--}}
<div id="app">
    <div class="flex-1 p:2 sm:p-6 justify-between flex flex-col h-screen">
        <div class="flex sm:items-center justify-between py-3 border-b-2 border-gray-200">
            <div class="flex items-center space-x-4">
                <div class="flex flex-col leading-tight">
                    <div class="text-2xl mt-1 flex items-center">
                        <span class="text-gray-700 mr-3">{{ auth()->user()->name }}</span>
                    </div>

                    <span class="text-lg text-gray-600">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
            <chat-messages :user="{{ auth()->user() }}"></chat-messages>
        </div>

        <div class="border-t-2 border-gray-200 px-4 pt-4 mb-2 sm:mb-0">
            <chat-form></chat-form>
        </div>
    </div>
</div>
{{--<h1>Pusher Test</h1>--}}
{{--<p>--}}
{{--    Publish an event to channel <code>my-channel</code>--}}
{{--    with event name <code>my-event</code>; it will appear below:--}}
{{--</p>--}}
{{--<div id="app">--}}
{{--    <ul>--}}
{{--        <li v-for="message in messages">--}}
{{--            {{messages}}--}}
{{--            123--}}
{{--        </li>--}}
{{--    </ul>--}}
{{--</div>--}}


@endsection
