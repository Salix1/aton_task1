<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head lang="ru">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
<link rel="icon" href="/img/favicon.png" />

<title>Ноутбуки, популярные в апреле 2023 года</title>
</head>

<body>
    <header>
        <h1 class="header-text">Ноутбуки, популярные в апреле 2023 года</h1>
    </header>
    <div class="nav-placeholder"></div>
    <nav>
        <div class="sorting-menu">
            <div class="filter">
                <p>Фильтрация:</p>
                <input class="filter-input" type="text" name="" id="">
            </div>
            <div class="sort">
                <p>Сортировка:</p>
                <button data-column="3" data-ascending class="sort-btn sort-by-price-btn">
                    <img class="sort-icon sort-price-icon" src="img/ruble.svg" alt="">
                    <span class="sort-text">по цене</span> 
                    <img class="item-order-icon" src="img/sort-outline.svg" alt=""></button>
                <button data-column="4" data-ascending class="sort-btn sort-by-rating-btn">
                    <img class="sort-icon sort-rating-icon" src="img/star.svg" alt="">
                    <span class="sort-text">по оценке</span>
                    <img class="item-order-icon" src="img/sort-outline.svg" alt=""></button>
                <button data-column="5" data-ascending class="sort-btn sort-by-reviews-btn">
                    <img class="sort-icon sort-reviews-icon" src="img/review.svg" alt="">
                    <span class="sort-text">по количеству отзывов</span>
                    <img class="item-order-icon" src="img/sort-outline.svg" alt=""></button>
            </div>
        </div>
    </nav>
    <main>
        <table>
            <tbody>
                <?php
                // запрос к БД
                $mysql = new mysqli('localhost', 'root', 'root', 'task_db');
                $result = $mysql->query('SELECT * FROM `products`');
                $products = mysqli_fetch_all($result);

                // отрисовка нового ряда для каждого элемента таблицы
                foreach ($products as $product) {
                ?>
                    <tr>
                        <td class="product-name"><?= $product[2] ?></td>
                        <td class="product-image-wrapper">
                            <img class="product-image" src="<?= $product[1] ?>" alt="">
                        </td>
                        <td class="product-description"><?= $product[5] ?></td>
                        <td class="product-price"><?= $product[6] ?> руб.</td>
                        <td class="product-rating"><img src="img/star.svg"><?= $product[3] ?></td>
                        <td class="product-review-amount">
                            <?= $product[4] ?> 
                            <?php 
                                if (intval($product[4]) >= 11 && intval($product[4]) <= 14) {
                                    echo " отзывов";
                                } else {
                                    $remainder = intval($product[4])%10;
                                    if ($remainder == 1) {
                                            echo " отзыв";
                                    } elseif ($remainder <= 4){
                                        echo " отзыва";
                                    } else {
                                        echo " отзывов";
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <div class="notFound nf-display-none"><h1 class="notFound-text">Товаров не найдено</h1></div>
    </main>
</body>
<script src="script.js">
</script>
</html>