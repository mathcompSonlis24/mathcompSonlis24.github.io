<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MATH COMP SONLIS 2024</title>
  <style>
    /* Reset and basic styling for better visibility */
    body {
      margin: 0;
      font: normal 75% Arial, Helvetica, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      overflow: hidden; /* Hide the scrollbar */
      position: relative; /* Added relative positioning to the body */
    }

    #particles-js {
      position: absolute;
      width: 100%;
      height: 100%;
      background-color: #b61924;
      background-image: url("");
      background-repeat: no-repeat;
      background-size: cover;
      background-position: 50% 50%;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(7, 100px); /* Increased the size to 100px */
      grid-template-rows: repeat(7, 100px); /* Increased the size to 100px */
      gap: 2px; /* Increased the gap to 2px */
      z-index: 1; /* Ensure the grid is in front of the particles */
      background-color: rgba(255,255,255, 0.5); /* Semi-transparent white background */
    }

    .grid-item {
      display: flex;
      justify-content: center;
      align-items: center;
      border: 2px solid #000; /* Increased the border thickness to 2px */
      width: 100px; /* Increased the size to 100px */
      height: 100px; /* Increased the size to 100px */
      font-size: 36px; /* Increased the font size to 36px */
      font-weight: bold; /* Set text to bold */
      color: #000000; /* Set text color to black */
    }

    /* Stats container for particles */
    .count-particles {
      background: #000022;
      position: absolute;
      top: 48px;
      left: 0;
      width: 80px;
      color: #13E8E9;
      font-size: 0.8em;
      text-align: left;
      text-indent: 4px;
      line-height: 14px;
      padding-bottom: 2px;
      font-family: Helvetica, Arial, sans-serif;
      font-weight: bold;
      border-radius: 3px 3px 0 0;
      overflow: hidden;
    }

    .js-count-particles {
      font-size: 1.1em;
    }

    /* Semi-transparent rectangle in the top right corner */
    .info-box {
      position: absolute;
      top: 20px;
      right: 20px;
      background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent white background */
      padding: 15px;
      border-radius: 5px;
    }

    .info-text {
      color: #000;
      font-size: 36px; /* Increased the font size to 36px */
      font-weight: bold;
      line-height: 1.5;
      margin-bottom: 8px;
      display: flex;
      align-items: center;
    }

    /* Small squares with different colors and black outlines */
    .color-square {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 2px solid #000;
      margin-right: 10px;
      margin-bottom: 5px;
    }

    .green-square {
      background-color: #00ff00; /* Green color */
    }

    .orange-square {
      background-color: #ffA500; /* Orange color */
    }

    .blue-square {
      background-color: #0000ff; /* Blue color */
    }

    /* Adjusted the margin-top to align numbers better */
    .number {
      margin-top: 2px;
      font-size: 36px; /* Increased the font size to 36px */
    }

    /* Custom Popup Styles */
    .popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 20px;
      background-color: #fff;
      border: 2px solid #000;
      z-index: 2;
      text-align: center;
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }

    /* Added styles to control the size of the displayed image */
    #popup-image {
      max-width: 100%; /* Set maximum width to 100% of its container */
      max-height: 80vh; /* Set maximum height to 80% of the viewport height */
    }

    /* Adjusted the styles for the buttons */
    .popup-buttons {
      margin-top: 20px;
    }

    .popup-button {
      padding: 10px 20px;
      font-size: 18px;
      cursor: pointer;
      margin: 0 10px;
    }
    #end-game-button {
    position: fixed;
    bottom: 20px;
    left: 20px;
    z-index: 3; /* Ensure the button is on top of other elements */
  }

  #end-game-button button {
    padding: 15px 25px;
    font-size: 20px;
    cursor: pointer;
    background-color: transparent;
    color: #AEC6CF; /* Red text color */
    border: 2px solid #AEC6CF; /* Red border */
    border-radius: 10px;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
  }

  #end-game-button button:hover {
    background-color: #b61924; /* Red background on hover */
    color: #fff; /* White text color on hover */
    border-color: #fff; /* White border on hover */
  }
  </style>
</head>
<body>

<div id="particles-js"></div>
<div class="grid-container" onclick="showGridNumber(event)">
<?php
$questionTypes = array_merge(
    array_fill(0, 16, 'easy'),
    array_fill(0, 17, 'medium'),
    array_fill(0, 16, 'hard')
);

shuffle($questionTypes); // Shuffle the array to randomize question types

