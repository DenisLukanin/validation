<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Валидация</title>
</head>
<body>
    <div class="container">

        <h1>Валидация</h1>

        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Проверяемое значение</label>
            <input type="text" class="form-control input" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div class="warning text-danger"></div>
        </div>
        <span class="submit btn btn-primary">Отправить</span>

        
        <table class="table my-5">
            <thead>
                <tr>
                <th scope="col">Выражение</th>
                <th scope="col">Результат</th>
                </tr>
            </thead>
            <tbody class="result">
                <?php 
                    $results = select()->fetchAll(PDO::FETCH_ASSOC);
                    foreach($results as $result) { ?>
                        <tr class="table-<?= $result["status"] ? "success" : "danger" ?>">
                        <td><?= $result["validateString"] ?></td>
                        <td><?= $result["status"] ? "Успех" : "Провал" ?></td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </div>


    <script src="static/js/script.js"></script>
</body>
</html>