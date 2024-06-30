<?php
    require('db.php');
    
    // Check if id is set and is numeric
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
        echo $id = $_GET['id'];
        
        // Attempt deletion
        $query = "DELETE FROM subjects WHERE id=$id"; 
        $result = mysqli_query($connection, $query);
        
        // Check if deletion was successful
        if ($result) {
            ?>
            <script>
                alert('Subject has been successfully deleted!');
                window.location.href = 'home_subjects.php'; 
            </script>
            <?php
        } else {
            ?>
            <script>
                alert('Failed to delete students: <?php echo mysqli_error($connection); ?>');
                window.location.href = 'home_subjects.php'; 
            </script>
            <?php
        }
        
        mysqli_close($connection); // Close connection
    } else {
        ?>
        <script>
            alert('Invalid Subject ID.');
            window.location.href = 'home_subjects.php'; // Redirect to home_employee.php
        </script>
        <?php
    }
?>
