<?php
require_once __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $content = $_POST['content'] ?? '';

    $mpdf = new \Mpdf\Mpdf();
    $html = "<html><body>{$content}</body></html>";

    $mpdf->WriteHTML($html);
    $mpdf->Output("documento.pdf", "D");
}
