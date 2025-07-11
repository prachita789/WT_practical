<!-- Develop and demonstrate PHP Script for the following problems: 
a) Write a PHP Script to find out the Sum of the Individual Digits. 
b) Write a PHP Script to check whether the given number is Palindrome or not  -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sum of Digits and Palingrome Check</title>
    
     <style>
        body {
    font-family: Arial, Helvetica, sans-serif;
    background-color: #f1f1f1;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
}

h2 {
    color: #333;
    margin-top: 0;
}

form {
    margin-bottom: 30px;
}

input[type="number"], input[type="submit"] {
    padding: 10px;
    width:100%;
    margin: 8px 0;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

.result {
    background-color: #f9f9f9;
    padding: 15px;
    border-left: 5px solid #4CAF50;
    border-radius: 5px;
}

        </style>
</head>
<body>
    <div class="container">
    <h2>Sum of the Individual Digits</h2>
    <form method="post">
        <input type="number" name="sum_number" placeholder="Enter number" required>
        <br><br>
        <input type="submit" name="sum_submit" value="Find Sum">
    </form>

    <?php
     if(isset($_POST['sum_submit'])){
        $num = $_POST['sum_number'];

        function sumOfDigits($number){
            $sum = 0;
            while($number != 0) {
                $digit = $number % 10;
                $sum += $digit;
                $number = (int)($number / 10);
            }
            return $sum;

        }

        echo "Sum of digits of $num is: ".sumOfDigits($num). "<br><br>";
    }
?>   
    <hr>
    <h2>Palindrome Checker</h2>
    <form method="post">
        <input type="number" name="pal_number" placeholder="Enter number" required>
        <br><br>
        <input type="submit" name="pal_submit" value="Check Palindrome">
    </form>

    <?php
      if (isset($_POST['pal_submit'])){
        $num = $_POST['pal_number'];

        function isPalindrome($number) {
            $originalNumber = $number;
            $reverse = 0;

            while($number > 0) {
                $digit = $number % 10;
                $reverse = ($reverse * 10) + $digit;
                $number =(int)($number / 10);
            }

            return($originalNumber == $reverse);
        }

       if(isPalindrome($num)) {
            echo "<div class='result'>$num is a Palindrome number.</div>";
        }
        else{
            echo "<div class='result'>$num is not a Palindrome number.</div>";
        }

     }

        
     
    ?>

    </div>
</body>
</html>