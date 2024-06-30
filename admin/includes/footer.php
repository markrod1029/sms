
<!-- Site footer -->
<footer class="footer">
      <p align="center">&copy; <?php echo date("Y"); ?> Student Managment System</p>
      <p align="center">Libas National High School.</p>
    </footer>

  <!-- Include jQuery and Bootstrap JS -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>

  <!-- Include DataTables JS -->
  <script type="text/javascript" charset="utf-8" language="javascript" src="assets/js/dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable({
        "searching": true // This line enables the search functionality
      });
    });
  </script>
  </div>
</body>

</html>