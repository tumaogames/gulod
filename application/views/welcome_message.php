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
      <div class="p-5"><h1>Baranggay Voters List System </h1></div>
      <div class="search-box mb-4">
        <div class="input-group">
          <input
            type="text"
            class="form-control"
            placeholder="Enter your search term here"
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
      <!-- Sample Result Item 1 -->
  <div class="card mb-3" style="max-width: 400px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img
          src="https://via.placeholder.com/150"
          alt="Sample Image"
          class="img-fluid"
        />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Sample Result Item 1</h5>
          <p class="card-text">
            This is a sample result description for Item 1. Lorem ipsum
            dolor sit amet, consectetur adipiscing elit.
          </p>
          <a href="#" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sample Result Item 2 -->
  <div class="card mb-3" style="max-width: 400px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img
          src="https://via.placeholder.com/150"
          alt="Sample Image"
          class="img-fluid"
        />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Sample Result Item 2</h5>
          <p class="card-text">
            This is a sample result description for Item 2. Ut enim ad
            minim veniam, quis nostrud exercitation ullamco laboris nisi
            ut aliquip ex ea commodo consequat.
          </p>
          <a href="#" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sample Result Item 3 -->
  <div class="card mb-3" style="max-width: 400px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img
          src="https://via.placeholder.com/150"
          alt="Sample Image"
          class="img-fluid"
        />
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">Sample Result Item 3</h5>
          <p class="card-text">
            This is a sample result description for Item 3. Duis aute
            irure dolor in reprehenderit in voluptate velit esse cillum
            dolore eu fugiat nulla pariatur.
          </p>
          <a href="#" class="btn btn-primary">View</a>
        </div>
      </div>
    </div>
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
