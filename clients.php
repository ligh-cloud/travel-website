<?php 
require 'db_connection.php';
include 'header.php'; 

?>
<form  method="post">
        <button class="btn btn-primary" type="submit" name="delete_data" onclick=" return confirm('Are you sure you want to delete all data?') && are_u_sure(); ">Delete All Data</button>
    </form>
<div class="container">
    <h2>Client List</h2>
    
    <div class="actions">
        <a href="add_client.php" class="btn btn-primary">Add New Client</a>
    </div>
    <script>
        function are_u_sure(){
            return confirm('think about it are you sure you want to do this');
        }
    </script>

    <?php
    $query = "SELECT id_client, name, prenom, email, telephone, adress FROM client";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table class='client-table'>";
        echo "<tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Actions</th>
              </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id_client']) . "</td>";
            echo "<td>" . htmlspecialchars($row['name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['adress']) . "</td>";
            echo "<td>
                    <a href='modify.php?id=" . htmlspecialchars($row['id_client']) . "' class='btn btn-edit'>Edit</a>
                    
                    <a href='?delete=" . htmlspecialchars($row['id_client']) . "' 
                       class='btn btn-delete' 
                       onclick='return confirm(\"Are you sure you want to delete this client?\");'>
                        Delete
                    </a>
                    
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No clients found.</p>";
    }
    if (isset($_POST['delete_data'])) {
      
        $conn->query("SET FOREIGN_KEY_CHECKS = 0");
    
 
        $sql = "TRUNCATE TABLE client";
     
    
        if ($conn->query($sql) === TRUE) {

            $conn->query("SET FOREIGN_KEY_CHECKS = 1");
            echo "<div class='success-message'>All data has been deleted successfully.</div>";
            // echo "<script>window.location.reload();</script>";
        } else {
            echo "<div class='error-message'>Error deleting data: " . $conn->error . "</div>";
        }
    } 
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $client_id = intval($_GET['delete']);
    
    $delete_client = $conn->query("DELETE FROM client WHERE id_client = $client_id");
    
    if ($delete_client) {
        echo "<script>window.location.href='clients.php';</script>";
    } else {
        echo "<div class='error-message'>Error deleting client: " . $conn->error . "</div>";
    }
}
    
    $conn->close();
    include 'footer.php'; 
    ?>
</div>