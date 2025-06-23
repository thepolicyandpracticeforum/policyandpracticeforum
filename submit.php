<?php
// Set maximum file size (in bytes) as a safety check:
$maxFileSize = 30 * 1024 * 1024; // 30MB

// Check if CV is uploaded:
if (isset($_FILES['cv'])) {
    if ($_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        if ($_FILES['cv']['size'] <= $maxFileSize) {
            // Save uploaded file to "uploads" directory:
            $uploadDir = __DIR__ . '/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true); // create directory if not exists
            }

            $fileName = basename($_FILES['cv']['name']);
            $targetPath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['cv']['tmp_name'], $targetPath)) {
                echo "✅ Thank you, your application has been successfully submitted!";
            } else {
                echo "❌ Error moving uploaded file.";
            }
        } else {
            echo "❌ Error: file too large (maximum 30MB).";
        }
    } else {
        echo "❌ Error uploading file.";
    }
} else {
    echo "❌ Please attach your CV.";
}
?>
