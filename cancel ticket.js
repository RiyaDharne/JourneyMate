function confirmCancel() {
    const ticketNumber = 12511; // Replace with dynamic value if needed
    const username = "user123"; // Replace with dynamic value

    console.log("Sending Data:", { ticket_no: ticketNumber, username: username });

    fetch('cancel_ticket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ ticket_no: ticketNumber, username: username })
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response:", data);
        alert(data.message);
    })
    .catch(error => console.error('Error:', error));

    closeCancelModal();
}
