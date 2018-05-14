function correctComment(e) {
    var number = e.dataset.number;
    var digit = e.dataset.digit;

    var commentDate = document.getElementById('comment-date-' + number);
    var currentTime = commentDate.dataset.numeric;

    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', '');
    form.setAttribute('id', 'comment_edit');
    form.setAttribute('onsubmit', 'return checkDateTime()');

    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'id_change_comment');
    input.setAttribute('value', number);
    form.appendChild(input);

    var input = document.createElement('input');
    input.setAttribute('type', 'hidden');
    input.setAttribute('name', 'id_comment_news');
    input.setAttribute('value', digit);
    form.appendChild(input);

    var formGroup = document.createElement('div');
    formGroup.setAttribute('class', 'form-group');
    form.appendChild(formGroup);

    var textArea = document.createElement('textarea');
    textArea.setAttribute('class', 'form-control');
    textArea.setAttribute('name', 'change_comment');
    textArea.style.minHeight = '80px';
    formGroup.appendChild(textArea);

    var commentButtons = document.createElement('div');
    commentButtons.setAttribute('class', 'comment-buttons');
    form.appendChild(commentButtons);

    var submit = document.createElement('button');
    submit.setAttribute('type', 'submit');
    submit.setAttribute('class', 'btn btn-success');
    submit.setAttribute('id', 'unique-success');
    submit.setAttribute('data-cur', currentTime);
    submit.innerHTML = 'Сохранить изменения';
    commentButtons.appendChild(submit);

    var reset = document.createElement('button');
    reset.setAttribute('type', 'reset');
    reset.setAttribute('class', 'btn btn-danger');
    reset.setAttribute('onclick', 'cancelAction()');
    reset.style.marginLeft = '5px';
    reset.innerHTML = 'Отмена';
    commentButtons.appendChild(reset);

    var parentComments = document.getElementById('parent-for-comments');
    var element = document.getElementById('panel-info-' + number);
    parentComments.insertBefore(form, element);

    var panelInfo = document.getElementById('panel-info-' + number);
    var panelBody = document.getElementById('panel-body-' + number);

    if (panelInfo.style.marginLeft != false) {
        form.style.marginLeft = panelInfo.style.marginLeft;
    }

    var textComment = panelBody.innerHTML;
    textArea.innerHTML = textComment;
    textArea.setAttribute('autofocus', 'autofocus');
    panelInfo.style.display = 'none';
}

function checkDateTime() {
    var currentTime = document.getElementById('unique-success');
    var value = currentTime.dataset.cur;

    if ((Date.now() / 1000).toFixed() > (+value + 60.5)) {
        alert('Комментарий можно изменить только в течение 1 минуты после его создания.');
        cancelAction();
        return false;
    } else {
        return true;
    }
}

function cancelAction() {
    var parentComments = document.getElementById('parent-for-comments');
    var form = document.getElementById('comment_edit');
    form.nextElementSibling.style.display = 'block';
    parentComments.removeChild(form);
    location.reload();
}