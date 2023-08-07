<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Search Landing Page</title>
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <!-- Custom CSS -->
    <style>
      body {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        background-color: #f5f5f5; /* Light gray background color */
      }

      /* Center the search box and results list */
      .search-container {
        flex: 4; /* Take 3/4 of the available height */
        display: flex;
        align-items: center;
        justify-content: start;
        flex-direction: column;
      }

      .search-box {
        max-width: 400px; /* Set a maximum width for the search box */
        width: 100%;
        background-color: #fff; /* White background for the search box */
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow */
      }

      /* Increase the height of the search input */
      .search-box input[type="text"] {
        height: 50px; /* Set the height for the search input */
      }

      /* Fix the footer at the bottom */
      .footer {
        flex-shrink: 0;
        padding: 10px 0;
        background-color: #fff;
        box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1); /* Add a shadow at the top */
      }

      .results-list {
        flex: 1; /* Take the remaining 1/4 of the available height */
        display: flex;
        justify-content: center;
        align-items: flex-start;
      }
      .three-times-height {
        height: 300%;
      }
    </style>
  </head>

  <body>
  <div class="container">
  <div class="row justify-content-center">
  <div class="col-md-8">
    <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);

      use App\Models\VoterModel; // Load the VotersModel

      $totalPages = 0;
      $votersName = isset($_GET['votersName']) ? $_GET['votersName'] : '';
      if (!empty($_POST['prevVotersName'])) {
          $votersName = $_GET['prevVotersName'];
      }
      $sampleData = [];

      if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['votersName'])) {
          // Check if the form was submitted using POST method and votersName is set
          $votersName = $_GET['votersName'];
      }

      $votersModel = new VoterModel();
    ?>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Barangay Gulod</a>
      <!-- Add additional navigation items if needed -->
    </nav>

    <div class="search-container">
      <div class="p-5">
        <h1>Barangay Voters List System</h1>
      </div>
      <div class="search-box mb-4">
        <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="get">
          <?= csrf_field() ?>
          <div class="input-group">
            <input
              type="text"
              class="form-control"
              placeholder="Enter Full Name here"
              aria-label="Search term"
              aria-describedby="search-btn"
              name="votersName"
              value="<?= isset($_GET['votersName']) ? htmlspecialchars($_GET['votersName']) : ''; ?>"
            />
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" id="search-btn">
                Search
              </button>
            </div>
          </div>
          <?php if (!empty($_GET['votersName'])) { ?>
            <input type="hidden" name="prevVotersName" value="<?= htmlspecialchars($_GET['votersName']); ?>">
          <?php } else if (!empty($_GET['prevVotersName'])) { ?>
            <input type="hidden" name="prevVotersName" value="<?= htmlspecialchars($_GET['prevVotersName']); ?>">
          <?php } ?>
        </form>
      </div>
    </div>



    <!-- Results list goes here -->
    <div class="results-list">
  <!-- Query Results -->
  <div class="row">
  <?php
    // Get the query results from the model method
    if (!empty($votersName)) {
        $sampleData = $votersModel->getVotersByVotersName($votersName);
        $totalItems = count($sampleData);
        $itemsPerPage = 10;
        $currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $startItem = isset($_GET['startItem']) ? intval($_GET['startItem']) : ($currentPage - 1) * $itemsPerPage;
        $totalPages = ceil($totalItems / $itemsPerPage);
        // Adjust the data to display based on the current page and items per page
        $sampleData = array_slice($sampleData, $startItem, $itemsPerPage);
    }

    // Display the data in a table
    //print_r($sampleData);
    //die();
    // Display the data in a table
    if (!empty($sampleData)) {
      echo '<table class="table table-striped">';
      echo '<thead><tr><th>Voters Name</th><th>Address</th><th></th></tr></thead>';
      echo '<tbody>';
      for ($i = 0; $i < count($sampleData); $i++) {
          echo '<tr>';
          echo '<td>' . $sampleData[$i]->voters_name . '</td>';
          echo '<td>' . $sampleData[$i]->address . '</td>';
          echo '<td><a href="voter-info.php?id=' . $sampleData[$i]->id . '" class="btn btn-info">View Information Card</a></td>';
          echo '</tr>';
      }
      echo '</tbody></table>';
    } else {
      echo '<p>No data found.</p>';
    }

    // Pagination
    if ($totalPages > 1) {
      echo '<nav aria-label="Page navigation">';
      echo '<ul class="pagination justify-content-center">';
      for ($i = 1; $i <= $totalPages; $i++) {
          $activeClass = $i === $currentPage ? ' active' : '';
          $queryString = !empty($votersName) ? '&votersName=' . urlencode($votersName) : '';
          $prevQueryString = !empty($votersName) ? '&prevVotersName=' . urlencode($votersName) : '';
          $startItemValue = ($i - 1) * $itemsPerPage;
          echo '<li class="page-item' . $activeClass . '"><a class="page-link" href="?page=' . $i . '&startItem=' . $startItemValue . $queryString . $prevQueryString . '">' . $i . '</a></li>';
      }
      echo '</ul>';
      echo '</nav>';
    }
    ?>
      <div class="col-12 p-0">
      <footer class="footer bg-light text-center">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              Search Landing &copy; 2023.. All rights reserved.
            </div>
          </div>
        </div>
      </footer>
    </div>
    </div>
  </div>
</div>
</div>