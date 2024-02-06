<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
    $conn = new mysqli("localhost", "root", "", "student");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Assuming the form data is submitted as arrays
    $student_id = $_POST['student_id'];
    $subjects = $_POST['subjects'];
    $schedcodes = $_POST['schedcodes'];
    $sections = $_POST['sections'];
    $instructors = $_POST['instructors'];
    $schedules = $_POST['schedules'];
    $years = $_POST['years']; // Added years field

    // Loop through the submitted data and insert into the database
    for ($i = 0; $i < count($subjects); $i++) {
        $subject = $conn->real_escape_string($subjects[$i]);
        $schedcode = $conn->real_escape_string($schedcodes[$i]);
        $section = $conn->real_escape_string($sections[$i]);
        $instructor = $conn->real_escape_string($instructors[$i]);
        $schedule = $conn->real_escape_string($schedules[$i]);
        $year = $conn->real_escape_string($years[$i]); // Get the year value

        $sql = "INSERT INTO enrolled_subjects (subject_name, schedcode, section, instructor, schedule, year)
                VALUES ('$subject', '$schedcode', '$section', '$instructor', '$schedule', '$year')";

        $conn->query($sql);
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Form</title>
    <script>
        // JavaScript to add and delete rows dynamically
        function addRow() {
            var table = document.getElementById("subjectsTable");
            var row = table.insertRow(table.rows.length);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6); // Added for the "Year" input

            cell1.innerHTML = '<input type="text" name="subjects[]">';
            cell2.innerHTML = '<input type="text" name="schedcodes[]">';
            cell3.innerHTML = '<select name="sections[]">' +
            '<option value="A">A</option>' +
            '<option value="B">B</option>' +
            '<option value="C">C</option>' +
            '<option value="D">D</option>' +
            '<option value="E">E</option>' +
            '</select>';

            cell4.innerHTML = '<input type="text" name="instructors[]">';
            cell5.innerHTML = '<input type="text" name="schedules[]">';
            cell6.innerHTML = '<select name="years[]">' +
            '<option value="1">1</option>' +
            '<option value="2">2</option>' +
            '</select>';

            cell7.innerHTML = '<button type="button" onclick="deleteRow(this)">Delete</button>';
        }

        function deleteRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
</head>
<body>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="student_id" value="1"> <!-- Replace with actual student ID -->
        
        <table id="subjectsTable">
            <tr>
                <th>Subject</th>
                <th>Schedcode</th>
                <th>Section</th>
                <th>Instructor</th>
                <th>Schedule</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><input type="text" name="subjects[]"></td>
                <td><input type="text" name="schedcodes[]"></td>
                <td>
                    <select name="sections[]">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </td>
                <td><input type="text" name="instructors[]"></td>
                <td><input type="text" name="schedules[]"></td>
                <td>
                    <select name="years[]">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </td>
                <td><button type="button" onclick="deleteRow(this)">Delete</button></td>
            </tr>

        </table>

        <button type="button" onclick="addRow()">Add Row</button>
        <button type="submit">Submit</button>
    </form>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        form {
            width: 80%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</body>
</html>
