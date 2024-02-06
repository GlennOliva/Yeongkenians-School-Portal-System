<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="students.css">
    <title>Student Lists</title>
</head>
<body>

<header>
    <img src="images/logo.png" alt="">
    <a href="dashboard">STUDENT PORTAL</a>
    <div class="logout">
    <a href="../index.php">
            <span class="ttr-icon"><i class="fa fa-sign-out"></i></span>
        </a>
    </div>
</header>

<main>
       <aside>
        <ul>
                  <li><a href="admindashboard.php"class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-home"></i></span>
                      <span class="ttr-label">Dashboard</span></a>
                  </li>
                  <li><a href="profile.php"class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-user-circle"></i></span>
                      <span class="ttr-label">Profile</span></a>
                  </li>
                  <li>
                      <a href="students.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-book"></i></span>
                          <span class="ttr-label">Student</span></a>
                    </li>
                    <li>
                      <a href="faculty.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-trophy"></i></span>
                          <span class="ttr-label">Faculty</span></a>
                    </li>
                    <li>
                      <a href="studentRecords.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-book"></i></span>
                          <span class="ttr-label"></span>Student records</a>
                    </li>
                    <li>
                      <a href="manage users.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-gear"></i></span>
                          <span class="ttr-label">Settings</span></a>
                    </li>
          
                  </ul>
    </aside>
    <section>
        <div class="container-fluid">
            <div>
                <h4 class="hd4">
                    <span class="profile"><i class="fa fa-user"></i> Student's Lists</span>
                </h4>
                <hr>
            </div>

            <!-- Add Student Button -->
           <br> <button onclick="openAddStudentForm()">Add</button>,</br>

            <!-- Add Student Form (Initially Hidden) -->
            <div id="addStudentForm" style="display:none;">
        <form onsubmit="addStudent(); return false;">
        <label for="lrn">LRN:</label>
        <input type="text" id="lrn" required><br>

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" required><br>

        <label for="cellphone">Cellphone:</label>
        <input type="text" id="cellphone" required><br>

        <label for="section">Section:</label>
        <input type="text" id="section" required><br>

        <label for="grade">Grade:</label>
        <input type="text" id="grade" required><br>

        <label for="adviser">Adviser:</label>
        <input type="text" id="adviser" required><br>

        <label for="strand">Strand:</label>
        <input type="text" id="strand" required><br>

        <input type="submit" value="Add Student">
    </form>
</div>

            </div>

            <!-- Display Student Table -->
            <table id="studentTable">
                <tr>
                    <th>ID</th>
                    <th>LRN</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Cellphone</th>
                    <th>Section</th>
                    <th>Grade</th>
                    <th>Adviser</th>
                    <th>Strand</th>
                    <th>Actions</th>
                </tr>
            </table>

            <script>
                  let studentData = [];

    function openAddStudentForm() {
        document.getElementById('addStudentForm').style.display = 'block';
    }

    function addStudent() {
        let lrn = document.getElementById('lrn').value;
        let fullName = document.getElementById('full_name').value;
        let email = document.getElementById('email').value;
        let cellphone = document.getElementById('cellphone').value;
        let section = document.getElementById('section').value;
        let grade = document.getElementById('grade').value;
        let adviser = document.getElementById('adviser').value;
        let strand = document.getElementById('strand').value;

        let newStudent = {
            id: studentData.length + 1,
            lrn,
            full_name: fullName,
            email,
            cellphone,
            section,
            grade,
            adviser,
            strand
        };

        studentData.push(newStudent);

        updateStudentTable();
        closeAddStudentForm();
        clearAddStudentForm();
    }

    function updateStudentTable() {
        let table = document.getElementById('studentTable');
        // Remove existing rows
        table.innerHTML = "<tr><th>ID</th><th>LRN</th><th>Full Name</th><th>Email</th><th>Cellphone</th><th>Section</th><th>Grade</th><th>Adviser</th><th>Strand</th><th>Actions</th></tr>";

        // Populate table with data
        studentData.forEach(student => {
            let row = table.insertRow();
            row.innerHTML = `<td>${student.id}</td>
                             <td>${student.lrn}</td>
                             <td>${student.full_name}</td>
                             <td>${student.email}</td>
                             <td>${student.cellphone}</td>
                             <td>${student.section}</td>
                             <td>${student.grade}</td>
                             <td>${student.adviser}</td>
                             <td>${student.strand}</td>
                             <td><button onclick="editStudent(${student.id})">Edit</button>
                                 <button onclick="deleteStudent(${student.id})">Delete</button></td>`;
        });
    }

    function closeAddStudentForm() {
        document.getElementById('addStudentForm').style.display = 'none';
    }

    function clearAddStudentForm() {
        document.getElementById('lrn').value = '';
        document.getElementById('full_name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('cellphone').value = '';
        document.getElementById('section').value = '';
        document.getElementById('grade').value = '';
        document.getElementById('adviser').value = '';
        document.getElementById('strand').value = '';
    }

    function editStudent(id) {
        // Implement edit functionality if needed
        alert('Edit student with ID ' + id);
    }

    function deleteStudent(id) {
        // Implement delete functionality if needed
        let confirmation = confirm('Are you sure you want to delete this student?');
        if (confirmation) {
            studentData = studentData.filter(student => student.id !== id);
            updateStudentTable();
        }
    }
            </script>
        </div>
    </section>
</main>

</body>
</html>
