$(document).ready(function() {

    // HAMBURGER
    let isActive = false;
    $('.hamburger-wrapper').on('click', () => {
        if(!isActive) {
            $('.hamburger-wrapper').addClass('active');
            $('.sidebar').addClass('active');
            $('.content').addClass('active');
            $('.logo h4').addClass('active');
            $('.icon').attr('data-bs-toggle', '');
            $('.multi-collapse').collapse('hide');
            isActive = true;
        } else {
            $('.hamburger-wrapper').removeClass('active');
            $('.sidebar').removeClass('active');
            $('.content').removeClass('active');
            $('.logo h4').removeClass('active');
            $('.icon').attr('data-bs-toggle', 'collapse');
            isActive = false;
        }
    });

    // $(window).on('resize', () => {
    //     alert(); 
    // });

    $(window).on('scroll', () => {
        const scrollTop = $(window).scrollTop();
        if(scrollTop > 50) {
            $('.navbar').addClass('active');
            $('.scroll-top').addClass('active');
        } else {
            $('.navbar').removeClass('active');
            $('.scroll-top').removeClass('active');
        }
    });

    $('.multi-collapse').on('show.bs.collapse', function () {
        $('.multi-collapse').not(this).collapse('hide');
    });

    $('.scroll-top').on('click', () => {
        $('html, body').animate({
            scrollTop: $('html, body').offset().top
        }, 'slow') 
    });

    // TOGGLE THEME

    let isDark = false;
    $('#btn-toggle-theme').on('click', () => {
        if(!isDark) {
            $('body').addClass('dark');
            $('#btn-toggle-theme').html('<i class="bx bxs-sun"></i> Switch Light ');
            $('.logo img').attr('src', '/assets/admin/images/logo-light.png');
            isDark = true;
        } else {
            $('body').removeClass('dark');
            $('#btn-toggle-theme').html('<i class="bx bx-moon"></i> Switch Dark ');
            $('.logo img').attr('src', '/assets/admin/images/logo-dark.png');
            isDark = false;
        }
    });

    // INITIALIZE DATATABLE

    $('table').DataTable({
        "scrollX": true,
        "autoWidth": true
    });

    $('#news-form select#category').on('change', function() {
        if($(this).val() == 'news') {
            $('#news-form .other').html(`
            <div class="col-12 col-md-12 mb-3">
                <label class="fw-bold">Content Images</label>
                <div class="d-flex gap-3 mt-2">
                    <div class="dropbox d-flex justify-content-center align-items-center">
                        <input type="file" name="content-image[]" id="content-image" multiple>
                    </div>
                </div>
            </div>
            `);   
        } else {
            $('#news-form .other').empty();
        }
    });
    

});

