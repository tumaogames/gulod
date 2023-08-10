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
      /* Adjust the width and styles of the pagination container and its children as needed */
  .pagination-container {
    display: flex;
    flex-wrap: wrap; /* This will make the list stack when it exceeds the container width */
    justify-content: center;
    align-items: center;
    margin-top: 10px; /* Add some margin for spacing */
  }

  .pagination-container .pagination {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
  }

  .pagination-container .pagination li {
    margin: 0 5px; /* Add some margin between each pagination item */
  }

  .pagination-container .pagination li.active a {
    background-color: #007bff; /* Example: You can change this to style the active page */
    color: #fff; /* Example: You can change this to style the active page */
    border-radius: 5px;
    padding: 5px 10px;
  }
    /* Optional: Add custom styles to the modal if needed */
    #image-view-modal .modal-dialog {
    max-width: 90%;
  }

  #modal-image {
    max-width: 100%;
    height: auto;
  }

    /* Custom CSS for modal width */
  #image-view-modal .custom-modal-dialog {
    max-width: 50%; /* Default width for larger devices */
  }

  /* Media query for mobile devices (max-width: 767px) */
  @media (max-width: 767px) {
    #image-view-modal .custom-modal-dialog {
      max-width: 100%; /* Full width for mobile devices */
    }
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- "View Information Card" link with Bootstrap button class -->
    

    <!-- Image view modal -->
    <div id="image-view-modal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered custom-modal-dialog"">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Voter Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <img id="modal-image" src="" class="img-fluid" alt="Voter Image">
              </div>
              <div class="col-md-4">
                <p><strong>Name:</strong> <span id="voter-name"></span></p>
                <p><strong>Address:</strong> <span id="voter-address"></span></p>
                <p><strong>Precinct No:</strong> <span id="voter-precinct"></span></p>
                <p><strong>Clustered Precinct:</strong> <span id="voter-clustered-precinct"></span></p>
                <!-- Add more voter information fields as needed -->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <!-- Optionally, you can include a print button as well -->
            <!-- Print button -->
            <button id="print-button" class="btn btn-primary">Print</button>
          </div>
        </div>
      </div>
    </div>


  <!-- Query Results -->
  <div class="col">
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
      echo '<div class="table-responsive">';
      echo '<table class="table table-striped">';
      echo '<thead><tr><th><p class="text-xs">Voters Name</p></th><th><p class="text-xs">Address</p></th><th></th></tr></thead>';
      echo '<tbody>';
      foreach ($sampleData as $voter) {
          $voterID = $voter->id;
          $voterName = $voter->voters_name;
          $voterAddress = $voter->address;
          $voterPrecinct = $voter->precinct_no;
          $voterClusteredPrecinct = $voter->clustered_precinct;
      
          echo '<tr>';
          echo '<td><p class="text-xs">' . $voterName . '</p></td>';
          echo '<td><p class="text-xs">' . $voterAddress . '</p></td>';
          echo '<td><a href="#" class="btn btn-info view-card-btn" data-toggle="modal" data-target="#image-view-modal" data-voter-id="' . $voterID . '" data-voter-name="' . $voterName . '" data-voter-address="' . $voterAddress . '" data-voter-precinct="' . $voterPrecinct . '" data-voter-clustered-precinct="' . $voterClusteredPrecinct . '">View Information Card</a></td>';
          echo '</tr>';
      }
      echo '</tbody></table>';
      echo '</div>';
  } else {
      echo '<p>No data found.</p>';
  }

    // Pagination
    if ($totalPages > 1) {
      echo '<nav aria-label="Page navigation">';
      echo '<ul class="row pagination justify-content-center">';

      // Previous button
      $prevPage = $currentPage - 1;
      if ($prevPage > 0) {
        $queryString = !empty($votersName) ? '&votersName=' . urlencode($votersName) : '';
        $prevQueryString = !empty($votersName) ? '&prevVotersName=' . urlencode($votersName) : '';
        $startItemValue = ($prevPage - 1) * $itemsPerPage;
        echo '<li class="page-item"><a class="page-link" href="?page=' . $prevPage . '&startItem=' . $startItemValue . $queryString . $prevQueryString . '">&lt;</a></li>';
      }

      // Display 10 pagination buttons (adjust this based on your preference)
      $startPage = max(1, $currentPage - 5);
      $endPage = min($totalPages, $startPage + 9);
      for ($i = $startPage; $i <= $endPage; $i++) {
        $activeClass = $i === $currentPage ? ' active' : '';
        $queryString = !empty($votersName) ? '&votersName=' . urlencode($votersName) : '';
        $prevQueryString = !empty($votersName) ? '&prevVotersName=' . urlencode($votersName) : '';
        $startItemValue = ($i - 1) * $itemsPerPage;
        echo '<li class="page-item' . $activeClass . '"><a class="page-link" href="?page=' . $i . '&startItem=' . $startItemValue . $queryString . $prevQueryString . '">' . $i . '</a></li>';
      }

      // Next button
      $nextPage = $currentPage + 1;
      if ($nextPage <= $totalPages) {
        $queryString = !empty($votersName) ? '&votersName=' . urlencode($votersName) : '';
        $prevQueryString = !empty($votersName) ? '&prevVotersName=' . urlencode($votersName) : '';
        $startItemValue = ($nextPage - 1) * $itemsPerPage;
        echo '<li class="page-item"><a class="page-link" href="?page=' . $nextPage . '&startItem=' . $startItemValue . $queryString . $prevQueryString . '">&gt;</a></li>';
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
      <!-- Include jQuery library -->
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Bootstrap JS (popper.js is also required if using Bootstrap's dropdowns, tooltips, or popovers) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
   // Function to show the voter information in the modal
  function showImageView(voterID, voterName, voterAddress, voterPrecinct, voterClusteredPrecinct) {
    // Here, you should fetch the image URL based on the voterID.
    // For demonstration purposes, we'll use a static image URL.
    var imageURL = 'path/to/image/' + voterID + '.jpg';
    $('#modal-image').attr('src', imageURL);
    $('#voter-name').text(voterName);
    $('#voter-address').text(voterAddress);
    $('#voter-precinct').text(voterPrecinct);
    $('#voter-clustered-precinct').text(voterClusteredPrecinct);

    // Show the image view modal
    $('#image-view-modal').modal('show');
  }

  // Attach event listeners to the buttons
  $(document).ready(function() {
        // When any "View Information Card" link is clicked
        $('.view-card-btn').click(function(e) {
            e.preventDefault();
            var voterID = $(this).data('voter-id');
            var voterName = $(this).data('voter-name');
            var voterAddress = $(this).data('voter-address');
            var voterPrecinct = $(this).data('voter-precinct');
            var voterClusteredPrecinct = $(this).data('voter-clustered-precinct');
            
            showImageView(voterID, voterName, voterAddress, voterPrecinct, voterClusteredPrecinct);
        });
    });
</script>

    </div>
    </div>
  </div>
</div>
</div>