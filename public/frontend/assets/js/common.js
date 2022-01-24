$(document).ready(function () {
    //small device sidenav
    $(".dropdown_link").click(function () {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).next(".multi_level").addClass("d-none");
        } else {
            $(this).addClass("active");
            $(this).next(".multi_level").removeClass("d-none");
        }
    });

    //pohone and otp toggale
    // $('.btn_tg_sub').on('click', function() {
    //   $('.phone_number').addClass('d-none');
    //   $('.otp_change').toggleClass('d-none');
    // })

    // ratin >> rateyo acitvation
    // function rateYo() {
    //     for (let i = 0; i < $(".rateYo").length; i++) {
    //         $(`.ratSerialId${i}`).rateYo({
    //             starWidth: "20px",
    //             normalFill: "none",
    //             ratedFill: "#F2C94C",
    //             rating: $(`.ratSerialId${i}`).data("user_rating"),
    //             readOnly: true,
    //             starSvg: `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
    //   <path d="M10 1.34175L12.1223 6.62665L12.2392 6.91794L12.5524 6.93918L18.2345 7.32445L13.8641 10.976L13.6232 11.1772L13.6998 11.4817L15.0892 17.0047L10.2659 13.9765L10 13.8096L9.73415 13.9765L4.91081 17.0047L6.30024 11.4817L6.37683 11.1772L6.13594 10.976L1.76551 7.32445L7.44757 6.93918L7.76076 6.91794L7.87773 6.62665L10 1.34175Z" stroke="#F2C94C"/>
    //   </svg>`,
    //         });
    //     }
    // }
    rateYo();
});

// Mega menu js
$(".new_mega_menu").css({
    top: `calc(${$(".navbar").innerHeight()}px - 15px)`,
});
$(".dropdown_content").mouseenter(function () {
    let megaMenuId = $(this).data("mege_menu_id");
    $(`#${megaMenuId}`).addClass("show_mega_menu");
});
$(".dropdown_content").mouseleave(function () {
    let megaMenuId = $(this).data("mege_menu_id");
    $(`#${megaMenuId}`).removeClass("show_mega_menu");
});

$(".new_mega_menu").mouseenter(function () {
    $(this).addClass("show_mega_menu");
});
$(".new_mega_menu").mouseleave(function () {
    $(this).removeClass("show_mega_menu");
});

$(".filter_clear_btn").click(function () {
    console.log($(this).data("input_name"));
    $(`input[name ="${$(this).data("input_name")}"]`).prop("checked", false);
    book_fetch();
});

// Enable Tooltip
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

$('.nav_search input').mouseenter(function () {
    $('.autoCompleteBox').addClass('autoCompleteBoxShow')
  })
  $('.nav_search input').mouseleave(function () {
    $('.autoCompleteBox').removeClass('autoCompleteBoxShow')
  })
  
  $('.autoCompleteBox').mouseenter(function () {
    $('.autoCompleteBox').addClass('autoCompleteBoxShow')
  })
  
  $('.autoCompleteBox').mouseleave(function () {
    $('.autoCompleteBox').removeClass('autoCompleteBoxShow')
  })
