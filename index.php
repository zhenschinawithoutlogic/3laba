<?php
function pad(string $input, string $pad, int $length): string
{
    $inpulLen = strlen($input);
    $dif = $length - $inpulLen;
    if ($dif < 1){
        return $input;
    }

    $nb = array_fill(0, $dif, $pad);
    return implode('', $nb) . $input;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Умножение чисел в столбик</title>
</head>
<body>
    <form method="post" action="">
        <label for="num1">Первое число:</label>
        <input type="text" id="num1" name="num1">
        <br>
        <label for="num2">Второе число:</label>
        <input type="text" id="num2" name="num2">
        <br>
        <input type="submit" value="Умножить">
    </form>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<code>";
        $num1 = $_POST["num1"] ?? null;
        $num2 = $_POST["num2"] ?? null;
        
        if (is_numeric($num1) && is_numeric($num2)) {
            $result = $num1 * $num2;
            
            // Преобразуем числа в строки для удобства обработки
            $num1 = strval($num1);
            $num2 = strval($num2);
            
            // Определяем максимальную длину чисел
            $maxLen = 1 + strlen((string) $result);
            
            // Добавляем ведущие нули, чтобы оба числа имели одинаковую длину
            $num1 = pad($num1, "&nbsp;", $maxLen);
            $num2 = pad($num2, "&nbsp;", $maxLen);
            
            // Выводим процесс умножения в столбик
            echo "&nbsp;" . $num1 . "<br>";
            echo "*" . $num2 . "<br>";
            echo "<hr>";
            
            echo $result;
            die();

            $lines = array(); // Массив для хранения строк процесса умножения
            
            // Умножение в столбик
            for ($i = $maxLen - 1; $i >= 0; $i--) {
                $line = "";
                $carry = 0; // Перенос разряда
                
                for ($j = $maxLen - 1; $j >= 0; $j--) {
                    $product = $num1[$i] * $num2[$j] + $carry;
                    $carry = floor($product / 10);
                    $line = ($product % 10) . $line;
                }
                
                if ($carry > 0) {
                    $line = $carry . $line;
                }
                
                $lines[] = $line;
            }
            
            // Добавляем отступы слева для выравнивания столбиков
            $maxLineLength = strlen(end($lines));
            foreach ($lines as $line) {
                echo str_repeat(" ", $maxLineLength - strlen($line)) . $line . "<br>";
            }
            
            echo "<hr>";
            echo $result;
        } else {
            echo "Пожалуйста, введите числа.";
        }
        echo "</code>";
    }
    ?>
</body>
</html>