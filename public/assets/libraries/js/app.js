// INITIALIZE AOS

AOS.init();

startLoader();

setTimeout(() => {
    exitLoader() 
}, 3000);

isCookieAccepted();

// SHOW HEADER WHEN WINDOW SCROLL

$(window).scroll(function() {
    if($(this).scrollTop() > 200) {
        $('.scroll-top').addClass('active');
    } else {
        $('.scroll-top').removeClass('active');
    }

    $('.scroll-top').on('click', function() {
        $(this).animate({
            scrollTop: $('html, body').scrollTop(0)
        }, 'slow');
    })

});

// HAMBURGER ANIMATION

let isSidebarActive = false;

$('.hamburger-wrapper').click(function() {
    if(!isSidebarActive) {
        $(this).addClass('active');
        $('.sidebar').addClass('active');
        $('.group-content').addClass('blur');
        isSidebarActive = true;
    } else {
        $(this).removeClass('active')
        $('.sidebar').removeClass('active');
        $('.group-content').removeClass('blur');
        isSidebarActive = false;
    }
    
});

$('.group-content').click(function() {
    if(isSidebarActive) {
        $('.hamburger-wrapper').removeClass('active');
        $('.sidebar').removeClass('active');
        $('.group-content').removeClass('blur');
    }
});

// ACCEPT COOKIE

$('#cookie-accept').click(function() {
    localStorage.setItem('isCookieAccepted', 'true');
    isCookieAccepted();
});

// DESCLINE COOKIE

$('#cookie-decline').click(function() {
    localStorage.setItem('isCookieAccepted', 'false');
    $('.cookie-policy').fadeOut();
    setTimeout(() => {
        isCookieAccepted();
    }, 3000);
});

// LOAD LOADER

function startLoader() {
    const loaders = ['.loader-primary', '.loader-secondary', '.loader-tertiary', '.loader-content'];
    let delay = 0;
    
    loaders.forEach((loader) => {
        setTimeout(() => {
            $(loader).css('left', '0');
        }, delay);
        delay += 200;
    });

    setTimeout(() => {
        $('.loader-content .logo-content').fadeIn(500);
    }, delay);
}

function exitLoader() {
    $('.loader-content .logo-content').fadeOut(500, () => {
        const loaders = ['.loader-primary', '.loader-secondary', '.loader-tertiary', '.loader-content'];
        let delay = 200;

        loaders.reverse().forEach((loader) => {
            setTimeout(() => {
                $(loader).css('left', '100%');
            }, delay);
            delay += 200;
        });

        setTimeout(() => {
            $('.loader').fadeOut();
        }, delay);
    });
}

function isCookieAccepted() {
    const isCookieAccepted = localStorage.getItem('isCookieAccepted');
    if(isCookieAccepted === 'true') {
        $('.cookie-policy').slideUp();
    } else {
        $('.cookie-policy').slideDown();
    }
}

let activeIndex = 2; 

function changeLogo(direction) {
    const orgLogos = $('.org-logo');
    const orgDesc = $('.org-description');
    
    $(orgLogos[activeIndex]).removeClass('active');
    $(orgDesc[activeIndex]).removeClass('active');

    activeIndex += direction;

    if (activeIndex < 0) {
        activeIndex = orgLogos.length - 1;
    } else if (activeIndex >= orgLogos.length) {
        activeIndex = 0;
    }

    $(orgLogos[activeIndex]).addClass('active');
    $(orgDesc[activeIndex]).addClass('active');
}

changeLogo(0);
