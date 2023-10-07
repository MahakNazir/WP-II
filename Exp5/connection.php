<?php
// Your database connection code here
$db = new PDO('mysql:host=localhost;dbname=company_db;charset=utf8', 'root', '');

$message = ""; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check the action (insert, update, or delete)
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        
        // Handle insert action
        if ($action === "insert") {
            // Get values from the form
            $emp_id = $_POST["emp_id"];
            $f_name = $_POST["f_name"];
            $l_name = $_POST["l_name"];
            $d_name = $_POST["d_name"];
            $salary = $_POST["salary"];
            
            // Insert data into the database
            $insertSQL = "INSERT INTO employees (emp_id, f_name, l_name, d_name, salary) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($insertSQL);
            $stmt->execute([$emp_id, $f_name, $l_name, $d_name, $salary]);
            
            $message = "Data inserted successfully!";
        }
        
        // Handle update action
        elseif ($action === "update") {
            // Get values from the form
            $emp_id = $_POST["emp_id"];
            $f_name = $_POST["f_name"];
            $l_name = $_POST["l_name"];
            $d_name = $_POST["d_name"];
            $salary = $_POST["salary"];
            
            // Update data in the database
            $updateSQL = "UPDATE employees SET f_name=?, l_name=?, d_name=?, salary=? WHERE emp_id=?";
            $stmt = $db->prepare($updateSQL);
            $stmt->execute([$f_name, $l_name, $d_name, $salary, $emp_id]);
            
            $message = "Data updated successfully!";
        }

        // Handle delete action
        elseif ($action === "delete") {
            // Get values from the form
            $emp_id = $_POST["emp_id"];
            
            // Delete data from the database
            $deleteSQL = "DELETE FROM employees WHERE emp_id=?";
            $stmt = $db->prepare($deleteSQL);
            $stmt->execute([$emp_id]);
            
            $message = "Data deleted successfully!";
        }
    }
}

