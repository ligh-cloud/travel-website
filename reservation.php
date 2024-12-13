<?php 
require 'db_connection.php';
include 'header.php';

// Process form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $titre = htmlspecialchars(trim($_POST['titre']));
    $prix = floatval($_POST['prix']);
    $date_debut = htmlspecialchars(trim($_POST['date_debut']));
    $date_fin = htmlspecialchars(trim($_POST['date_fin']));
    $place_disponible = intval($_POST['place_disponible']);
    $description = htmlspecialchars(trim($_POST['description']));

    // Validate inputs
    $errors = [];
    if (empty($titre)) $errors[] = "Title is required.";
    if ($prix <= 0) $errors[] = "Price must be positive.";
    if (empty($date_debut)) $errors[] = "Start date is required.";
    if (empty($date_fin)) $errors[] = "End date is required.";
    if (strtotime($date_fin) < strtotime($date_debut)) $errors[] = "End date must be after start date.";
    if ($place_disponible <= 0) $errors[] = "Available places must be positive.";

    if (empty($errors)) {
        // Prepare and execute the query
        $activity_query = "INSERT INTO activite 
                           (titre, prix, date_debut, date_fin, place_disponible, description) 
                           VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($activity_query);
        $stmt->bind_param("sdssis", $titre, $prix, $date_debut, $date_fin, $place_disponible, $description);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Activity added successfully! 
                  <a href='show_activities.php'>View Activities</a></div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding activity: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        // Display errors
        echo "<div class='alert alert-danger'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Add New Activity</h2>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group mb-3">
                            <label for="titre">Activity Title:</label>
                            <input type="text" id="titre" name="titre" class="form-control" 
                                   placeholder="Enter activity title" required 
                                   value="<?php echo isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : ''; ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="prix">Price (€):</label>
                            <input type="number" id="prix" name="prix" class="form-control" 
                                   placeholder="Enter price" step="0.01" required
                                   value="<?php echo isset($_POST['prix']) ? htmlspecialchars($_POST['prix']) : ''; ?>">
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="date_debut">Start Date:</label>
                                <input type="date" id="date_debut" name="date_debut" class="form-control" required
                                       value="<?php echo isset($_POST['date_debut']) ? htmlspecialchars($_POST['date_debut']) : ''; ?>">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="date_fin">End Date:</label>
                                <input type="date" id="date_fin" name="date_fin" class="form-control" required
                                       value="<?php echo isset($_POST['date_fin']) ? htmlspecialchars($_POST['date_fin']) : ''; ?>">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="place_disponible">Available Places:</label>
                            <input type="number" id="place_disponible" name="place_disponible" 
                                   class="form-control" required
                                   value="<?php echo isset($_POST['place_disponible']) ? htmlspecialchars($_POST['place_disponible']) : ''; ?>">
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Description:</label>
                            <textarea id="description" name="description" class="form-control" 
                                      rows="4" required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Add Activity</button>
                            <a href="show_activities.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
include 'footer.php'; 
$conn->close(); 
?>