<?php  
require 'db_connection.php'; 
include 'header.php';  

// Simple query to fetch activities 
$activities_query = "SELECT 
    id_activite,
    titre,
    description,
    prix,
    date_debut,
    date_fin,
    place_disponible 
FROM 
    activite 
ORDER BY 
    date_debut";
$activities_result = $conn->query($activities_query); 
?>

<style>
    .activities-section {
        background-color: #f8f9fa;
        padding: 40px 0;
    }

    .activity-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-bottom: 30px;
        border-radius: 10px;
        overflow: hidden;
    }

    .activity-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .activity-card .card-body {
        background-color: white;
    }

    .activity-card .card-title {
        color: #2c3e50;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .activity-card .card-text {
        color: #7f8c8d;
        margin-bottom: 20px;
        min-height: 60px;
    }

    .activity-card .list-group-item {
        border-color: #ecf0f1;
        padding: 10px 15px;
    }

    .activity-card .list-group-item:first-child {
        border-top: none;
    }

    .price-tag {
        color: #27ae60;
        font-weight: bold;
    }

    .date-tag {
        color: #3498db;
    }

    .places-tag {
        color: #e74c3c;
    }

    .page-header {
        background-color: #3498db;
        color: white;
        padding: 20px 0;
        margin-bottom: 30px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
</style>

<div class="activities-section">
    <div class="container">
        <div class="page-header">
            <h1 class="display-4">Discover Our Activities</h1>
            <p class="lead">Explore exciting experiences waiting for you!</p>
        </div>

        <div class="row">
            <?php if ($activities_result->num_rows > 0): ?>
                <?php while ($activity = $activities_result->fetch_assoc()): ?>
                    <div class="col-md-4">
                        <div class="card activity-card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($activity['titre']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars(substr($activity['description'], 0, 100) . 
                                    (strlen($activity['description']) > 100 ? '...' : '')); ?></p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        Price: <span class="price-tag">€<?php echo number_format($activity['prix'], 2); ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        Start Date: <span class="date-tag"><?php echo date('d M Y', strtotime($activity['date_debut'])); ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        End Date: <span class="date-tag"><?php echo date('d M Y', strtotime($activity['date_fin'])); ?></span>
                                    </li>
                                    <li class="list-group-item">
                                        Available Places: <span class="places-tag"><?php echo htmlspecialchars($activity['place_disponible']); ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No activities available at the moment. Check back soon!
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php  
include 'footer.php';  
$conn->close();  
?>