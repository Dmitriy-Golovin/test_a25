<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" />
        <title>Стоимость проката</title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <a href="/">вернуться</a>
            </div>
            <div class="row row-header">
                <div class="col-12">
                    <img src="assets/img/logo.png" alt="logo" style="max-height:50px"/>
                    <h1>Стоимость проката</h1>
                </div>
            </div>
            <div class="row">
                <p class="result_item">Ваш выбор: <?= $pageData['data']['product'] ?></p>
                <p class="result_item">Срок (день): <?= $pageData['data']['dayNumber'] ?></p>
                <p class="result_item">Общая стоимость: <?= $pageData['data']['cost'] ?></p>
            </div>
        </div>
    </body>
</html>