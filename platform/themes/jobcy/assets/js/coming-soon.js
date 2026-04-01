'use strict'

document.addEventListener('DOMContentLoaded', function () {
    let countdown = document.getElementById('countdown')
    if (countdown) {
        let d = new Date(countdown.getAttribute('data-datetime')).getTime()

        let i = setInterval(function () {
            let t = new Date().getTime(),
                n = d - t,
                e =
                    '<div class="countdownlist-item"><div class="count-title">' +
                    window.siteConfig.countdown.days +
                    '</div><div class="count-num">' +
                    Math.floor(n / 864e5) +
                    '</div></div><div class="countdownlist-item"><div class="count-title">' +
                    window.siteConfig.countdown.hours +
                    '</div><div class="count-num">' +
                    Math.floor((n % 864e5) / 36e5) +
                    '</div></div><div class="countdownlist-item"><div class="count-title">' +
                    window.siteConfig.countdown.minutes +
                    '</div><div class="count-num">' +
                    Math.floor((n % 36e5) / 6e4) +
                    '</div></div><div class="countdownlist-item"><div class="count-title">' +
                    window.siteConfig.countdown.seconds +
                    '</div><div class="count-num">' +
                    Math.floor((n % 6e4) / 1e3) +
                    '</div></div>'
            countdown.innerHTML = e
            if (n < 0) {
                clearInterval(i)
                countdown.innerHTML = '<div class="countdown-endtxt">' + window.siteConfig.countdown.ended + '</div>'
            }
        }, 1e3)
    }
})
