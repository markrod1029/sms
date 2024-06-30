<?php
    require('db.php');
    
    // Check if emp_id is set and is numeric
    if(isset($_GET['emp_id']) && is_numeric($_GET['emp_id'])) {
        echo $id = $_GET['emp_id'];
        
        // Attempt deletion
        $query = "DELETE FROM students WHERE id=$id"; 
        $result = mysqli_query($connection, $query);
        
        // Check if deletion was successful
        if ($result) {
            ?>
            <script>
                alert('Student has been successfully deleted!');
                window.location.href = 'home_students.php'; // Redirect to home_employee.php
            </script>
            <?php
        } else {
            ?>
            <script>
                alert('Failed to delete students: <?php echo mysqli_error($connection); ?>');
                window.location.href = 'home_students.php'; // Redirect to home_employee.php
            </script>
            <?php
        }
        
        mysqli_close($connection); // Close connection
    } else {
        ?>
        <script>
            alert('Invalid employee ID.');
            window.location.href = 'home_employee.php'; // Redirect to home_employee.php
        </script>
        <?php
    }
?>
