// ######## jquery #######
$(document).ready(function () {
    $(".card-header").click(function () {

        // Accordéon
        if ($(this).next(".card-body").hasClass("active")) {
            $(this).next(".card-body").removeClass("active").slideUp()
            $(this).children("span").removeClass("fa-minus").addClass("fa-plus")
        }
        else {
            $(".card .card-body").removeClass("active").slideUp()
            $(".card .card-header span").removeClass("fa-minus").addClass("fa-plus")
            $(this).next(".card-body").addClass("active").slideDown()
            $(this).children("span").removeClass("fa-plus").addClass("fa-minus")
        }

    })
    // Go to top
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $(".gotopbtn").fadeIn();
        } else {
            $(".gotopbtn").fadeOut();
        }
    })
})
