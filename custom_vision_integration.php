<?php

function perform_custom_vision_integration($imagePath) {
    // Azure Custom Vision settings
    $predictionKey = 'c6632ed3988e4f46949e921bfc539b75';
    $endpoint = 'https://westeurope.api.cognitive.microsoft.com/';
    $iterationId = '95145b0a-6dbf-461b-b026-fa927c57842e';

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
