
(function(){
    var cur = 0, tot = 4, pw = 0, timer;

    function goTo(n) {
        cur = (n + tot) % tot;
        document.getElementById('heroTrack').style.transform = 'translateX(-' + (cur * 25) + '%)';
        document.querySelectorAll('.hero-slide').forEach(function(s, i) {
            s.className = 'hero-slide' + (i === cur ? ' is-active' : '');
        });
        document.querySelectorAll('.hero-ndot').forEach(function(d, i) {
            d.className = 'hero-ndot' + (i === cur ? ' on' : '');
        });
        document.querySelectorAll('.hero-sddot').forEach(function(d, i) {
            d.className = 'hero-sddot' + (i === cur ? ' on' : '');
        });
        pw = 0;
        document.getElementById('heroProgress').style.width = '0%';
        clearInterval(timer);
        timer = setInterval(function() {
            pw += 0.45;
            document.getElementById('heroProgress').style.width = Math.min(pw, 100) + '%';
            if (pw >= 100) goTo(cur + 1);
        }, 22);
    }

    document.getElementById('heroPrev').addEventListener('click', function(){ goTo(cur - 1); });
    document.getElementById('heroNext').addEventListener('click', function(){ goTo(cur + 1); });

    document.querySelectorAll('.hero-ndot').forEach(function(d) {
        d.addEventListener('click', function(){ goTo(+d.getAttribute('data-i')); });
    });
    document.querySelectorAll('.hero-sddot').forEach(function(d) {
        d.addEventListener('click', function(){ goTo(+d.getAttribute('data-i')); });
    });

    goTo(0);
})();