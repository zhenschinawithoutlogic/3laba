<!DOCTYPE html>
<html>
<head>
    <title>Умножение чисел в столбик</title>
</head>
<body>
    <h1>Умножение чисел в столбик</h1>
    <form method="post">
        <label for="num1">Число 1: </label>
        <input type="number" name="num1" id="num1">
        <br>
        <label for="num2">Число 2: </label>
        <input type="number" name="num2" id="num2">
        <br>
        <input type="submit" value="Умножить">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получаем числа из формы
        $num1 = isset($_POST['num1']) ? intval($_POST['num1']) : 0;
        $num2 = isset($_POST['num2']) ? intval($_POST['num2']) : 0;

        // Выполняем умножение
        $result = $num1 * $num2;

        // Выводим процесс умножения в столбик
        echo '<h2>Процесс умножения:</h2>';
        echo '<pre>';
        echo '   ' . $num1 . '<br>';
        echo '× ' . $num2 . '<br>';
        echo '–––––<br>';
        $product = $num1 * ($num2 % 10);
        echo '   ' . $product . '<br>';
        echo '–––––<br>';
        $carry = floor($num2 / 10);
        if ($carry > 0) {
            $product = $num1 * $carry;
            echo '  ' . $product . '<br>';
        }
        echo '–––––<br>';
        echo '   ' . $result . '<br>';
        echo '</pre>';
    }
    ?>
</body>
</html>