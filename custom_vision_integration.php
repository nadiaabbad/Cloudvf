<?php

function perform_custom_vision_integration($imagePath) {
    // Azure Custom Vision settings
    $predictionKey = 'c6632ed3988e4f46949e921bfc539b75';
    $endpoint = 'https://westeurope.api.cognitive.microsoft.com/';
    $iterationId = '/subscriptions/f2730c77-6230-4885-b050-4c5f383f05bc/resourceGroups/Projetfinal/providers/Microsoft.CognitiveServices/accounts/cloud_project';

    // Prepare the image data for sending to Azure Custom Vision
    $imageData = file_get_contents($imagePath);

    // Prepare the request to Azure Custom Vision
    $ch = curl_init($endpoint . '/classify/iterations/' . $iterationId . '/image');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $imageData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/octet-stream',
        'Prediction-Key: ' . $predictionKey,
    ]);

    // Execute the request
    $response = curl_exec($ch);

    // Check for errors and process the response
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    } else {
        $result = json_decode($response, true);

        // Extract and display the predicted tags
        $tags = $result['predictions'];
        foreach ($tags as $tag) {
            echo 'Predicted Tag: ' . $tag['tagName'] . ', Probability: ' . $tag['probability'] . '<br>';
        }
    }

    // Close cURL session
    curl_close($ch);
}
