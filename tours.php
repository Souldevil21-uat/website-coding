<?php
// tours.php
// This is a PHP page for the final project that demonstrates jQuery usage.
// You can keep it mostly “static PHP” for now (no DB required for this assignment).
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Tours | Red Horizon Mars Tours</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Shared CSS from your project (optional but recommended) -->
  <link rel="stylesheet" href="styles.css" />

  <!-- Small page-specific CSS to make the UX look clean -->
  <style>
    .card {
      background: #050b18;
      border: 1px solid #222a3a;
      border-radius: 10px;
      padding: 16px;
      margin-top: 16px;
    }

    .tour-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 16px;
      margin-top: 16px;
    }

    .tour {
      background: #0b1220;
      border: 1px solid #222a3a;
      border-radius: 10px;
      padding: 14px;
    }

    .tour h3 {
      margin: 0 0 8px 0;
    }

    .pill {
      display: inline-block;
      padding: 6px 10px;
      border-radius: 999px;
      background: #1c2233;
      border: 1px solid #2f3a54;
      font-size: 0.85rem;
      margin-right: 8px;
      margin-top: 6px;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 12px;
      align-items: center;
      margin-top: 10px;
    }

    .input {
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #444c5c;
      background: #050b18;
      color: #f5f5f5;
      min-width: 240px;
    }

    .toggle-btn {
      padding: 10px 14px;
      border-radius: 6px;
      border: 1px solid #444c5c;
      background: transparent;
      color: #f5f5f5;
      cursor: pointer;
    }

    .toggle-btn:hover {
      background: #141b2b;
    }

    .notice {
      margin-top: 10px;
      color: #c0c6d8;
      font-size: 0.95rem;
      min-height: 22px;
    }

    .details {
      display: none;
      margin-top: 10px;
      color: #cfd6e4;
      line-height: 1.4;
    }
  </style>

  <!-- jQuery CDN (required to use jQuery) -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
<header>
  <div class="logo">Red Horizon Mars Tours</div>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="pilot-application.php">Pilot Application</a></li>
      <li><a href="next-launch.php">Next Launch</a></li>
      <li><a class="active" href="tours.php">Tours</a></li>
    </ul>
  </nav>
</header>

<main class="container">
  <h1>Tour Catalog</h1>
  <p>
    Browse available Mars experiences. Use the search bar to filter tours instantly, and click
    “View Details” to expand a tour card.
  </p>

  <section class="card">
    <h2>Find a Tour</h2>

    <div class="row">
      <label for="tourSearch" style="font-weight:bold;">Search:</label>
      <input id="tourSearch" class="input" type="text" placeholder="Try: sunrise, olympus, canyon, weekend" />

      <button id="toggleAll" class="toggle-btn" type="button">Expand All Details</button>
      <button id="clearSearch" class="toggle-btn" type="button">Clear Search</button>
    </div>

    <div id="resultsNote" class="notice"></div>

    <div id="tourGrid" class="tour-grid">
      <article class="tour" data-title="mars sunrise express" data-tags="sunrise beginner scenic">
        <h3>Mars Sunrise Express</h3>
        <span class="pill">10 days</span>
        <span class="pill">$2,500,000</span>
        <span class="pill">Scenic</span>

        <button class="toggle-btn viewDetails" type="button">View Details</button>

        <div class="details">
          Watch sunrise spill across the dunes, enjoy a guided rover ride, and relax in the
          observation lounge. Great for first-time travelers.
        </div>
      </article>

      <article class="tour" data-title="olympus mons summit trek" data-tags="olympus hiking advanced">
        <h3>Olympus Mons Summit Trek</h3>
        <span class="pill">21 days</span>
        <span class="pill">$5,200,000</span>
        <span class="pill">Advanced</span>

        <button class="toggle-btn viewDetails" type="button">View Details</button>

        <div class="details">
          High-altitude training, assisted climbs, and base-camp exploration at the largest
          volcano in the solar system.
        </div>
      </article>

      <article class="tour" data-title="valles marineris canyon run" data-tags="canyon rover exploration">
        <h3>Valles Marineris Canyon Run</h3>
        <span class="pill">14 days</span>
        <span class="pill">$3,900,000</span>
        <span class="pill">Exploration</span>

        <button class="toggle-btn viewDetails" type="button">View Details</button>

        <div class="details">
          Cruise the canyon rim, descend to sheltered zones, and collect panoramic imagery for
          your mission scrapbook.
        </div>
      </article>

      <article class="tour" data-title="red planet weekend escape" data-tags="weekend luxury quick">
        <h3>Red Planet Weekend Escape</h3>
        <span class="pill">7 days</span>
        <span class="pill">$1,800,000</span>
        <span class="pill">Luxury</span>

        <button class="toggle-btn viewDetails" type="button">View Details</button>

        <div class="details">
          A short, premium itinerary with curated experiences, private suites, and a zero-g
          dining event before return.
        </div>
      </article>
    </div>
  </section>
