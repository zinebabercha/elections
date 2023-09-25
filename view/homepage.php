
<?php

	session_start();
	require_once("../model/db.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOMEPAGE</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="assets/css/homepage.css">
  <script>
  function show() {
    var program = document.getElementsByName("program")[0].value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txt").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "getSuggestions.php?program=" + program , true);
    xhttp.send()
}




    </script>
</head>

<body>
  <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
    </div>

    <div class="search">
      <i class='bx bx-search'></i>
      <input type="text" class="hide" placeholder="Quick Search ...">
    </div>

    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="homepage.php" class="active" data-active="0">
            <div class="icon">
              <i class='bx bx-home'></i>
              <i class='bx bx-home'></i>
            </div>
            <span class="link hide">Home</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="dashboard.php"  data-active="1">
            <div class="icon">
              <i class='bx bx-tachometer'></i>
              <i class='bx bxs-tachometer'></i>
            </div>
            <span class="link hide">Dashboard</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="projects.php" data-active="2">
            <div class="icon">
              <i class='bx bx-folder'></i>
              <i class='bx bxs-folder'></i>
            </div>
            <span class="link hide">Projects</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="3">
          <a href="messages.php" data-active="3">
            <div class="icon">
              <i class='bx bx-message-square-detail'></i>
              <i class='bx bxs-message-square-detail'></i>
            </div>
            <span class="link hide">Messages</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="4">
          <a href="analytics.php" data-active="4">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Analytics</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Home</span>
          <span>Dashboard</span>
          <span>Projects</span>
          <span>Messages</span>
          <span>Analytics</span>
        </div>
      </ul>

      <h4 class="hide">Shortcuts</h4>

      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="tasks.php" data-active="5">
            <div class="icon">
              <i class='bx bx-notepad'></i>
              <i class='bx bxs-notepad'></i>
            </div>
            <span class="link hide">Tasks</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="help.php" data-active="6">
            <div class="icon">
              <i class='bx bx-help-circle'></i>
              <i class='bx bxs-help-circle'></i>
            </div>
            <span class="link hide">Help</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="account.php" data-active="7">
            <div class="icon">
              <i class='bx bx-cog'></i>
              <i class='bx bxs-cog'></i>
            </div>
            <span class="link hide">Account</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Tasks</span>
          <span>Help</span>
          <span>Account</span>
        </div>
      </ul>
    </div>

    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <a href="../controller/logout.php" class="log-out">
          <i class='bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span>Logout</span>
      </div>
    </div>
  </nav>

<div class="container">
  <main class="main">
    <div class="ajax">
    <form class="form1"  method="GET">
    <label for="program">Select a program:</label>
    <select id="program" name="program" onchange="show()">
    <?php
    $DSN = 'mysql:host=localhost;dbname=politico';
    try {
      $ConnectingDB = new PDO($DSN, 'root', '');
      $ConnectingDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    // Retrieve the candidates from the "candidates" table
    $candidateQuery = "SELECT * FROM programs";
    $programStmt = $ConnectingDB->prepare($candidateQuery);
    $programStmt->execute();
    $programs = $programStmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($programs)) {
      foreach ($programs as $program) {
        echo '<option value="' . $program['program_id'] . '">' . $program['program_title'] . '</option>';
      }
    }
    ?>
    </select>
    <p> Suggestions: <span id="txt"></span></p>
    </form>


    </div>
    <div class="chart">
    <form class="form2" action="vote.php" method="POST">
    <label for="candidate">Select a candidate:</label>
  <select id="candidate" name="candidate">
    <?php
    $DSN = 'mysql:host=localhost;dbname=politico';
    try {
      $ConnectingDB = new PDO($DSN, 'root', '');
      $ConnectingDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    // Retrieve the candidates from the "candidates" table
    $candidateQuery = "SELECT * FROM candidates";
    $candidateStmt = $ConnectingDB->prepare($candidateQuery);
    $candidateStmt->execute();
    $candidates = $candidateStmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($candidates)) {
      foreach ($candidates as $candidate) {
        echo '<option value="' . $candidate['candidate_id'] . '">' . $candidate['candidate_name'] . '</option>';
      }
    }
    ?>
    </select>
    <button type="submit" name="vote">Vote</button>
    </form>


    </div>
    <div class="other">
    <canvas id="myChart" width="400" height="400"></canvas>
    <?php
    // Include your database connection file and establish a connection

    // Retrieve data from the database using PDO
    $dsn = 'mysql:host=localhost;dbname=politico';


    try {
        $db = new PDO($dsn, 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query to retrieve the number of candidates and programs per candidate
        $query = "
        SELECT COUNT(*) AS candidate_count, election_id
        FROM candidates
        GROUP BY election_id;
        ";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $candidateData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Query to retrieve the number of programs per candidate
        $query = "
        SELECT COUNT(*) AS program_count, candidate_id
        FROM programs
        GROUP BY candidate_id;
        ";

        $stmt = $db->prepare($query);
        $stmt->execute();
        $programData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Close the database connection
        $db = null;
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>

    <script>
        // Prepare the data for the chart
        var candidateData = <?php echo json_encode($candidateData); ?>;
        var programData = <?php echo json_encode($programData); ?>;

        var labels = [];
        var candidateCounts = [];
        var programCounts = [];

        for (var i = 0; i < candidateData.length; i++) {
            labels.push('Election ' + candidateData[i].election_id);
            candidateCounts.push(candidateData[i].candidate_count);
        }

        for (var j = 0; j < programData.length; j++) {
            programCounts.push(programData[j].program_count);
        }

        // Create the chart using Chart.js
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Candidates',
                    data: candidateCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }, {
                    label: 'Programs',
                    data: programCounts,
                    backgroundColor: 'rgba(192, 75, 192, 0.2)',
                    borderColor: 'rgba(192, 75, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    </div>



  </main>
  <div class="other1">
  <?php
$DSN = 'mysql:host=localhost;dbname=politico';
try {
    $conn = new PDO($DSN, 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve the candidate names and vote counts
    $query = "SELECT candidates.candidate_name, COUNT(votes.vote_id) AS vote_count
              FROM candidates
              LEFT JOIN programs ON candidates.candidate_id = programs.candidate_id
              LEFT JOIN candidates ON votes.user_id = candidates.candidate_id
              GROUP BY candidates.candidate_id";
    $stmt = $conn->query($query);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare the data for the chart
    $candidateNames = [];
    $voteCounts = [];
    foreach ($results as $row) {
        $candidateNames[] = $row['candidate_name'];
        $voteCounts[] = $row['vote_count'];
    }

    // Generate the chart using Chart.js
    echo '<canvas id="voteChart"></canvas>';
    echo '<script>
        var ctx = document.getElementById("voteChart").getContext("2d");
        var chart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ' . json_encode($candidateNames) . ',
                datasets: [{
                    label: "Number of Votes",
                    data: ' . json_encode($voteCounts) . ',
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                }
            }
        });
    </script>';

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


 

    </div>
</div>

  <script src="assets/js/homepage.js"></script>
</body>

</html>