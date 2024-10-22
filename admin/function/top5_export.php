<?php
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

include '../../partial/connection.php';

$query_male = "
    SELECT cand_no, 
           CONCAT(cand_fn, ' ', cand_ln) AS full_name, 
           cand_team, 
           MAX(CASE WHEN judge_id = 46 THEN score END) AS judge_1_score,
           MAX(CASE WHEN judge_id = 47 THEN score END) AS judge_2_score,
           MAX(CASE WHEN judge_id = 48 THEN score END) AS judge_3_score,
           MAX(CASE WHEN judge_id = 49 THEN score END) AS judge_4_score,
           MAX(CASE WHEN judge_id = 50 THEN score END) AS judge_5_score
    FROM top5_scores_male
    GROUP BY cand_no
    ORDER BY cand_no
    LIMIT 5
";

$result_male = $conn->query($query_male);

if ($result_male === false) {
    die('Query Error: ' . $conn->error);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Top Candidates');

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

$sheet->setCellValue('A1', 'Top 5 Candidates of Mr. and Ms. PTCI 2024');
$sheet->mergeCells('A1:I1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$rowIndex = 2;

$sheet->setCellValue('A' . $rowIndex, 'Top 5 Male Candidates');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$rowIndex++;

$headers = ['Rank', 'Candidate No', 'Full Name', 'Team', 'Judge 1 Score', 'Judge 2 Score', 'Judge 3 Score', 'Judge 4 Score', 'Judge 5 Score'];
$sheet->fromArray($headers, NULL, 'A' . $rowIndex);
$sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)->getFont()->setBold(true);
$sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$rowIndex++;

$sheet->getColumnDimension('A')->setWidth(8); 
$sheet->getColumnDimension('B')->setWidth(12);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15); 
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(15);

if ($result_male && $result_male->num_rows > 0) {
    $rank = 1;
    while ($row = $result_male->fetch_assoc()) {
        $data = [
            $rank,
            $row['cand_no'],
            $row['full_name'],
            $row['cand_team'],
            $row['judge_1_score'] ?? 'N/A',
            $row['judge_2_score'] ?? 'N/A',
            $row['judge_3_score'] ?? 'N/A',
            $row['judge_4_score'] ?? 'N/A',
            $row['judge_5_score'] ?? 'N/A',
        ];
        $sheet->fromArray($data, NULL, 'A' . $rowIndex);
        $rank++;
        $rowIndex++;
    }
}

$rowIndex += 2;
$sheet->setCellValue('A' . $rowIndex, 'Top 5 Female Candidates');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$rowIndex++;

$femaleHeaders = ['Rank', 'Candidate No', 'Full Name', 'Team', 'Judge 1 Score', 'Judge 2 Score', 'Judge 3 Score', 'Judge 4 Score', 'Judge 5 Score'];
$sheet->fromArray($femaleHeaders, NULL, 'A' . $rowIndex);
$sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)->getFont()->setBold(true);
$sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':I' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$rowIndex++;

$sheet->getColumnDimension('A')->setWidth(8); 
$sheet->getColumnDimension('B')->setWidth(12); 
$sheet->getColumnDimension('C')->setWidth(30); 
$sheet->getColumnDimension('D')->setWidth(15); 
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15); 
$sheet->getColumnDimension('G')->setWidth(15); 
$sheet->getColumnDimension('H')->setWidth(15); 
$sheet->getColumnDimension('I')->setWidth(15); 

$query_female = "
    SELECT cand_no, 
           CONCAT(cand_fn, ' ', cand_ln) AS full_name, 
           cand_team, 
           MAX(CASE WHEN judge_id = 46 THEN score END) AS judge_1_score,
           MAX(CASE WHEN judge_id = 47 THEN score END) AS judge_2_score,
           MAX(CASE WHEN judge_id = 48 THEN score END) AS judge_3_score,
           MAX(CASE WHEN judge_id = 49 THEN score END) AS judge_4_score,
           MAX(CASE WHEN judge_id = 50 THEN score END) AS judge_5_score
    FROM top5_scores_female
    GROUP BY cand_no
    ORDER BY cand_no
    LIMIT 5
";

$result_female = $conn->query($query_female);

if ($result_female === false) {
    die('Query Error: ' . $conn->error);
}

if ($result_female && $result_female->num_rows > 0) {
    $rank = 1;
    while ($row = $result_female->fetch_assoc()) {
        $data = [
            $rank,
            $row['cand_no'],
            $row['full_name'],
            $row['cand_team'],
            $row['judge_1_score'] ?? 'N/A',
            $row['judge_2_score'] ?? 'N/A',
            $row['judge_3_score'] ?? 'N/A',
            $row['judge_4_score'] ?? 'N/A',
            $row['judge_5_score'] ?? 'N/A',
        ];
        $sheet->fromArray($data, NULL, 'A' . $rowIndex);
        $rank++;
        $rowIndex++;
    }
}

$rowIndex += 2;
$sheet->setCellValue('A' . $rowIndex, 'Judge Signatures');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$rowIndex++;

$judges = ['Judge 1', 'Judge 2', 'Judge 3', 'Judge 4', 'Judge 5'];

foreach ($judges as $index => $judge) {
    $sheet->setCellValue('A' . ($rowIndex + $index), $judge);
    $sheet->setCellValue('B' . ($rowIndex + $index), '____________________');
}

$rowIndex += count($judges);

$rowIndex++;
$sheet->setCellValue('A' . $rowIndex, 'Tabulator Signature');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$rowIndex++;

$sheet->setCellValue('A' . $rowIndex, '____________________');


$writer = new Xlsx($spreadsheet);
$filename = 'top_candidates_mr_ms_ptci_2024.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
