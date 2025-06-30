<div class="row">
    <div class="col-md-6">
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
            wire:model="searchTerm">
        <hr>
        {{-- <ul class="contacts-list">
            <li>
                <a href="#">
                    <img class="contacts-list-img" src="../../dist/assets/img/user1-128x128.jpg" alt="User Avatar">
                    <div class="contacts-list-info">
                        <span class="contacts-list-name">
                            Count Dracula
                            <small class="contacts-list-date float-end"> 2/28/2023 </small>
                        </span>
                        <span class="contacts-list-msg">
                            How have you been? I was...
                        </span>
                    </div>
                    <!-- /.contacts-list-info -->
                </a>
            </li>
          
        </ul> --}}
        <ul class="list-unstyled chat-list mt-2 mb-0">

            @foreach ($users as $user)
                <a wire:click="getUser({{ $user->id }})">
                    <li class="clearfix">

                        <img src="{{ asset('images') }}/{{ $user->avatar ?? 'deafult.jpg' }}" alt="users-avatar"
                            height="50" width="50" />
                        <div class="about">
                            <div class="name">{{ $user->name }}</div>
                            <div class="status">
                                <i class="fa fa-circle {{ $user->active_status == 1 ? 'online' : 'offline' }}"></i>

                                @if ($user->active_status == 1)
                                    Online
                                @else
                                    {{-- {{   now() - Auth::user()->last_login_at}} --}}
                                    {{ $user->updated_at->diffForHumans() }}
                                @endif

                            </div>

                        </div>
                    </li>
                </a>
            @endforeach




        </ul>
    </div>
    <div class="col-md-6">
        @if (isset($sender))
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-warning">
                <div class="card-header">
                    <h3 class="card-title">
                        @if (isset($sender))
                            {{ $sender->name }}
                        @endif
                    </h3>
                    <div class="card-tools">
                        {{-- <span title="3 New Messages" class="badge text-bg-warning"> 3 </span>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <button type="button" class="btn btn-tool" title="Contacts" data-lte-toggle="chat-pane">
                            <i class="bi bi-chat-text-fill"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove">
                            <i class="bi bi-x-lg"></i>
                        </button> --}}
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" wire:poll="mountData">
                        @if (filled($allmessages))
                            @foreach ($allmessages as $msg)
                                <!-- Message. Default to the start -->
                                @if ($msg->user_id == $sender->id)
                                    <div class="direct-chat-msg">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-start"> {{ $msg->user->name }} </span>
                                            <span class="direct-chat-timestamp float-end">
                                                {{ $msg->created_at->diffForHumans() }} </span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img"
                                            src="{{ asset('images/') }}/{{ $msg->user->avatar }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{ $msg->message }}
                                            @if ($msg->media)
                                                <img src="{{ asset('storage/images/' . $msg->media) }}" alt="love"
                                                    height="100" width="100" />
                                            @endif
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                @else
                                    <!-- /.direct-chat-msg -->

                                    <!-- Message to the end -->
                                    <div class="direct-chat-msg end">
                                        <div class="direct-chat-infos clearfix">
                                            <span class="direct-chat-name float-end"> {{ Auth::user()->name }} </span>
                                            <span class="direct-chat-timestamp float-start">
                                                {{ $msg->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                        <!-- /.direct-chat-infos -->
                                        <img class="direct-chat-img"
                                            src="{{ asset('images/') }}/{{ Auth::user()->avatar }}"
                                            alt="message user image">
                                        <!-- /.direct-chat-img -->
                                        <div class="direct-chat-text">
                                            {{ $msg->message }}

                                            @if ($msg->media)
                                                <img src="{{ asset('storage/images/' . $msg->media) }}" alt="love"
                                                    height="200" width="200" />
                                            @endif
                                        </div>
                                        <!-- /.direct-chat-text -->
                                    </div>
                                @endif

                                <!-- /.direct-chat-msg -->
                            @endforeach
                        @endif
                    </div>
                    <!-- /.direct-chat-messages-->
                    <!-- Contacts are loaded here -->

                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <form wire:submit.prevent="sendMessage">
                        <div class="input-group">
                            <input type="text" wire:model="message" placeholder="Type Message ..."
                                class="form-control">
                            <span><input type="file" wire:model="media" accept="image/*"></span>
                            <span class="input-group-append">
                                <button type="submit" class="btn btn-warning">Send</button>
                            </span>
                        </div>
                    </form>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.direct-chat -->
        @endif

    </div>

</div>
