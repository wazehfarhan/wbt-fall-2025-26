<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php
      // define variables and set to empty values
      $nameErr = $emailErr = $genderErr  = $dobErr = $degreeErr = $bloodErr = "";
      $name = $email = $gender = $comment = "";
      $degree = array();
      $dd = $mm = $yyyy = "";
      $blood = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //for name
        if (empty($_POST["name"])) {
          $nameErr = "Cannot be empty";
        } else {
          $name = test_input($_POST["name"]);
          
          if(str_word_count($name) < 2){
            $nameErr = "Contains at least two words";
          }
          elseif (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
          }
        }

        //for Email
        if (empty($_POST["email"])) {
          $emailErr = "Email is required";
        } else {
          $email = test_input($_POST["email"]);
          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
          }
        }

        //Date Of Birth
        if (!empty($_POST["dd"])) $dd = $_POST["dd"];
        if (!empty($_POST["mm"])) $mm = $_POST["mm"];
        if (!empty($_POST["yyyy"])) $yyyy = $_POST["yyyy"];

        if(empty($_POST["dd"]) || empty($_POST["mm"]) || empty($_POST["yyyy"])) {
            $dobErr = "Date cannot be empty";
        } else {
            if($dd < 1 || $dd > 31) $dobErr = "Day must be 1-31";
            elseif($mm < 1 || $mm > 12) $dobErr = "Month must be 1-12";
            elseif($yyyy < 1953 || $yyyy > 1998) $dobErr = "Year must be 1953-1998";
        }

        //for gender
        if (empty($_POST["gender"])) {
          $genderErr = "At least one must be selected";
        } else {
          $gender = test_input($_POST["gender"]);
        }

        //Degree
        if(isset($_POST["degree"])) {
            $degree = $_POST["degree"];
            if(count($degree) < 2)
                $degreeErr = "At least two must be selected";
        } else {
            $degreeErr = "At least two must be selected";
        }

        //for blood
        if (empty($_POST["blood"])) {
            $bloodErr = "Cannot be empty";
        } else {
            $blood = test_input($_POST["blood"]);
        }

        
      }

      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
    ?>

    <h2>Assignment Task</h2>
    <p>HTML form Validation</span></p>


    <fieldset> 
        <label for="name">NAME</label>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="name" value="<?php echo $name; ?>">
            <span class="error">*
                <?php echo $nameErr;?>
            </span>
            <hr>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <br>

 
    <fieldset> 
        <label for="email">EMAIL</label>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="email" value="<?php echo $email; ?>">
            <span class="error">*
                <?php echo $emailErr;?>
            </span>
            <hr>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <br>

 
    <fieldset> 
        <label for="DoB">DATE OF BIRTH</label>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            dd: 
            mm: 
            yyyy: 
            <br>
            <input type="text" name="dd" size="2" value="<?php echo $dd; ?>">/
            <input type="text" name="mm" size="2" value="<?php echo $mm; ?>">/
            <input type="text" name="yyyy" size="4" value="<?php echo $yyyy; ?>">
            
            <span class="error">*
                <?php echo $dobErr; ?>
            </span>

            <hr>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <br>

    <fieldset> 
        <label for="gender">GENDER</label>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="radio" name="gender" value="Male"   <?php if($gender=="Male") echo "checked"; ?>> Male
            <input type="radio" name="gender" value="Female" <?php if($gender=="Female") echo "checked"; ?>> Female
            <input type="radio" name="gender" value="Other"  <?php if($gender=="Other") echo "checked"; ?>> Other

            <span class="error">*
                <?php echo $genderErr; ?>
            </span>

            <hr>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <br>

    <fieldset> 
        <label for="DEGREE">DEGREE</label>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="checkbox" name="degree[]" value="SSC" <?php if(in_array("SSC", $degree)) echo "checked"; ?>> SSC
            <input type="checkbox" name="degree[]" value="HSC" <?php if(in_array("HSC", $degree)) echo "checked"; ?>> HSC
            <input type="checkbox" name="degree[]" value="BSc" <?php if(in_array("BSc", $degree)) echo "checked"; ?>> BSc
            <input type="checkbox" name="degree[]" value="MSc" <?php if(in_array("MSc", $degree)) echo "checked"; ?>> MSc

            <span class="error">*
                <?php echo $degreeErr;?>
            </span>

            <hr>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <br>


    <fieldset> 
        <label for="blood">BLOOD GROUP</label>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" name="blood" value="<?php echo $blood; ?>">
            <span class="error">*
                <?php echo $bloodErr;?>
            </span>

            <hr>
            <input type="submit" name="submit" value="Submit">
        </form>
    </fieldset>

    <br>

    <?php
      echo "<h2>Your Input:</h2>";
      echo "Name: $name<br>";
      echo "Email: $email<br>";
      echo "Date of Birth: $dd/$mm/$yyyy<br>";
      echo "Gender: $gender<br>";
      echo "Degree: " . implode(", ", $degree) . "<br>";
      echo "Blood Group: $blood<br>";
    ?>
</body>
</html>