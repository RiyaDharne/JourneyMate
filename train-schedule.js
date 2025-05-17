function navigate(page) {
    window.location.href = page;
}

// Prevent anchor tags from causing navigation issues
document.querySelectorAll(".nav-btn a").forEach(link => {
    link.addEventListener("click", (event) => {
        event.stopPropagation(); // Stop the event from bubbling up
    });
});
   document.addEventListener('DOMContentLoaded', function() {
    const scheduleBody = document.getElementById('scheduleBody');
    const submitButton = document.getElementById('submitButton');
    const trainNumberInput = document.getElementById('trainNumber');

    // Updated train schedule data
const trainScheduleData = {
    12051: [
        { name: "C SHIVAJI MAH T - CSMT", arrTime: "--", depTime: "05:10", day: 1, dist: 0, status: "On Time" },
        { name: "DADAR - DR", arrTime: "05:18", depTime: "05:20", day: 1, dist: 9, status: "On Time" },
        { name: "THANE - TNA", arrTime: "05:43", depTime: "05:45", day: 1, dist: 34, status: "On Time" },
        { name: "PANVEL - PNVL", arrTime: "06:23", depTime: "06:25", day: 1, dist: 69, status: "On Time" },
        { name: "CHIPLUN - CHI", arrTime: "09:00", depTime: "09:02", day: 1, dist: 325, status: "On Time" },
        { name: "RATNAGIRI - RN", arrTime: "10:40", depTime: "10:45", day: 1, dist: 431, status: "On Time" },
        { name: "KANKAVALI - KKW", arrTime: "12:10", depTime: "12:12", day: 1, dist: 587, status: "On Time" },
        { name: "KUDAL - KUDL", arrTime: "12:30", depTime: "12:32", day: 1, dist: 626, status: "On Time" },
        { name: "SAWANTWADI ROAD - SWW", arrTime: "12:50", depTime: "12:52", day: 1, dist: 655, status: "On Time" },
        { name: "THIVIM - THVM", arrTime: "13:20", depTime: "13:22", day: 1, dist: 701, status: "On Time" }
    ],

        11004: [
            { name: "SAWANTWADI ROAD - SWW", arrTime: "05:30", depTime: "05:32", day: 1, dist: 0 },
            { name: "KUDAL - KUDL", arrTime: "06:00", depTime: "06:02", day: 1, dist: 34 },
            { name: "KANKAVALI - KKW", arrTime: "06:40", depTime: "06:42", day: 1, dist: 69 },
            { name: "RATNAGIRI - RN", arrTime: "07:15", depTime: "07:20", day: 1, dist: 325 },
            { name: "CHIPLUN - CHI", arrTime: "08:00", depTime: "08:05", day: 1, dist: 431},
            { name: "PANVEL - PNVL", arrTime: "09:00", depTime: "09:02", day: 1, dist: 587},
            { name: "THANE - TNA", arrTime: "09:50", depTime: "09:55", day: 1, dist:  626},
            { name: "DADAR - DR", arrTime: "11:00", depTime: "11:05", day: 1, dist: 655}
        ]
    };

    // Show Submit button when train number is entered
    trainNumberInput.addEventListener('input', function() {
        if (trainNumberInput.value.trim() !== "") {
            submitButton.style.display = "inline-block";
        } else {
            submitButton.style.display = "none";
        }
    });

    // Submit button click event to display the schedule
    submitButton.addEventListener('click', function() {
        const trainNumber = trainNumberInput.value.trim();

        // Clear previous schedule
        scheduleBody.innerHTML = '';

        // If the entered train number exists in the data
        if (trainScheduleData[trainNumber]) {
            const schedule = trainScheduleData[trainNumber];

            // Populate the table with the schedule data
schedule.forEach(train => {
    const statusText = train.status ? train.status : "Status Unknown";

                const row = `<tr>
                    <td>${train.name}</td>
                    <td>${train.arrTime}</td>
                    <td>${train.depTime}</td>
                    <td>${train.day}</td>
                    <td>${train.dist}</td>
                </tr>`;
                scheduleBody.innerHTML += row;
            });
        } else {
            // If train number doesn't exist, show an error message
            scheduleBody.innerHTML = `<tr><td colspan="5">No schedule found for this train number. Please try again.</td></tr>`;
        }
    });
});
