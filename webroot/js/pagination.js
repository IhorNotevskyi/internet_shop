var buttons = document.querySelectorAll('.news-pagination li');
var dots = document.querySelector('.dots');

for (var i = 0; i < buttons.length - 2; i++) {
    if (i > 2) {
        buttons[i].style.display = 'none';
    }
}

if (buttons.length === 5) {
    dots.style.display = 'none';
}

function moveDots() {
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].style.display = 'inline';
    }
    dots.style.display = 'none';
}