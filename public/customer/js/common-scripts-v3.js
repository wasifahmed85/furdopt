(function ($) {
    $(function () {
        // Phone nav click function
        $('.hamburger').click(function () {
            $('body').addClass('navShown');
        });

        $('.menu-close').click(function () {
            $('body').removeClass('navShown');
        });
        // profile menu toggle
        $('.profile-container').click(function () {
            $('.dropdown-menu').slideToggle(200);
        });
        // profile edit modal
        /* $('#edit-modal').click(function (e) {
            e.preventDefault();
            $('.profile-edit-modal-container').fadeIn();
            $('.profile-edit-modal-container').css({ display: 'flex' });
            $('body').css({ overflow: 'hidden' });
        });
        $('.profile-edit-close').click(function () {
            $('.profile-edit-modal-container').fadeOut();
            $('.profile-edit-modal-container').css({ display: 'none' });
            let el = document.querySelector('body');
            el.removeAttribute('style');
        }); */

        /* Hp header */
        $(".menu-icon").click(function () {
            $(".main-nav").addClass("open");
            $(".main-nav-container").addClass("open");
          });
          $("#closeBtn").click(function () {
            $(".main-nav").removeClass("open");
            $(".main-nav-container").removeClass("open");
          });
          // home nav sub menu toggle
          $(".dropdown").click(function () {
            $(this).next("div").slideToggle();
          });
           // profile nav Accordion Function
             let currentLink = window.location.pathname.split("/");
             let currentPage = currentLink[currentLink.length - 1];
            let el = $("a[href='" + currentPage + "']");
            el.addClass("curent");
            el.closest(".profile-nav-list").addClass("active");

            $(".profile-nav-item .profile-nav-title").each(function () {
            let $this = $(this);
            $this.on("click touch", function () {
                $(this).find(".profile-nav-list").slideDown();

                if ($this.parent().find(".profile-nav-list:visible").length) {
                $this.parent().find("profile-nav-list").slideUp();
                } else {
                $("profile-nav-list").slideUp();
                $this.parent().find(".profile-nav-list").slideDown();
                }
            });
            });
            
            $('.user-menu-dropdown-wrap').click(function () {
            $('.user-dropdown-menu').slideToggle('open');
        });
    
        if ($('select.filter-selectric').length) {
            $('select.filter-selectric').selectric({});
        }
       
        /* if($(".styled-select").length){
            $('.styled-select').selectric();
         }
 */
        // toggle display modal
        $('#modal-toggle').click(function () {
            $('#discover-filter-modal').toggleClass('open');
        });
        $('#filter-reset').click(function (e) {
            e.preventDefault();
            $('#discover-filter-modal').removeClass('open');
        });
        // gift modal toggle
        $('#giftBtn').click(function () {
            $('.gift-modal').toggleClass('open');
        });

        // upload modal toggle
        $('#upload-btn').click(function () {
            $('.upload-container').toggleClass('open');
            $("#chat-file-upload").fadeToggle(200);
        });

        // search page dropdown toggle
        $('.btn-dropdown').click(function (e) {
            let menuElement = e.currentTarget.nextElementSibling;

            if (menuElement.classList.contains('open')) {
                menuElement.classList.remove('open');
            } else {
                $('.menu-dropdown').removeClass('open');
                menuElement.classList.add('open');
            }
        });

        // open inbox on click
        $('.conversation-item').click(function (e) {
            e.preventDefault();
            $('#start-new-message').addClass('closed');
            $('#messages').removeClass('closed');
        });

        /*tab*/
        $('.activities-tab-list > li').removeClass('active');
        $('.activities-tab-list > li').eq(0).addClass('active');

        $('.activities-tab-list > li').each(function (i) {
            $(this).click(function () {
                if ($(this).hasClass('active')) return false;
                else {
                    $('.activities-tab-list > li').removeClass('active');
                    $(this).addClass('active');
                    $('.activities-tab-content > div.activities-tab-item').hide();
                    $('.activities-tab-content > div.activities-tab-item').eq(i).show();
                }
            });
        });


         /*My listing from tab*/
         $('.type-selection-tab-list > li').removeClass('active');
         $('.type-selection-tab-list > li').eq(0).addClass('active');
 
         $('.type-selection-tab-list > li').each(function (i) {
             $(this).click(function () {
                 if ($(this).hasClass('active')) return false;
                 else {
                     $('.type-selection-tab-list > li').removeClass('active');
                     $(this).addClass('active');
                     $('.type-selection-tab-body > div.type-selection-tab-item').hide();
                     $('.type-selection-tab-body > div.type-selection-tab-item').eq(i).show();
                 }
             });
         });

         //My listing table dropdown
         $('.actions-dot').click(function (e) {
            let menuElement = e.currentTarget.nextElementSibling;

            if (menuElement.classList.contains('open')) {
                menuElement.classList.remove('open');
            } else {
                $('.actions-dropdown').removeClass('open');
                menuElement.classList.add('open');
            }
        });

       /*   $('textarea.default-editor').tinymce({
            height:292,
            menubar: false,
            plugins: [
              'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
              'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
              'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | bold italic backcolor | ' +
              'alignleft aligncenter alignright alignjustify | ' +
              'bullist numlist outdent indent | removeformat | help'
          }); */

         // base page range function
        $("#heightSlider").on("input", function () {
            $("#heightValue").text($(this).val());
        });
        $("#weightSlider").on("input", function () {
            $("#weightValue").text($(this).val());
        });
        // slide toggle advance search
        $('#slide-toggle-btn').click(function () {
            $('.filter-modal-form').animate(
                { scrollTop: $('.filter-modal-form')[0].scrollHeight },
                500
            );
            $('#advance-search-options').slideToggle(500); // Toggle with slide effect (500ms)
        });

        $('.mega-menu').parent('div').addClass('drop-down');
        $('.drop-down').each(function () {
            var $$this = $(this);
            $$this.find('> .profile-inner').click(function (e) {
                e.preventDefault();
                $('.mega-menu').slideToggle();
            });
        });

        $(".visibility-toggle").click(function (e) {
            e.preventDefault();
            $(this).closest(".form-row").find(".visibility-settings").slideDown();
            $(this).closest(".settings-toggle").slideUp(200);
          });
        $(".visibility-close").click(function (e) {
            e.preventDefault();
            $(this).closest(".form-row").find(".visibility-settings").slideUp();
            $(this).closest(".form-row").find(".settings-toggle").slideDown(200);
          });

 
        // swiper carosel
        var swiper = new Swiper('.story-carousel', {
            slidesPerView: 3,
            spaceBetween: 5,

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                500: {
                    slidesPerView:3,
                    spaceBetween: 10,
                },

                768: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                992: {
                    slidesPerView: 3,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            },
        });
        
    }); // End ready function.
})(jQuery);

// custom js
