<?php 

include 'auth_check.php'; // calling this file to check for login and session time expire .


$page_title = "Dashboard";   // 1. تعريف العنوان
include '../config/db.php';
include 'admin_header.php';


// Get Games count
$gamesQuery = "SELECT COUNT(*) as total FROM content WHERE content_type='game'";
$gamesResult = $conn->query($gamesQuery);
$gamesCount = $gamesResult->fetch_assoc()['total'];

// Get Quizzes count
$quizQuery = "SELECT COUNT(*) as total FROM content WHERE content_type='quiz'";
$quizResult = $conn->query($quizQuery);
$quizCount = $quizResult->fetch_assoc()['total'];

// Get Lessons count
$lessonQuery = "SELECT COUNT(*) as total FROM content WHERE content_type='lesson'";
$lessonResult = $conn->query($lessonQuery);
$lessonCount = $lessonResult->fetch_assoc()['total'];

// Get Results count
$resultsQuery = "SELECT COUNT(*) as total FROM results";
$resultsResult = $conn->query($resultsQuery);
$resultsCount = $resultsResult->fetch_assoc()['total'];

?>


<!-- <//?php include 'admin_header.php'; ?> -->

<div class="dashboard">




    <!-- Stats Cards -->
    <div class="row g-3">

        <div class="col-md-3">
            <div class="dash-card">
                <h6>Total Games</h6>
                <h2><?php echo $gamesCount; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dash-card">
                <h6>Total Quizzes</h6>
                <h2><?php echo $quizCount; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dash-card">
                <h6>Lessons</h6>
                <h2><?php echo $lessonCount; ?></h2>
            </div>
        </div>

        <div class="col-md-3">
            <div class="dash-card">
                <h6>Results</h6>
                <h2><?php echo $resultsCount; ?></h2>
            </div>
        </div>

    </div>

    <!-- Quick Action -->
    <div class="mt-4">
        <a href="create.php" class="btn btn-primary-custom">
            + Create New Game
        </a>
    </div>

    <!-- Latest Activity -->
    <div class="mt-4">

        <h4 class="mb-3">Latest Games</h4>

        <div class="activity-list">

        <?php
        $latest = "SELECT content_title, content_type, created_at FROM content ORDER BY content_id DESC LIMIT 5";
        $latestResult = $conn->query($latest);

        if ($latestResult->num_rows > 0) {
            while($row = $latestResult->fetch_assoc()) {
        ?>

            <div class="activity-item">
                <span>
                    🎮 <?php echo $row['content_title']; ?> (<?php echo $row['content_type']; ?>)
                </span>
                <small><?php echo $row['created_at']; ?></small>
            </div>

        <?php 
            }
        } else {
            echo "<p>No content yet</p>";
        }
        ?>

        </div>

    </div>

</div>

<?php include 'admin_footer.php'; ?>