// Combined data for stations with times (station names and estimated times)
const stations = [
    { name: "C SHIVAJI MAH T - CSMT", time: "05:10 AM" },
    { name: "DADAR - DR", time: "05:20 AM" },
    { name: "THANE - TNA", time: "05:45 AM" },
    { name: "PANVEL - PNVL", time: "06:25 AM" },
    { name: "CHIPLUN - CHI", time: "09:00 AM" },
    { name: "RATNAGIRI - RN", time: "10:45 AM" },
    { name: "KANKAVALI - KKW", time: "12:12 PM" },
    { name: "KUDAL - KUDL", time: "12:32 PM" },
    { name: "SAWANTWADI ROAD - SWW", time: "12:50 PM" },
    { name: "THIVIM - THVM", time: "01:02 PM" },
];

// Function to populate station list dynamically
function populateStations() {
    const stationList = document.getElementById('stationList');
    stations.forEach(station => {
        const li = document.createElement('li');
        li.textContent = `${station.name} - ${station.time}`;
        stationList.appendChild(li);
    });
}

// Function to simulate train's movement along the track
function moveTrain() {
    const train = document.getElementById('train');
    const totalDistance = 100; // Represent the full track as 100% (percentage-wise)
    let position = 0; // Starting position at the left

    // Simulate train movement
    const interval = setInterval(() => {
        if (position < totalDistance) {
            position += 0.5; // Move the train 1% every second
            train.style.transform = `translateX(${position}%)`; // Update the train's position
        } else {
            clearInterval(interval); // Stop the movement once the train reaches the end
        }
    }, 100); // Update position every second
}

// Call populateStations to show the list and start the train's movement
window.onload = () => {
    populateStations();
    moveTrain();
};
