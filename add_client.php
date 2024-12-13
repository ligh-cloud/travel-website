<?php 
require 'db_connection.php';
include 'header.php'; 
?>

<div class="container add-client-form">
    <h2>Add New Client</h2>

    <?php
   
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = htmlspecialchars(trim($_POST['name']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $adress = htmlspecialchars(trim($_POST['adress']));
    $date_naissance = htmlspecialchars(trim($_POST['date_naissance']));


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='error-message'>Invalid email format.</div>";
    } else {

        $query = "INSERT INTO client (name, prenom, email, telephone, adress, date_naissance) 
                  VALUES ('$name', '$prenom', '$email', '$telephone', '$adress', '$date_naissance')";

       
        if ($conn->query($query) === TRUE) {
            echo "<div class='success-message'>Client added successfully!</div>";
        
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'clients.php';
                    }, 2000);
                  </script>";
        } else {
            echo "<div class='error-message'>Error adding client: " . $conn->error . "</div>";
        }
    }
}

    ?>

    <form method="POST" class="client-form">
        <div class="form-group">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter first name" required 
                   pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
        </div>
        
        <div class="form-group">
            <label for="prenom">Last Name:</label>
            <input type="text" id="prenom" name="prenom" placeholder="Enter last name" required 
                   pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" required>
        </div>
        
        <div class="form-group">
            <label for="date_naissance">Birth Date:</label> 
            <input type="date" id="date_naissance" name="date_naissance" required 
                   max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
        </div>
        
        <div class="form-group">
            <label for="telephone">Phone:</label>
            <input type="tel" id="telephone" name="telephone" placeholder="Enter phone number" required 
                   pattern="[0-9\+\-\s]+" title="Only numbers, +, -, and spaces allowed">
        </div>
        
        <div class="form-group">
            <label for="adress">Address:</label>
            <textarea id="adress" name="adress" placeholder="Enter full address"></textarea>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Add Client</button>
            <a href="clients.php" class="btn btn-secondary">Cancel</a>
        </div>
        
    </form>
</div>

<?php 
include 'footer.php'; 
?>