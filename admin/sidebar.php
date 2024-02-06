<aside style="height: 200vh;">
        <ul>
                    <li><a href="index.php"class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-home"></i></span>
                      <span class="ttr-label">Dashboard</span></a>
                  </li>
                  <li><a href="profile.php"class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-user-circle"></i></span>
                      <span class="ttr-label">Profile</span></a>
                  </li>
            

                  <li class="ttr-submenu" id="studentDropdown">
    <a href="#" class="ttr-material-button">
        <span class="ttr-icon"><i class="fa fa-user"></i></span>
        <span class="ttr-label">Student</span>
    </a>
    <ul>
        <li style="margin-left: 4%; margin-top: 8%;"><a href="add_student.php"><i class="fa fa-plus-circle" style="padding-right: 7px;"></i>Add Student</a></li>
        <li style="margin-left: 4%; margin-top: 3%;"><a href="manage_students.php"><i class="fa fa-eye" style="padding-right: 7px;"></i>View Students</a></li>
    </ul>
</li>




<li class="ttr-submenu" id="facultyDropdown">
    <a href="#" class="ttr-material-button">
        <span class="ttr-icon"><i class="fa fa-user"></i></span>
        <span class="ttr-label">Faculty</span>
    </a>
    <ul>
    <li style="margin-left: 4%; margin-top: 8%;"><a href="add_faculty.php"><i class="fa fa-plus-circle" style="padding-right: 7px;"></i> Add Faculty</a></li>
<li style="margin-left: 4%; margin-top: 3%;"><a href="manage-faculty.php"><i class="fa fa-eye" style="padding-right: 7px;"></i> View Faculty</a></li>

    </ul>
</li>
                 
                    
                                      <li>
                      <a href="manage-subject.php" class="ttr-material-button">
                          <span class="ttr-icon"><i class="fa fa-book"></i></span>
                          <span class="ttr-label">Subject & Strand</span>
                      </a>
                  </li>


                   </li>




                      <li>
                      <a href="announce-faculty.php" class="ttr-material-button">
                      <span class="ttr-icon"><i class="fa fa-bell"></i></span>
                      <span class="ttr-label">Send Notification</span>
                      </a>
                      </li>
                   
                      <a href="settings.php" class="ttr-material-button">
                        <span class="ttr-icon"><i class="fa fa-gear"></i></span>
                          <span class="ttr-label">Settings</span></a>
                    </li>

                 
                  </ul>
                  <script>
document.addEventListener('DOMContentLoaded', function() {
    function setupDropdown(dropdownId) {
        var dropdown = document.getElementById(dropdownId);
        var dropdownMenu = dropdown.querySelector('ul');

        // Hide the dropdown menu initially
        dropdownMenu.style.display = 'none';

        dropdown.addEventListener('click', function(event) {
            // Check if the click occurred on a dropdown link
            var target = event.target;
            if (target.tagName === 'A' && target.getAttribute('href')) {
                // Allow the default behavior for links
                return;
            }

            // Toggle the visibility of the dropdown menu
            dropdownMenu.style.display = (dropdownMenu.style.display === 'block') ? 'none' : 'block';
        });
    }

    // Set up both "Student" and "Faculty" dropdowns
    setupDropdown('studentDropdown');
    setupDropdown('facultyDropdown');
});
</script>




<style>
  
</style>

    </aside>

    
    <?php



// // Check if the user is not logged in, redirect to index.php
// if (!isset($_SESSION['email'])) {
//     header('Location: ../index.php');
//     exit;
// }
// ?>
  