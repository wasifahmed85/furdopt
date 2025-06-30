 <!-- Beginning main content section -->
 <section class="main-content-wrap">
     <section class="chat-content">
         <div class="common-wrap clear">
            
             <div class="chat-body single-chat">
                 <aside class="chat-sidebar">
                   
                     <ul class="conversation-list">


                         <li class="conversation-item">
                             <a href="#" class="conversation-link">
                                 <div class="users-avatar">
                                     <img src="{{ asset('images') }}/{{ $user->avatar ?? 'deafult.jpg' }}"
                                         alt="users-avatar" />
                                 </div>
                                 <div class="users-info">
                                     <div class="users-info-head">
                                         <h6>{{ $user->name }}</h6>
                                         <span> {{ $user->updated_at->diffForHumans() ?? '' }} </span>
                                     </div>
                                 </div>
                             </a>
                         </li>


                     </ul>
                 </aside>
                 <!--Begin tab content-->
                 <div class="conversation-wrap ">



                     @if (isset($sender))
                         <div class="conversation-content  conversation-item">
                             <div class="conversation-head">
                                 <div class="conversation-head-left">
                                    

                                 </div>

                                 <div class="conversation-action" x-data="{ open: false }">
                                     <button id="menu-dropdown-btn" type="button" class="btn-dropdown"
                                         x-on:click="open = ! open">
                                         <i class="jws-icon-dotsthreefill"></i>
                                     </button>
                                     <!-- Begin dropdown -->

                                     <div class="menu-dropdown" x-show="open">
                                         <ul>
                                             <li>
                                                 <a
                                                     wire:click="conversationDelete({{ $user->id }})"style="cursor: pointer"><i
                                                         class="jws-icon-trash"></i> Delete
                                                     conversation</a>
                                             </li>
                                             <li>
                                                 <a wire:click="blockUser({{ $user->id }})"
                                                     style="cursor: pointer"><i class="jws-icon-prohibit"></i> Block
                                                     and report</a>
                                             </li>
                                         </ul>
                                     </div>

                                 </div>
                             </div>
                             <div class="conversation-grid">
                                 <div class="conversation-inner">
                                     {{-- <div class="group-date">
                                                            <span>February 7, 2025</span>
                                                        </div> --}}
                                     {{-- <div class="conversation-text" wire:poll="mountData"> --}}
                                     <div class="conversation-text" wire:poll.5s="mountData">
                                         @if (filled($allmessages))
                                             @foreach ($allmessages as $msg)
                                                 <!--Begin msg sender-->
                                                 @if ($msg->user_id == Auth::user()->id)
                                                     <div class="msg-sender">
                                                         <div class="msg-content">
                                                             <div class="msg-text">
                                                                 <p>{{ $msg->message }}</p>
                                                                 <div class="msg-edit">
                                                                     <i class="jws-icon-dotsthreeoutline"></i>
                                                                 </div>
                                                             </div>
                                                             <div class="time">
                                                                 <span>{{ $msg->created_at->diffForHumans() }}</span>
                                                             </div>
                                                         </div>
                                                         <div class="sender-img">
                                                             <img src="{{ asset('images') }}/{{ Auth::user()->avatar ?? 'deafult.jpg' }}"
                                                                 alt="users-avatar" height="50" width="50" />
                                                         </div>
                                                     </div>

                                                     @if ($msg->media)
                                                         <div class="msg-media">
                                                             <div class="msg-media-content">
                                                                 <img src="{{ asset('images/' . $msg->media) }}"
                                                                     alt="love" />
                                                                 <div class="msg-media-text">
                                                                     <p>{{ $msg->message }}</p>
                                                                 </div>
                                                             </div>
                                                             <div class="sender-img">
                                                                 <img src="{{ asset('images') }}/{{ Auth::user()->avatar ?? 'deafult.jpg' }}"
                                                                     alt="users-avatar" />
                                                             </div>
                                                             <div class="time">
                                                                 <span>{{ $msg->created_at->diffForHumans() }}</span>
                                                             </div>
                                                         </div>
                                                     @endif
                                                     <!-- Begin msg img sender -->
                                                 @else
                                                     <!--Begin msg reciver-->

                                                     <div class="msg-reciver">
                                                         <div class="reciver-img">
                                                             <img src="{{ asset('images') }}/{{ $msg->user->avatar ?? 'deafult.jpg' }}"
                                                                 alt="users-avatar" height="50" width="50" />
                                                         </div>

                                                         <div class="msg-text">
                                                             <p>{{ $msg->message }}</p>
                                                         </div>
                                                         <div class="time">
                                                             <span>{{ $msg->created_at->diffForHumans() }}</span>
                                                         </div>
                                                     </div>

                                                     @if ($msg->media)
                                                         <div class="msg-media">
                                                             <div class="msg-media-content">
                                                                 <img src="{{ asset('images/' . $msg->media) }}"
                                                                     alt="love" />
                                                                 <div class="msg-media-text">
                                                                     <p>{{ $msg->message }}</p>
                                                                 </div>
                                                             </div>
                                                             <div class="sender-img">
                                                                 <img src="{{ asset('images') }}/{{ $msg->user->avatar }}"
                                                                     alt="users-avatar" />
                                                             </div>
                                                             <div class="time">
                                                                 <span>{{ $msg->created_at->diffForHumans() }}</span>
                                                             </div>
                                                         </div>
                                                     @endif
                                                 @endif
                                             @endforeach
                                         @endif
                                     </div>



                                 </div>


                             </div>
                         </div>
                         <form wire:submit.prevent="sendMessage" class="form-create-msg"
                             wire:keydown.enter="sendMessage">
                             <div class="msg-row msg-textarea">
                                 <textarea id="message-input" name="message_content" wire:model.defer="message"></textarea>
                             </div>
                             <div class="msg-row">
                                 <div class="btn-group">
                                     <input type="file" wire:model="media">



                                 </div>


                                 @if (session()->has('error'))
                                     <div class="text-red-500">{{ session('error') }}</div>
                                 @endif
                                 @error('media')
                                     <p class="text-red-500">{{ $message }}</p>
                                 @enderror

                                 <button class="btn-submit" type="submit">
                                     <span class="text">Send<i class="jws-icon-paperplaneright"></i></span>
                                 </button>
                             </div>
                         </form>
                     @else
                     @endif
                 </div>


             </div>
         </div>
     </section>
     <!--Begin Get started section-->

 </section>
 <!-- //End main content section -->


 @script
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const textarea = document.getElementById('message-input');

             if (textarea) {
                 textarea.addEventListener('keydown', function(event) {
                     if (event.key === 'Enter' && !event.shiftKey) {
                         event.preventDefault();
                         const form = document.querySelector('.form-create-msg');
                         if (form) {
                             form.dispatchEvent(new Event('submit'));
                         }
                     }
                 });
             }
         });

         Livewire.on('messageSent', () => {
             document.getElementById('message-input').value = '';
         });
     </script>
 @endscript
