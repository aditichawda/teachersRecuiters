/******/ (() => { // webpackBootstrap
/*!***********************************************************!*\
  !*** ./platform/themes/jobzilla/assets/js/coming-soon.js ***!
  \***********************************************************/
$(function () {
  function myTimer() {
    var ending = $('#timer').attr('data-endtime'),
      endTime = new Date(ending);
    endTime = Date.parse(endTime) / 1000;
    var now = new Date();
    now = Date.parse(now) / 1000;
    var timeLeft = endTime - now;
    var days = Math.floor(timeLeft / 86400);
    var hours = Math.floor((timeLeft - days * 86400) / 3600);
    var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
    var seconds = Math.floor(timeLeft - days * 86400 - hours * 3600 - minutes * 60);
    if (days < '10') {
      days = '0' + days;
    }
    if (days < '1') {
      days = '0';
    }
    if (hours < '10') {
      hours = '0' + hours;
    }
    if (hours < '1') {
      hours = '0';
    }
    if (minutes < '10') {
      minutes = '0' + minutes;
    }
    if (minutes < '1') {
      minutes = '0';
    }
    if (seconds < '10') {
      seconds = '0' + seconds;
    }
    if (seconds < '1') {
      seconds = '0';
    }
    $('#timer').removeClass('d-none');
    $('#timer #days time').html(days);
    $('#timer #hours time').html(hours);
    $('#timer #minutes time').html(minutes);
    $('#timer #seconds time').html(seconds);
  }
  setInterval(function () {
    myTimer();
  }, 1000);
});
/******/ })()
;