$count = 1;
$eas = 1;
$med =1;
$har = 1;
for ($row = 1; $row <= 7; $row++) {
    for ($col = 1; $col <= 7; $col++) {
        $questionType = array_pop($questionTypes);
        $backgroundColor = getBackgroundColor($questionType);
        if ($questionType == 'easy') {
          $type = 'e';
          $num = $eas;
          $eas += 1;
        }
        if ($questionType == 'medium') {
          $type = 'm';
          $num = $med;
          $med += 1;
        }
        if ($questionType == 'hard') {
          $type = 'h';
          $num = $har;
          $har += 1;
        }
        echo '<div class="grid-item" data-number="' . $count . '" data-numbers="' . $type . $num . '" style="background-color:' . $backgroundColor . ';">' . $count . '</div>';
        $count++;
    }
}
?>

<?php
// Function to get the background color based on question type
function getBackgroundColor($questionType) {
    switch ($questionType) {
        case 'easy':
            return 'rgba(172, 120, 186, 0.5)';
        case 'medium':
            return 'rgba(255, 255, 255, 0.5)';
        case 'hard':
            return 'rgba(128, 0, 128, 0.5)';
        default:
            return 'rgba(0, 0, 0, 0.5)';
    }
}
?>
</div>

<!-- Info box in the top right corner -->
<div class="info-box">
  <div class="info-text">
    <div class="color-square green-square"></div> <span class="number" id="green-score">100</span>
  </div>
  <div class="info-text">
    <div class="color-square orange-square"></div> <span class="number" id="orange-score">100</span>
  </div>
  <div class="info-text">
    <div class="color-square blue-square"></div> <span class="number" id="blue-score">100</span>
  </div>
</div>

<!-- Custom Popup -->
<div class="overlay" id="overlay" onclick="hidePopup()"></div>
<div class="popup" id="popup">
  <img id="popup-image" src="" alt="Image">
  <div class="popup-buttons">
    <button class="popup-button" onclick="checkAndColorGrid()">✔️</button>
    <button class="popup-button" onclick="subtractFromValueAndClose()">❌</button>
  </div>
</div>
<div id="end-game-button">
  <button onclick="redirectToPodium()">END GAME</button>
</div>

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    // Function to redirect to podium.php
    function redirectToPodium() {
    
    window.location.href = 'loading.php/?id1='+ document.getElementById(`green-score`).textContent + '&id2=' + document.getElementById(`orange-score`).textContent + '&id3=' + document.getElementById(`blue-score`).textContent;
  }
  // Player turn order
  easys = 1;
  mediums = 1;
  hards = 1;
  const playerTurns = ['green', 'orange', 'blue'];
  let currentPlayerIndex = 0;

  // Function to get the current player color
  function getCurrentPlayer() {
    return playerTurns[currentPlayerIndex];
  }

  // Starting values for scores
  const scores = {
    green: 100,
    orange: 100,
    blue: 100
  };

  function getBackgroundColors(questionType) {
    switch (questionType) {
        case 'easy':
            return 'rgba(172, 120, 186, 0.5)';
        case 'medium':
            return 'rgba(255, 255, 255, 0.5)';
        case 'hard':
            return 'rgba(128, 0, 128, 0.5)';
        default:
            return 'rgba(0, 0, 0, 0.5)';
    }
}

// Function to show the grid number in a custom popup with buttons
function showGridNumber(event) {
  const target = event.target;
  if (target.classList.contains('grid-item')) {
    // Check if the grid item is already colored (blue, green, or orange)
    const computedColor = window.getComputedStyle(target).backgroundColor;
    if (computedColor === getPlayerColor('green') || computedColor === getPlayerColor('orange') || computedColor === getPlayerColor('blue')) {
      return; // Do nothing if the grid is already colored
    }

    // Retrieve the data-numbers attribute value
    const dataNumbers = target.getAttribute('data-numbers');

    // Use dataNumbers as needed in your code
    const imageUrl = dataNumbers + '.jpg';
    document.getElementById('popup-image').src = imageUrl;
    showPopup();
  }
}

  // Function to show the custom popup
  function showPopup() {
    document.getElementById('overlay').style.display = 'block';
    document.getElementById('popup').style.display = 'block';
  }

  // Function to hide the custom popup
  function hidePopup() {
    document.getElementById('overlay').style.display = 'none';
    document.getElementById('popup').style.display = 'none';
  }

  // Function to check and color the grid with the current player's color
