<div id="main-content main-content2 mt-0 " class="main-content2">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card chat-app">
                    <button id="chat-member-tap" class="btn chat-app-btn"><i class="fa-solid fa-bars"></i></button>
                    <div class="row">
                        <div class="col-md-4">



                            <div id="plist" class="people-list">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="icon-magnifier"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Search..."
                                        wire:model="searchTerm">
                                </div>
                                <ul class="list-unstyled chat-list mt-2 mb-0">

                                    @foreach ($users as $user)
                                        <a wire:click="getUser({{ $user->id }})">
                                            <li class="clearfix">
                                                <img src="{{ asset('images/backend') }}/{{ $user->avatar }}"
                                                    alt="avatar" height="50" width="50" />
                                                <div class="about">
                                                    <div class="name">{{ $user->name }}</div>
                                                    <div class="status">
                                                        <i
                                                            class="fa fa-circle {{ $user->active_status == 1 ? 'online' : 'offline' }}"></i>

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
                                {{-- {{ $users->links() }} --}}
                            </div>
                        </div>
                        <div class="col-md-8">


                            @if (isset($sender))
                                <div class="chat">
                                    <div class="chat-header clearfix">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <a href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#view_info">
                                                    @if (isset($sender))
                                                        <img src="{{ asset('images/backend') }}/{{ $sender->avatar }}"
                                                            alt="avatar" height="50" width="50" />
                                                    @endif
                                                </a>
                                                <div class="chat-about">
                                                    <h1 class="m-b-0"> <b>
                                                            @if (isset($sender))
                                                                {{ $sender->name }}
                                                            @endif
                                                    </h1></b>
                                                    <small>Last seen: 2 hours ago</small>
                                                </div>
                                            </div>

                                            <!-- <div class="col-lg-6 hidden-sm text-right">
                      <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="icon-camera"></i></a>
                      <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="icon-camcorder"></i></a>
                      <a href="javascript:void(0);" class="btn btn-outline-info"><i class="icon-settings"></i></a>
                      <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="icon-question"></i></a>
                  </div> -->
                                        </div>
                                    </div>
                                    <div class="chat-history">
                                        <ul class="m-b-0">
                                            @if (filled($allmessages))
                                                @foreach ($allmessages as $msg)
                                                    {{-- <li class="clearfix" >
                                    <div class="message-data @if ($msg->user_id == Auth::user()->id) text-right @endif">
                                        <span class="message-data-time">{{ $msg->created_at->diffForHumans() }}</span>
                                        <img src="{{ asset('images/backend') }}/{{Auth::user()->avatar }}" alt="avatar" >
                                    </div>
                                    <div class="message other-message float-right"> {{ $msg->message }} </div>
                                </li> --}}


                                                    @if ($msg->user_id == $sender->id)
                                                        <li class="clearfix">
                                                            <div class="message-data text-right">
                                                                <span
                                                                    class="message-data-time">{{ $msg->created_at->diffForHumans() }}</span>
                                                                <img src="{{ asset('images/backend') }}/{{ Auth::user()->avatar }}"
                                                                    alt="avatar" height="50" width="50" />
                                                            </div>
                                                            <div class="message other-message float-right">
                                                                {{ $msg->message }} </div>
                                                        </li>
                                                    @else
                                                        <li class="clearfix">
                                                            <div class="message-data">
                                                                <img src="{{ asset('images/backend') }}/{{ $msg->user->avatar }}"
                                                                    alt="avatar" height="50" width="50" />
                                                                <span
                                                                    class="message-data-time">{{ $msg->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            <div class="message my-message">{{ $msg->message }}</div>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                    <form wire:submit.prevent="sendMessage">
                                        <div class="chat-message clearfix">

                                            <div class="input-group mb-0">

                                                <input wire:model="message" type="text" class="form-control"
                                                    placeholder="Enter text here...">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <button type="submit">
                                                            <i class="icon-paper-plane"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
