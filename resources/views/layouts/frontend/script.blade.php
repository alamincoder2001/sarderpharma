<script src="{{asset('frontend')}}/js/jquery.js"></script>
<script src="{{asset('frontend')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('frontend')}}/js/owl.carousel.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    $('.facilities').owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
    $('.newsletters').owlCarousel({
        animateOut: 'slideOutDown',
        animateIn: 'flipInX',
        items: 1,
        margin: 30,
        stagePadding: 30,
        smartSpeed: 450,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
    $('.corporate').owlCarousel({
        loop: true,
        margin: 5,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 4
            },
            600: {
                items: 5
            },
            1000: {
                items: 10
            }
        }
    })
    $('.doctor').owlCarousel({
        loop: true,
        margin: 15,
        nav: false,
        dots: false,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })

    $(".datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true
    });

    $(document).scroll(function() {
        if ($(window).scrollTop() > 10) {
            $("nav").addClass('scroll-hieght')
            $(".ShowSearchBtn").css({top:"82px"})
            $(".SearchBtn").css({height:"35px"})

        } else {
            $("nav").removeClass('scroll-hieght')
            $(".SearchBtn").css({height:"36px"})
        }
        if ($(window).scrollTop() > 400) {
            $(".positionabsolute").css('display', "block")
            $(".positionabsolute").click(function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            })

        } else {
            $(".positionabsolute").css('display', "none")
        }
    })
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function getCity() {
        $.ajax({
            url: "{{route('get.city.all')}}",
            method: "GET",
            dataType: "JSON",
            beforeSend: () => {
                $("#district").append(`<option value="">Select City</option>`)
            },
            success: (response) => {
                $.each(response, (index, value) => {
                    $("#district").append(`<option value="${value.id}">${value.name}</option>`)
                })
            }
        })
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="{{asset('js/select2.js')}}"></script>
<script src="{{asset('js/notify.js')}}"></script>

@stack("js") 