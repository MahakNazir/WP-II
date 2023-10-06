<!DOCTYPE HTML>  
<html>
<head>
<style>
body {
    background-color: #f0f5f5;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    display: flex;
    justify-content: space-between;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #d1eaf1;
    border-radius: 5px;
    box-shadow: 0px 0px 10px #aaa;
}

.form-container, .response-container {
    flex: 1;
    padding: 20px;
}

.error {
    color: #FF0000;
}

h2 {
    text-align: center;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #ecf7f7;
    color: #333;
}

/* Add a max-width for the input elements to create spacing */
input[type="text"] {
    max-width: 100%;
}

input[type="radio"] {
    margin-right: 10px;
}

input[type="submit"] {
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #2980b9;
}

.required-label::after {
    content: "*";
    color: #FF0000;
    margin-left: 4px; /* Add some spacing between label and asterisk */
}
</style>
</head>
<body>  

<?php

$nameErr = $emailErr = $genderErr = $phoneErr = "";
$name = $email = $gender = $comment = $phone = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  
  } else {
    $name = test_input($_POST["name"]);
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email ID is mandatory";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone number is required";
  } else {
    $phone = test_input($_POST["phone"]);

    if (!preg_match('/^[0-9]{10}$/', $phone)) {
      $phoneErr = "Invalid phone number format";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<div class="container">
    <div class="form-container">
        <h2>Feedback Form</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
            <label for="name" class="required-label">Name:</label>
            <input type="text" name="name" id="name">
            <span class="error"> <?php echo $nameErr;?></span>
            <br><br>
            <label for="email" class="required-label">E-mail:</label>
            <input type="text" name="email" id="email">
            <span class="error"> <?php echo $emailErr;?></span>
            <br><br>
            <label for="phone" class="required-label">Phone:</label>
            <input type="text" name="phone" id="phone">
            <span class="error"> <?php echo $phoneErr;?></span>
            <br><br>
            <label for="comment">Comment:</label>
            <textarea name="comment" rows="5" cols="40" id="comment"></textarea>
            <br><br>
            <label class="required-label">Gender:</label>
            <input type="radio" name="gender" value="Female">Female
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Other">Other
            <span class="error"> <?php echo $genderErr;?></span>
            <br><br>
            <input type="submit" name="submit" value="Submit">  
        </form>
    </div>
    
    <div class="response-container">
        <h2>User Response:</h2>
        <p>Name: <?php echo $name;?></p>
        <p>E-mail: <?php echo $email;?></p>
        <p>Phone: <?php echo $phone;?></p>
        <p>Comment: <?php echo $comment;?></p>
        <p>Gender: <?php echo $gender;?></p>
    </div>
</div>

</body>
</html>