</main>

<footer>
  <p>&copy; <?php echo date("Y"); ?> Red Horizon Mars Tours.</p>
</footer>

<script>
/* =========================
   jQuery (line-by-line commented)
   ========================= */

// Run this function once the page's HTML has fully loaded.
$(document).ready(function () {

  // Store a jQuery reference to the search input field.
  const $search = $("#tourSearch");

  // Store a jQuery reference to the container holding all tour cards.
  const $grid = $("#tourGrid");

  // Store a jQuery reference to the text area where we show result counts.
  const $note = $("#resultsNote");

  // Store a jQuery reference to the "Expand All Details" button.
  const $toggleAllBtn = $("#toggleAll");

  // Store a jQuery reference to the "Clear Search" button.
  const $clearBtn = $("#clearSearch");

  // Create a Boolean to remember whether details are currently expanded.
  let allExpanded = false;

  // Define a function that updates the visible tour count message.
  function updateCountMessage() {

    // Find how many tour cards exist total.
    const total = $grid.find(".tour").length;

    // Find how many tour cards are currently visible.
    const visible = $grid.find(".tour:visible").length;

    // Set the note text to show how many match the search.
    $note.text("Showing " + visible + " of " + total + " tours.");
  }

  // Call the function once on page load to show the initial count.
  updateCountMessage();

  // When the user types in the search box, run this function.
  $search.on("input", function () {

    // Get the user's search text, trim spaces, and convert to lowercase for matching.
    const query = $(this).val().trim().toLowerCase();

    // Loop through each tour card one at a time.
    $grid.find(".tour").each(function () {

      // Get the tour title stored in the data-title attribute.
      const title = $(this).data("title");

      // Get the tags stored in the data-tags attribute.
      const tags = $(this).data("tags");

      // Combine title and tags into one searchable string.
      const haystack = (title + " " + tags).toLowerCase();

      // Decide if this card matches the query (or show all if query is empty).
      const matches = (query === "") || haystack.includes(query);

      // Show the card if it matches; otherwise hide it.
      $(this).toggle(matches);
    });

    // Update the result count message after filtering.
    updateCountMessage();
  });

  // When a user clicks a "View Details" button, run this function.
  $grid.on("click", ".viewDetails", function () {

    // Find the details div inside the same tour card as the button.
    const $details = $(this).siblings(".details");

    // Animate the details section open/closed.
    $details.slideToggle(150);

    // Change button text depending on whether details are now visible.
    if ($details.is(":visible")) {
      $(this).text("Hide Details");
    } else {
      $(this).text("View Details");
    }
  });

  // When the "Expand All Details" button is clicked, run this function.
  $toggleAllBtn.on("click", function () {

    // Flip the allExpanded flag to the opposite value.
    allExpanded = !allExpanded;

    // If allExpanded is true, expand every details section.
    if (allExpanded) {

      // Slide down every details section inside visible tour cards.
      $grid.find(".tour:visible .details").slideDown(150);

      // Change all per-card buttons to say "Hide Details".
      $grid.find(".tour:visible .viewDetails").text("Hide Details");

      // Change the main button label to indicate the next action.
      $toggleAllBtn.text("Collapse All Details");

    } else {

      // Slide up every details section inside visible tour cards.
      $grid.find(".tour:visible .details").slideUp(150);

      // Change all per-card buttons back to "View Details".
      $grid.find(".tour:visible .viewDetails").text("View Details");

      // Change the main button label to indicate the next action.
      $toggleAllBtn.text("Expand All Details");
    }
  });

  // When the "Clear Search" button is clicked, run this function.
  $clearBtn.on("click", function () {

    // Set the search input value to an empty string.
    $search.val("");

    // Trigger the input event so the filtering logic runs again.
    $search.trigger("input");
  });

});
</script>

</body>
</html>
