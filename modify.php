<?php
require 'db_connection.php';


if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $modify_id = intval($_GET['id']);
    

    $client_query = $conn->query("SELECT * FROM client WHERE id_client = $modify_id");
    $client = $client_query->fetch_assoc();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $name = htmlspecialchars(trim($_POST['name']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $telephone = htmlspecialchars(trim($_POST['telephone']));
    $adress = htmlspecialchars(trim($_POST['adress']));
    $date_naissance = htmlspecialchars(trim($_POST['date_naissance']));
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) ) {    
        echo "<div class='error-message'>Invalid email format.</div>";
    } else {      
      
        $query = "UPDATE client 
                  SET name = '$name', 
                      prenom = '$prenom', 
                      email = '$email', 
                      telephone = '$telephone', 
                      adress = '$adress', 
                      date_naissance = '$date_naissance'
                  WHERE id_client = $modify_id";          
        
        if ($conn->query($query) === TRUE) {        
            echo "<div class='success-message'>Client updated successfully!</div>";              
            echo "<script>                
                setTimeout(function() {                    
                    window.location.href = 'clients.php';                
                }, 2000);              
            </script>";    
        } else {        
            echo "<div class='error-message'>Error updating client: " . $conn->error . "</div>";    
        }
    }
}
elseif($_SERVER['REQUEST_METHOD'] == 'POST' && (empty(trim($name)) || empty(trim($prenom)) || empty(trim($email)))){
  
        echo "<div class='error-message'>Name, Last Name, and Email are required fields.</div>";
        
 
}
?>

<form method="POST" class="client-form">      
    <div class="form-group">        
        <label for="name">First Name:</label>        
        <input type="text" id="name" name="name" placeholder="Enter first name"                 
               pattern="[A-Za-z\s]+" title="Only letters and spaces allowed"
               value="<?php echo isset($client['name']) ? htmlspecialchars($client['name']) : "enter name";
?>">    
    </div>      
    <div class="form-group">        
        <label for="prenom">Last Name:</label>        
        <input type="text" id="prenom" name="prenom" placeholder="Enter last name"                 
               pattern="[A-Za-z\s]+" title="Only letters and spaces allowed"
               value="<?php echo isset($client['prenom']) ? htmlspecialchars($client['prenom']) : ''; ?>">    
    </div>      
    <div class="form-group">        
        <label for="email">Email:</label>        
        <input type="email" id="email" name="email" placeholder="Enter email" 
               value="<?php echo isset($client['email']) ? htmlspecialchars($client['email']) : ''; ?>">    
    </div>      
    <div class="form-group">        
        <label for="date_naissance">Birth Date:</label>        
        <input type="date" id="date_naissance" name="date_naissance"                 
               max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>"
               value="<?php echo isset($client['date_naissance']) ? htmlspecialchars($client['date_naissance']) : ''; ?>">    
    </div>      
    <div class="form-group">        
        <label for="telephone">Phone:</label>        
        <input type="tel" id="telephone" name="telephone" placeholder="Enter phone number"                 
               pattern="[0-9\+\-\(\)\s]+" title="Only numbers, +, -, and spaces allowed"
               value="<?php echo isset($client['telephone']) ? htmlspecialchars($client['telephone']) : ''; ?>">    
    </div>      
    <div class="form-group">        
        <label for="adress">Address:</label>        
        <textarea id="adress" name="adress" placeholder="Enter full address"><?php 
            echo isset($client['adress']) ? htmlspecialchars($client['adress']) : ''; 
        ?></textarea>    
    </div>      
    <div class="form-actions">        
        <button type="submit" class="btn btn-primary">Update Client</button>        
        <a href="clients.php" class="btn btn-secondary">Cancel</a>    
    </div>  
</form>