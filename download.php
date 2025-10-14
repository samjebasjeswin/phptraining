<?php
include __DIR__ . '/../db.php'; // Load Singleton DB if needed

class FileDownloader {

    private $fileDir;

    public function __construct($fileDir = null) {
        // Set default directory to project root or uploads folder
        $this->fileDir = $fileDir ?? __DIR__ . '/../uploads/';
    }

    public function download($file) {
        if (!$file) {
            $this->sendError("File not specified.");
        }

        $filename = basename($file); // prevent path traversal
        $filepath = $this->fileDir . $filename;

        if (!file_exists($filepath)) {
            $this->sendError("File not found.");
        }

        // Force download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    }

    private function sendError($message) {
        header('Content-Type: application/json');
        echo json_encode(["status" => 0, "message" => $message]);
        exit;
    }
}

// ---- Usage ----
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$file = $_GET['file'] ?? null;
$downloader = new FileDownloader(__DIR__ . '/../uploads/');
$downloader->download($file);