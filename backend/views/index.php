<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" />
    <title>Прокат</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row row-header">
                <div class="col-12">
                    <img src="assets/img/logo.png" alt="logo" style="max-height:50px"/>
                    <h1>Прокат</h1>
                </div>
            </div>
            <!-- TODO: реализовать форму расчета -->
            <div class="row row-form">
                <div class="col-12">
                    <h4>Форма расчета:</h4>
                    <form action="/calculate" id="form" method="POST">
                            <label class="form-label" for="product">Выберите продукт:</label>
                            <select class="form-select <?= !empty($pageData['errors']['product']) ? 'error_field' : '' ?>" name="product" id="product">
                                <option value="">выберите</option>
                                <?php foreach($pageData['data']['productList'] as $product) : ?>
                                    <option value="<?= $product['ID'] ?>"><?= $product['NAME'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <?php if (!empty($pageData['errors']['product'])) : ?>
                                <div class="error_notice"><?= $pageData['errors']['product'] ?></div>
                            <?php endif ?>

                            <label for="customRange1" class="form-label">Количество дней:</label>
                            <input type="number" class="form-control <?= !empty($pageData['errors']['customRange1']) ? 'error_field' : '' ?>" name="customRange1" id="customRange1" min="1" max="30" step="1">
                            <?php if (!empty($pageData['errors']['customRange1'])) : ?>
                                <div class="error_notice"><?= $pageData['errors']['customRange1'] ?></div>
                            <?php endif ?>

                            <label for="customRange1" class="form-label">Дополнительно:</label>
                            
                            <?php $i = 1 ?>
                            <?php foreach ($pageData['data']['serviceList'] as $index => $service) : ?>
                                <div class="form-check">
                                    <input class="form-check-input" name="service<?= $i ?>" type="checkbox" value="<?= $service ?>" id="service<?= $i ?>" checked>
                                    <label class="form-check-label" for="service<?= $i ?>">
                                        Дополнительно <?= $index ?> за <?= $service ?>
                                    </label>
                                </div>
                                <?php $i++ ?>
                            <?php endforeach ?>

                            <button type="submit" class="btn btn-primary">Рассчитать</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="assets/js/main.js"></script>
    </body>
</html>