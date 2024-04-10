<?php 
    session_start();
    require_once 'config/db.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Booking Dashboard</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 800px;
  margin: 20px auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

h1 {
  text-align: center;
}

.car {
  border: 1px solid #ccc;
  margin-bottom: 10px;
  padding: 10px;
  border-radius: 5px;
}

.car h3 {
  margin-top: 0;
}

.car p {
  margin-bottom: 5px;
}

.book-button {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  border-radius: 5px;
}

  </style>
</head>
<body>
  <div class="container">
    <h1>Car Booking Dashboard</h1>
    <div id="carList"></div>
  </div>
  <script src="scripts.js">
    // Sample car data (replace with real data from backend)
const cars = [
  { id: 1, brand: "Toyota", model: "Corolla", year: 2022, available: true },
  { id: 2, brand: "Honda", model: "Civic", year: 2021, available: false },
  { id: 3, brand: "Ford", model: "Fusion", year: 2020, available: true }
];

// Function to display cars on the dashboard
function displayCars() {
  const carListContainer = document.getElementById('carList');
  carListContainer.innerHTML = ''; // Clear previous content
  
  cars.forEach(car => {
    const carDiv = document.createElement('div');
    carDiv.classList.add('car');
    carDiv.innerHTML = `
      <h3>${car.brand} ${car.model}</h3>
      <p>Year: ${car.year}</p>
      <p>Status: ${car.available ? 'Available' : 'Not available'}</p>
      <button class="book-button" onclick="bookCar(${car.id})">Book</button>
    `;
    carListContainer.appendChild(carDiv);
  });
}

// Function to simulate booking a car (replace with actual booking logic)
function bookCar(carId) {
  const bookedCar = cars.find(car => car.id === carId);
  if (bookedCar) {
    alert(`You have booked the ${bookedCar.brand} ${bookedCar.model}`);
    // Here you can add logic to update the booking status in the backend
  }
}

// Display cars when the page loads
window.onload = displayCars;

  </script>
</body>
</html>
