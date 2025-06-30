(function ($) {
    $(function () {
       
        /* Hp header */
        $(".menu-icon").click(function () {
            $(".main-nav").addClass("open");
            $(".main-nav-wrap").addClass("open");
          });
          $("#closeBtn").click(function () {
            $(".main-nav").removeClass("open");
            $(".main-nav-wrap").removeClass("open");
          });
          // home nav sub menu toggle
          $(".dropdown").click(function () {
            $(this).next("div").slideToggle();
          });

          // user menu dropdown
         
        $('.user-menu-wrap').click(function () {
            $('.user-dropdown-menu').slideToggle('open');
        });


        // hero search box
    $(".search-item").click(function () {
        $(".search-item").removeClass("active");
        $(this).addClass("active");
      });

      // other pet menu
      $("#other-search").click(function () {
        $(".search-dropdown").fadeToggle(200);
      });
      $(".search-dropdown").click(function (e) {
        let otherPetName = document.getElementById("search-name");
        otherPetName.innerText = e.target.innerText;
      });

      // selectric
      if ($('select.select-input').length) {
        $('select.select-input').selectric({});
    }

      /*  FAQs Accordion Function */
        
      $(".checklist-collapse-wrap").each(function () {
        var $this = $(this);
        $this.find(" > .checklist-collapse-head").on("click touch", function () {
            $(".checklist-collapse-wrap").removeClass("active")
            $(".checklist-collapse-wrap .checklist-collapse-body").slideUp();
            if ($this.find(".checklist-collapse-body:visible").length) {
                $(".checklist-collapse-wrap").removeClass("active")
                $(".checklist-collapse-wrap .checklist-collapse-body").slideUp();
            } else {
                $this.addClass("active")
                $(".checklist-collapse-wrap .checklist-collapse-body").slideUp();
                $this.find(" > .checklist-collapse-body").slideDown();
            }
        })
    })
    /*  FAQs Accordion Function */
      /*  FAQs Accordion Function */
        
      $(".accordion-row").each(function () {
        var $this = $(this);
        $this.find(" > .accordion-title").on("click touch", function () {
            $(".accordion-row").removeClass("active")
            $(".accordion-row .accordion-info").slideUp();
            if ($this.find(".accordion-info:visible").length) {
                $(".accordion-row").removeClass("active")
                $(".accordion-row .accordion-info").slideUp();
            } else {
                $this.addClass("active")
                $(".accordion-row .accordion-info").slideUp();
                $this.find(" > .accordion-info").slideDown();
            }
        })
    })
    /*  FAQs Accordion Function */

     // Buyers checklist  modal
     $('.buyers-checklist-btn').click(function () {
      $('#checklist-modal').slideToggle('open');
  });
  $('#modal-close').click(function (e) {
      e.preventDefault();
      $('#checklist-modal').slideUp('open');
  });
// Carousel
    var swiper = new Swiper(".pdp-slider-thumbnail", {
      loop: true,
      slidesPerView: 9,
      spaceBetween: 8,
      freeMode: true,
      watchSlidesProgress: true,
      
    });
    var swiper2 = new Swiper(".pdp-slider", {
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        type: "fraction",
      },
      thumbs: {
        swiper: swiper,
      },
    });

   
       
    }); // End ready function.
})(jQuery);

// custom js
