<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
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
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Search Landing</a>
      <!-- Add additional navigation items if needed -->
    </nav>

    <!-- Main content -->
    <div class="search-container">
      <div class="p-5"><h1>Barangay Voters List System </h1></div>
      <div class="search-box mb-4">
        <div class="input-group">
          <input
            type="text"
            class="form-control"
            placeholder="Enter Full Name here"
            aria-label="Search term"
            aria-describedby="search-btn"
          />
          <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="search-btn">
              Search
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Results list goes here -->
    <div class="results-list">
      <!-- Sample Data -->
	  <div class="row">
		<?php
		// Sample data for pagination demonstration
		$totalItems = 15; // Total number of items
		$itemsPerPage = 5; // Number of items per page
		$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
		$totalPages = ceil($totalItems / $itemsPerPage);
		$startItem = ($currentPage - 1) * $itemsPerPage;

		// Sample data array
		$sampleData = array();
		for ($i = $startItem; $i < min($startItem + $itemsPerPage, $totalItems); $i++) {
			$sampleData[] = array(
			'id' => $i + 1,
			'name' => 'Sample Full Name ' . ($i + 1),
			);
		}

		// Display the sample data in a table
		if (!empty($sampleData)) {
			echo '<table class="table table-striped">';
			echo '<thead><tr><th>ID</th><th>Name</th></tr></thead>';
			echo '<tbody>';
			foreach ($sampleData as $item) {
			echo '<tr>';
			echo '<td>' . $item['id'] . '</td>';
			echo '<td>' . $item['name'] . '</td>';
			echo '<td><button class="btn btn-info" onclick="showInfoCard(' . $item['id'] . ')">View Information Card</button></td>';
			echo '</tr>';
			}
			echo '</tbody></table>';
		}
		?>

		<!-- Pagination -->
		<nav aria-label="Page navigation">
			<ul class="pagination justify-content-center">
			<?php
			// Generate pagination links
			for ($i = 1; $i <= $totalPages; $i++) {
				$activeClass = $i === $currentPage ? ' active' : '';
				echo '<li class="page-item' . $activeClass . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
			}
			?>
			</ul>
		</nav>
		</div>
			</div>

			<!-- Footer -->
			<footer class="footer bg-light mt-4">
			<div class="container text-center">
				<span class="text-muted"
				>Search Landing &copy; 2023. All rights reserved.</span
				>
			
	</div>
    </footer>

    <!-- Bootstrap JS (Make sure to include jQuery and Popper.js before Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
