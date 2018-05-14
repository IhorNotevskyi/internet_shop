<?= $data['crumbs'] ?>
<h2 style="text-align: center; margin-bottom: 30px">Список тегов</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Управление</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data['tags'] as $key => $value) : ?>
            <tr>
                <td><?= $key ?></td>
                <td><?= $value ?></td>
                <td  style="text-align: center">
                    <a href="/admin/news/delete_tag/<?= $key ?>" onclick="return confirmDelete();" style="margin: 0 auto">
                        <button class="btn btn-sm btn-danger">Удалить</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tbody>
    </table>
</div>
<h3 style="margin: 40px 0 15px">Название нового тега:</h3>
<div class="controls">
    <form method="post" autocomplete="off">
        <div class="entry input-group " >
            <input class="form-control" name="new_tags[]" type="text" placeholder="Введите название нового тега">
                <span class="input-group-btn">
              <button class="btn btn-success btn-add" type="button">
                  <span class="glyphicon glyphicon-plus"></span>
              </button>
                </span>
        </div>
        <br> <input type="submit" name="submit" class="btn btn-lg btn-success" value="Добавить тег" style="margin-top: 10px">
    </form>
</div>
<p style="margin: 15px 0 20px; font-size: 12px">Нажмите <span class="glyphicon glyphicon-plus gs"></span>, чтобы добавить сразу несколько новых тегов</p>