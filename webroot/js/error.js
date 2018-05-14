(function () {
    var hiddenItems = document.querySelectorAll('.banner');
    for (var i = 0; i < hiddenItems.length; i++) {
        if (i === 0 || i === 4) {
            hiddenItems[i].style.visibility = 'hidden';
        } else {
            hiddenItems[i].style.display = 'none';
        }
    }
})();