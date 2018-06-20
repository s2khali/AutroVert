$(function() {

    // RESPOND TO REQUEST DROP DOWN
    $('.profileActions').on({
        mouseenter: function () {
            $(this).find('.uiMenu').show('fast');
        },
        mouseleave: function () {
            $('.uiMenu').hide();
        }
    }, '.navButton[data-value="respond"]');

    // FREINDS DROP DOWN
    $('.profileActions').on({
        mouseenter: function () {
            $(this).find('.uiMenu').show('fast');
        },
        mouseleave: function () {
            $('.uiMenu').hide();
        }
    }, '.navButton[data-value="friends"]');

    // REQUESTED DROP DOWN
    $('.profileActions').on({
        mouseenter: function () {
            $(this).find('.uiMenu').show('fast');
        },
        mouseleave: function () {
            $('.uiMenu').hide();
        }
    }, '.navButton[data-value="requestSent"]');

    // FOLLOWING DROP DOWN
    $('.profileActions').on({
        mouseenter: function () {
            $(this).find('.uiMenu').show('fast');
        },
        mouseleave: function () {
            $('.uiMenu').hide();
        }
    }, '.navButton[data-value="following"]');
})