// Function to check and color the grid with the current player's color
function checkAndColorGrid() {
  const currentPlayer = getCurrentPlayer();

  let gridNumbers = document.getElementById('popup-image').src;
  var parts = gridNumbers.split('/');
  var filename = parts[parts.length - 1];

  gridNumbers = filename[0]
    // Determine the difficulty based on the grid number
  let difficultyscore;
  if (gridNumbers == 'e') {
    difficultyscore = 10; // Easy grid
  } else if (gridNumbers == 'm') {
    difficultyscore = 20; // Medium grid
  } else {
    difficultyscore = 30; // Hard grid
  }
  scores[currentPlayer] += difficultyscore;
  nomorsoal = filename.slice(0,-4);
  document.getElementById(`${currentPlayer}-score`).textContent = scores[currentPlayer];
  
  // Adjusted the line to extract the grid number
  const gridNumber = document.getElementById('popup-image').src.match(/(\d+)\.jpg/)[1];
  
  const gridItem = document.querySelector(`[data-numbers="${nomorsoal}"]`);
  const dataNumber = gridItem.dataset.number;
  
  // Remove the number from the grid item
  gridItem.textContent = '';

  // Change the color of the grid based on the current player
  gridItem.style.backgroundColor = getPlayerColor(currentPlayer);

  scores[currentPlayer] += (70 * checkForWin(currentPlayer, gridItem, dataNumber));
  document.getElementById(`${currentPlayer}-score`).textContent = scores[currentPlayer];

  hidePopup();
  switchPlayerTurn();
}


// Function to check for winning condition
function checkForWin(player, gridItem, dataNumber) {
  const row = Math.ceil(dataNumber / 7);
  let col = dataNumber % 7;
  if (col === 0) {
    col = 7;
  }
  let count = 0;
  // Check horizontally
  if (checkDirection(player, row, col, 0, 1)) count++;

  // Check vertically
  if (checkDirection(player, row, col, 1, 0)) count++;

  // Check diagonally (top-left to bottom-right)
  if (checkDirection(player, row, col, 1, 1)) count++;

  // Check diagonally (top-right to bottom-left)
  if (checkDirection(player, row, col, 1, -1)) count++;

  return count;
}

// Function to check in a specific direction for winning condition
function checkDirection(player, row, col, rowIncrement, colIncrement) {
  let aa = 0;
  let bb = 0;

  let active_aa = true;
  let active_bb = true;

  let i = 0;

  do {
    i++;
    const checkRow = row + i * rowIncrement;
    const checkCol = col + i * colIncrement;

    if (checkRow > 7 || checkCol > 7) {
      active_aa = false;
    }

    if (active_aa == true) {
      const checkItem = document.querySelector(`[data-number="${(checkRow - 1) * 7 + checkCol}"]`);

      const computedColor = window.getComputedStyle(checkItem).backgroundColor;
      if (computedColor === getPlayerColor(player)) {
        aa++;
      } else {
        active_aa = false;
      }
    }


    const checkRow2 = row - i * rowIncrement;
    const checkCol2 = col - i * colIncrement;

    if (checkRow2 < 1 || checkCol2 < 1) {
      active_bb = false;
    }

    if (active_bb == true) {
      const checkItem2 = document.querySelector(`[data-number="${(checkRow2 - 1) * 7 + checkCol2}"]`);

      const computedColor2 = window.getComputedStyle(checkItem2).backgroundColor;
      if (computedColor2 === getPlayerColor(player)) {
        bb++;
      } else {
        active_bb = false;
      }
    }

  } while (active_aa == true || active_bb == true);

  if (aa > 4 || bb > 4) {
    return false;
  }

  if (aa + bb >= 4) {
    return true;
  }

  return false;
}


  // Function to get the color of the player
  function getPlayerColor(player) {
    switch (player) {
      case 'green':
        return 'rgba(0, 255, 0, 0.5)'; // Green color
      case 'orange':
        return 'rgba(255, 165, 0, 0.5)'; // Orange color
      case 'blue':
        return 'rgba(0, 0, 255, 0.5)'; // Blue color
      default:
        return 'rgba(0,0,0,0.5)'; // Default to white
    }
  }

  // Function to subtract 50 from the current player's score and close the popup
  function subtractFromValueAndClose() {
    const currentPlayer = getCurrentPlayer();
    scores[currentPlayer] -= 10;
    document.getElementById(`${currentPlayer}-score`).textContent = scores[currentPlayer];
    hidePopup();
    switchPlayerTurn();
  }

  // Function to switch to the next player's turn
  function switchPlayerTurn() {
    currentPlayerIndex = (currentPlayerIndex + 1) % playerTurns.length;
  }

  /* ---- particles.js config ---- */
  particlesJS("particles-js", {
    "particles": {
      "size": {
        "value": 3, /* Set the size of the particles to 3 */
        "random": true,
        "anim": {
          "enable": false,
          "speed": 40,
          "size_min": 0.1,
          "sync": false
        }
      },
      // (Other particle configuration remains unchanged)
    },
    "interactivity": {
      // (Interactivity configuration remains unchanged)
    },
    "retina_detect": true
  });

  /* ---- stats.js config ---- */
  var count_particles, update;
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      // Your update logic here
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
</script>
</body>
</html>