// Fetch and display updated data
$selectSQL = "SELECT * FROM employees";
$stmt = $db->prepare($selectSQL);
$stmt->execute();
$employees = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>

    <style>
        /* Your CSS styles here */
        @import url('https://fonts.googleapis.com/css2?family=Gabarito:wght@600&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Gabarito', cursive;
        }

        .container {
            height: 100vh;
            display: flex;
            flex-wrap: wrap;
        }

        .quadrant {
            flex: 1;
            gap: 10px;
            min-width: 50%;
            min-height: 50%;
            box-sizing: border-box;
            border: 1px solid #ccc;
            overflow: hidden;
            position: relative;
        }

        .options {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #fff;
            text-align: center;
            font-size: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }

        .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            padding: 10px;
            box-sizing: border-box;
            background-color: #fff;
            text-align: center;
            font-size: 1.2rem;
        }

        .content input {
            width: 100%;
            padding: 6px;
            box-sizing: border-box;
            margin-bottom: 6px;
        }

        table {
            width: 100%;
            padding: 10px;
            border-collapse: collapse;
            margin-right: 20px;
            margin-top: 1px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            font-size: 1.5rem;
        }

        thead {
            background-color: #CCCCFF;
            color: black;
        }

        tbody tr:hover {
            background-color: #ddd;
        }

        .quadrant:nth-child(1) {
            background-color: #D7B4F3
        }

        .quadrant:nth-child(2) {
            background-color: #D3D3D3; 
        }

        #dbtype {
            display: none;
        }

        .quad1 form {
            display: flex;
            flex-direction: row;
        }

        .btnform {
            align-items: center;
            appearance: none;
            background-color: #FCFCFD;
            border-radius: 4px;
            border-width: 0;
            box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            box-sizing: border-box;
            color: #36395A;
            cursor: pointer;
            font-family: 'Gabarito', cursive;
            height: 60px;
            width: 150px;
            justify-content: center;
            line-height: 1;
            list-style: none;
            overflow: hidden;
            text-align: center;
            text-decoration: none;
            transition: box-shadow .15s, transform .15s;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            will-change: box-shadow, transform;
            font-size: 1.5rem;
            margin: 10px;
            margin-left: 25px;
        }

        .btnform:focus {
            box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
        }

        .btnform:hover {
            box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
            transform: translateY(-2px);
        }

        .btnform:active {
            box-shadow: #D6D6E7 0 3px 7px inset;
            transform: translateY(2px);
        }

        .displayedImage {
            margin-top: 5%;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="quadrant quad1">
            <h1>DB Options</h1>
            <form action="connection.php" method="post">
                <input type="radio" name="operation" id="insert" value="insert">
                <label for="insert">Insert</label>
                <input type="radio" name="operation" id="update" value="update">
                <label for="update">Update</label>
                <input type="radio" name="operation" id="delete" value="delete">
                <label for="delete">Delete</label>
                <input type="submit" value="Submit">
                <input type="hidden" name="action" value="">
            </form>
        </div>
        <div class="quadrant quad2" id="output">
            <h1>Employee Management</h1>
            <div id="imageContainer">
                <div class="content">
                    <?php if (!empty($message)): ?>
                        <h3><?php echo $message; ?></h3>
                    <?php endif; ?>

                    <?php
                    $selectSQL = "SELECT * FROM employees";
                    $stmt = $db->prepare($selectSQL);
                    $stmt->execute();
                    $employees = $stmt->fetchAll();
                    ?>

                    <table>
                        <thead>
                            <tr>
                                <th>emp_id</th>
                                <th>f_name</th>
                                <th>l_name</th>
                                <th>d_name</th>
                                <th>salary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employees as $employee): ?>
                                <tr>
                                    <td><?php echo $employee["emp_id"]; ?></td>
                                    <td><?php echo $employee["f_name"]; ?></td>
                                    <td><?php echo $employee["l_name"]; ?></td>
                                    <td><?php echo $employee["d_name"]; ?></td>
                                    <td><?php echo $employee["salary"]; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Your JavaScript code here
        const radioButtons = document.querySelectorAll('input[name="operation"]');
        const actionInput = document.querySelector('input[name="action"]');
        const contentDiv = document.querySelector('.content');
        const messageDiv = document.querySelector('.content h3');

        const insertContent = `
            <form action="connection.php" method="post">
                <label for="emp_id">Employee ID</label>
                <input type="text" name="emp_id" id="emp_id" placeholder="Enter Employee ID">
                <label for="f_name">First Name</label>
                <input type="text" name="f_name" id="f_name" placeholder="Enter First Name">
                <label for="l_name">Last Name</label>
                <input type="text" name="l_name" id="l_name" placeholder="Enter Last Name">
                <label for="d_name">Department Name</label>
                <input type="text" name="d_name" id="d_name" placeholder="Enter Department Name">
                <label for="salary">Salary</label>
                <input type="text" name="salary" id="salary" placeholder="Enter Salary">
                <input type="submit" value="Insert">
                <input type="hidden" name="action" value="insert">
            </form>
        `;

        const updateContent = `
            <form action="connection.php" method="post">
                <label for="emp_id">Employee ID</label>
                <input type="text" name="emp_id" id="emp_id" placeholder="Enter Employee ID">
                <label for="f_name">First Name</label>
                <input type="text" name="f_name" id="f_name" placeholder="Enter First Name">
                <label for="l_name">Last Name</label>
                <input type="text" name="l_name" id="l_name" placeholder="Enter Last Name">
                <label for="d_name">Department Name</label>
                <input type="text" name="d_name" id="d_name" placeholder="Enter Department Name">
                <label for="salary">Salary</label>
                <input type="text" name="salary" id="salary" placeholder="Enter Salary">
                <input type="submit" value="Update">
                <input type="hidden" name="action" value="update">
            </form>
        `;

        const deleteContent = `
            <form action="connection.php" method="post">
                <label for="emp_id">Employee ID</label>
                <input type="text" name="emp_id" id="emp_id" placeholder="Enter Employee ID">
                <input type="submit" value="Delete">
                <input type="hidden" name="action" value="delete">
            </form>
        `;

        radioButtons.forEach(radioButton => {
            radioButton.addEventListener('change', function () {
                if (this.checked) {
                    const selectedValue = this.value;
                    if (selectedValue === 'insert') {
                        contentDiv.innerHTML = insertContent;
                        actionInput.value = 'insert';
                    } else if (selectedValue === 'update') {
                        contentDiv.innerHTML = updateContent;
                        actionInput.value = 'update';
                    } else if (selectedValue === 'delete') {
                        contentDiv.innerHTML = deleteContent;
                        actionInput.value = 'delete';
                    }
                }
            });
        });
    </script>
</body>
</html>
