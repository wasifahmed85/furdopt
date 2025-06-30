@extends('backend.master')



@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Chat History</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Chat History</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <div class="app-content chat-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Messages</h3>
                            <a href="{{ route('admin.chat.index') }}" class="btn btn-secondary float-right"
                                style="float: right">
                                Back to Conversations
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="direct-chat-messages" style="height: 400px; overflow-y: scroll;">
                                @foreach ($messages as $message)
                                    <div class="direct-chat-msg {{ $message->user_id == $user1->id ? '' : 'right' }}">
                                        <div class="direct-chat-infos clearfix">
                                            <span
                                                class="direct-chat-name {{ $message->user_id == $user1->id ? 'float-left' : 'float-right' }}">
                                                {{ $message->sender->name }}
                                            </span>
                                            <span
                                                class="direct-chat-timestamp {{ $message->user_id == $user1->id ? 'float-right' : 'float-left' }}">
                                                {{ $message->created_at->format('M d, Y H:i') }}
                                            </span>
                                        </div>
                                        <div class="direct-chat-text">
                                            @if ($message->media)
                                                <img src="{{ asset('images/' . $message->media) }}" alt="love"
                                                    height="200" width="200" />
                                            @endif
                                            {{ $message->message }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
