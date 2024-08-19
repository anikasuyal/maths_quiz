<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>math quiz</title>
    <style>
        body {
            font-family: 'courier new', courier, monospace;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .result {
            margin-top: 20px;
            font-weight: normal;
        }
    </style>
</head>
<body>
    <?php
    $num1 = $num2 = $operation = $correct_answer = null;
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = (int)$_POST['num1'];
        $num2 = (int)$_POST['num2'];
        $operation = $_POST['operation'];
        $correct_answer = (int)$_POST['correct_answer'];
        $user_answer = isset($_POST['answer']) ? (int)$_POST['answer'] : null;

        if ($user_answer === $correct_answer) {
            $message = "correct! well done.";
        } else {
            $message = "incorrect. the correct answer was $correct_answer.";
        }
        
        list($num1, $num2, $operation, $correct_answer) = generatequestion();
    } else {
        list($num1, $num2, $operation, $correct_answer) = generatequestion();
    }
    
        
        function generatequestion () {
        $operations = array('+', '-', '*', '/');
        $operation = $operations[array_rand($operations)];

        switch ($operation) {
            case '+':
                $num1 = mt_rand(1,20);
                $num2 = mt_rand(1,20);
                $correct_answer = $num1 + $num2;
                break;
            case '-':
                $num1 = mt_rand(1,20);
                $num2 = mt_rand(1,20);
                $correct_answer = $num1 - $num2;
                break;
            case '*':
                $num1 = mt_rand(1,20);
                $num2 = mt_rand(1,20);
                $correct_answer = $num1 * $num2;
                break;
            case '/':
                do {
                $num2 = mt_rand(1,20);
                $num1 = mt_rand(1,20);
                } while ($num1 % $num2 != 0);
                $correct_answer = $num1 / $num2;
                break;
        }
        
        return array($num1, $num2, $operation, $correct_answer);
    }
    ?>
    <h1>math quiz</h1>
    <form method="post">
        <input type="hidden" name="num1" value="<?php echo $num1; ?>">
        <input type="hidden" name="num2" value="<?php echo $num2; ?>">
        <input type="hidden" name="operation" value="<?php echo $operation; ?>">
        <input type="hidden" name="correct_answer" value="<?php echo $correct_answer; ?>">
        <p>solve: <?php echo "$num1 $operation $num2 = ?"; ?></p>
        <input type="number" name="answer" required>
        <button type="submit">submit</button>
    </form>
    <?php if ($message) : ?>
    <p class="result"><?php echo $message; ?></p>
    <?php endif; ?>
</body>
</html>
