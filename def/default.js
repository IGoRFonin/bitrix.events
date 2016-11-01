(function () {
    'use strict';

    var options = {};
    options.steps = {
        "asynchronous-javascript": {
            x: -300, y: -600, scale: 5 },
        "why-asynchronous": {
            x: 3200, y: -1500, scale: 3 },
        "client-side": {
            x: 2600, y: -1100, scale: 1 },
        "server-side": {
            x: 3700, y: -1100, scale: 1  },
        "its-about-external-resources": {
            x: 2600, y: -100, scale: 1  },
        "how-much-waiting-can-cost": {
            x: 2600, y: 400, scale: 1  },
        "better-software-can-multitask": {
            x: 3700, y: 0, scale: 1  },
        "how-io-should-be-done": {
            x: 3700, y: 500, scale: 1  },
        "how-to-write-asynchronous-code": {
            x: 5900, y: -1470, scale: 4 },
        "nodejs-convention": {
            x: 4900, y: -1100, scale: 1  },
        "exercise": {
            x: 5900, y: -1000, scale: 1  },
        "exercise-nodejs": {
            x: 6900, y: -1000, scale: 1  },
        "thank-you": {
            x: 6400, y: 1600, scale: 5 }
    };
    
        document.getElementById('fm1').className = 'fallback-message';
        document.getElementById('fm2').className = 'fallback-message hidden';
        impress.init(options);
    

    hljs.initHighlightingOnLoad();

    if (!document.querySelector || !Array.prototype.forEach) {
        return;
    }
    var forEach = Array.prototype.forEach
      , keys = Object.keys
      , steps = document.querySelectorAll("div.step")

    forEach.call(steps, function (dom, index) {
        if (dom.id !== 'overview') {
            var wrap = document.createElement("div");
            wrap.className = 'wrap';
            while (dom.firstChild) {
                wrap.appendChild(dom.firstChild);
            }
            dom.appendChild(wrap);
            var counter = wrap.appendChild(document.createElement('div'));
            counter.className = "counter";
            counter.innerHTML = (index + 1) + " / " + steps.length;
        }
    });

    var start = Date.now();
    var timerDom = document.getElementById('timer')
      , log = window.TIMELOG = [];

    var durationToStr = function () {
        var now = Date.now()
          , min = String(Math.floor((now - start)/(1000*60)))
          , sec = String(Math.floor((now - start)/(1000))%60);
        return ((min.length > 1) ? min : ('0' + min)) + ':' +
            ((sec.length > 1) ? sec : ('0' + sec));
    };
    // setInterval(function () {
    //     timerDom.innerHTML = durationToStr();
    // }, 1000);


    window.addEventListener("hashchange", function () {
        console.log("HASH CHANGE", location.hash);
        log.push([location.hash, durationToStr()]);
    }, false);

}());
