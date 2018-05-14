(function () {
    var getParam = window.location.search;
    var nameGetParam = getParam.slice(0, 7);
    var numberGetParam = getParam.slice(7);
    var newsCounter = document.querySelectorAll('.category-news li');
    var numerator = newsCounter.length / 5 + 1;

    function isNumeric(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    if (!isNumeric(numberGetParam) || nameGetParam !== '?pages=' || numberGetParam === '1' || numberGetParam < '1' || numberGetParam > numerator) {
        for (var i = 0; i < newsCounter.length; i++) {
            if (i < 5) {
                newsCounter[i].style.display = 'block';
            }
        }
    }

    for (var j = 2, k = 5; j < numerator; j++, k += 5) {
        if (numberGetParam === String(j)) {
            for (i = 0; i < newsCounter.length; i++) {
                if (i >= k && i < k + 5) {
                    newsCounter[i].style.display = 'block';
                } else if (i < k && i > k - 5) {
                    newsCounter[i].style.display = 'none';
                }
            }
        }
    }

    if (numberGetParam >= j) {
        for (i = 0; i < newsCounter.length; i++) {
            if (i < 5) {
                newsCounter[i].style.display = 'block';
            }
        }
    }
})();