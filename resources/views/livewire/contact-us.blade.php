 <!-- Begin main content section -->
 <div class="main-content contact">
     <!-- Begin Hero section -->
     <section class="hero-wrap"
         style="background-image: url({{ asset('frontendAssets/img/advertise/contact-hero-bg.jpg') }})">
         <div class="common-wrap clear">
             <div class="hero-inner">
                 <div class="hero-text">
                     <h1>Contact</h1>
                 </div>
             </div>
         </div>
     </section>
     <!-- End Hero section -->
     <!-- Begin contact content section -->
     <section class="content">
         <div class="common-wrap clear">
             <div class="content-inner">
                 {{-- <div class="map">
                     <iframe
                         src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8151190.034103154!2d16.433913425731514!3d-4.0053622317455435!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1979facf9a7546bd%3A0x4c63e5eac93f141!2z4KaV4KaZ4KeN4KaX4KeL!5e0!3m2!1sbn!2sbd!4v1741119045837!5m2!1sbn!2sbd"
                         width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                         referrerpolicy="no-referrer-when-downgrade"></iframe>
                 </div> --}}
                 <div class="contact-grid">
                     <div class="contact-info">
                         <h4>Information</h4>
                         <ul class="contact-info-list">
                             <li><i class="fas fa-paper-plane" aria-hidden="true"></i>
                                 <address>{{ $setting->address }}</address>
                             </li>
                             <li><i class="fas fa-phone" aria-hidden="true"></i><a
                                     href="#">{{ $setting->contact }}</a>
                             </li>
                             <li><i class="far fa-envelope" aria-hidden="true"></i><a
                                     href="#">{{ $setting->email }}</a>
                             </li>
                         </ul>
                     </div>
                     <div class="contact-from-wrap">
                         <h4>Send Us A Message</h4>
                         {{ $success }}
                         <form wire:submit="save" class="form contact-form">
                             <div class="form-row">
                                 <input type="text" placeholder="Name*" wire:model="name">
                                 @error('name')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-row">
                                 <input type="email" placeholder="Email*" wire:model="email">
                                 @error('email')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-row">
                                 <input type="text" placeholder="Subject*" wire:model="subject">
                                 @error('subject')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-row">
                                 <textarea placeholder="Massage" wire:model="message"></textarea>
                                 @error('message')
                                     <span class="error">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="form-row">
                                 <input type="submit" class="btn btn-md btn-secondary" value="submit">
                             </div>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- End contact content section -->


 </div>
 <!-- End main content section -->
