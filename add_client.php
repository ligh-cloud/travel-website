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

  
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $phone_pattern = "/^\(?\d{3}\)?[-.\s]?\d{3}[-.\s]?\d{4}$/";
    $name_pattern = "/^[a-zA-Z\s]+$/";

    
    $errors = [];

    if (empty($name) || !preg_match($name_pattern, $name)) {
        $errors[] = "Invalid or missing name.";
    }
    if (empty($prenom) || !preg_match($name_pattern, $prenom)) {
        $errors[] = "Invalid or missing first name.";
    }
    if (empty($email) || !preg_match($email_pattern, $email)) {
        $errors[] = "Invalid or missing email.";
    }
    if (empty($telephone) ) {
        $errors[] = "Invalid or missing telephone.";
    }
    if (empty($adress)) {
        $errors[] = "Address is required.";
    }
    if (empty($date_naissance)) {
        $errors[] = "Date of birth is required.";
    }

  
    if (empty($errors)) {
        $query = "INSERT INTO client (name, prenom, email, telephone, adress, date_naissance) 
                  VALUES ('$name', '$prenom', '$email', '$telephone', '$adress', '$date_naissance')";

        if ($conn->query($query) === TRUE) {
            echo "<div class='success-message'>Client added successfully!</div>";
            echo "<script>
                    setTimeout(function() {
                        window.location.href = 'clients.php';
                    }, 2000);
                  </script>";
            exit(); 
        } else {
            $errors[] = "Error adding client: " . $conn->error;
        }
    }


    if (!empty($errors)) {
        echo "<div class='error-message'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
}

    ?>

    <form method="POST" class="client-form">
        <div class="form-group">
            <label for="name">First Name:</label>
            <input type="text" id="name" name="name" placeholder="Enter first name"  
                   pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
        </div>
        
        <div class="form-group">
            <label for="prenom">Last Name:</label>
            <input type="text" id="prenom" name="prenom" placeholder="Enter last name"  
                   pattern="[A-Za-z\s]+" title="Only letters and spaces allowed">
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Enter email" >
        </div>
        
        <div class="form-group">
            <label for="date_naissance">Birth Date:</label> 
            <input type="date" id="date_naissance" name="date_naissance"  
                   max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
        </div>
        
        <div class="form-group">
            <label for="telephone">Phone:</label>
            <input type="tel" id="telephone" name="telephone" placeholder="Enter phone number"  
                    title="Only numbers, +, -, and spaces allowed">
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