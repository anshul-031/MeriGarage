<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $to = $_POST['to'];
    $message = $_POST['message'];
    $file = $_FILES['file'];

    // Specify the uploads folder i have made in root
    $uploadDir = __DIR__ . '/upload/';

    // Create the uploads directory 
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file to the local storage
    $filename = uniqid() . '_' . $file['name'];
    $filePath = $uploadDir . $filename;
    move_uploaded_file($file['tmp_name'], $filePath);

    // Store the timestamp when the file was uploaded
    $timestampFile = $uploadDir . 'timestamps/' . $filename . '.txt';
    file_put_contents($timestampFile, time());

    // Include the link to the file in the message
    // $fileLink = "http://localhost:3000/uploads/$filename";
    $fileLink = "https://www.africau.edu/images/default/sample.pdf";
    // $message .= "\nDownload Your Invoice From Here: $fileLink";

    // rcsoft WhatsApp API code
    $whatsappApiUrl = 'https://whats-api.rcsoft.in/api/create-message';

    // Send the message via WhatsApp API
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $whatsappApiUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'appkey' => '7b51b259-af99-458c-a535-1aea2a870184',
            'authkey' => 'Suez5KExrxgKOibkfPl94yXZiMVFwvw33KC3f02rF1FHTYvqCj',
            'to' => $to,
            'message' => $message,
            'file' => $fileLink,
            'sandbox' => 'false',
        ),
    ));

    $response = curl_exec($curl);

    // Close the curl request
    curl_close($curl);

    // Output the response of the WhatsApp API request
    echo $response;
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Iam Using Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Invoice</title>





    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 480px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8 bg-white rounded shadow-md">
        <h1 class="text-3xl font-bold mb-8 text-center">Send Invoice On WhatsApp </h1>

        <form id="whatsappForm" method="POST" enctype="multipart/form-data">
            <label for="to" class="block mb-2">Receiver Number:</label>
            <input type="text" id="to" placeholder="Add +91 with number" name="to" required class="w-full p-2 mb-4 border">

            <label for="message" class="block mb-2">Message:</label>
            <textarea id="message" name="message" rows="4" required class="w-full p-2 mb-4 border">Thank you for doing purchase with us</textarea>

            <label for="file" class="block mb-2">Choose a file:</label>
            <input type="file" id="file" name="file" required class="w-full p-2 mb-4 border">

            <button type="button" onclick="sendWhatsAppMessage()" class="bg-green-500 text-white py-2 px-4 rounded w-full">
                Send Message
            </button>
        </form>
        <form action="dashboard.php" class="mt-6">
            <center> <button class="btn w-full max-w-md bg-blue-500 text-white py-2 px-4 rounded">Back To Dashboard</button></center>

        </form>

        <!-- Popup for loading -->
        <div id="loadingPopup" class="popup text-center">
            <p>Sending...</p>
        </div>

        <!-- Popup for message sent -->
        <div id="sentPopup" class="popup text-center">
            <p>Message sent successfully!</p>
        </div>

    </div>

    <script>
        function sendWhatsAppMessage() {

            showPopup('loadingPopup');

            var form = document.getElementById('whatsappForm');
            var formData = new FormData(form);

            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {

                    hidePopup('loadingPopup');
                    showPopup('sentPopup');
                    setTimeout(() => {
                        window.location.reload();
                    }, 3000);
                })
                .catch(error => {
                    hidePopup('loadingPopup');

                    console.error('Error:', error);
                });
        }

        function showPopup(id) {
            document.getElementById(id).style.display = 'block';
        }

        function hidePopup(id) {
            document.getElementById(id).style.display = 'none';
        }
    </script>

</body>

</html>