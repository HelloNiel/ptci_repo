<?php
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

include '../../partial/connection.php';

$query_male = "
    SELECT c.cand_no, 
    CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, 
    c.cand_team,
    MAX(CASE WHEN us.judge_id = 46 THEN us.score END) AS judge_1_score,
    MAX(CASE WHEN us.judge_id = 47 THEN us.score END) AS judge_2_score,
    MAX(CASE WHEN us.judge_id = 48 THEN us.score END) AS judge_3_score,
    MAX(CASE WHEN us.judge_id = 49 THEN us.score END) AS judge_4_score,
    MAX(CASE WHEN us.judge_id = 50 THEN us.score END) AS judge_5_score,
    (IFNULL(MAX(CASE WHEN us.judge_id = 46 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 47 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 48 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 49 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 50 THEN us.score END), 0)) / 5 AS total_score
    FROM top5_candidate_male c
    LEFT JOIN top5_scores_male us ON c.cand_no = us.cand_no
    GROUP BY c.cand_no
    ORDER BY total_score DESC
    LIMIT 5
";

$result_male = $conn->query($query_male);

if ($result_male === false) {
    die('Query Error: ' . $conn->error);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Top 5 Candidates');

$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

$sheet->setCellValue('A1', 'Top 5 Candidate of Mr. and Ms. PTCI 2024');
$sheet->mergeCells('A1:J1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$rowIndex = 2;
$sheet->setCellValue('A' . $rowIndex, 'Male Candidates');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$rowIndex++;

$headers = ['Rank', 'Candidate No', 'Full Name', 'Team', 'Judge 1 Score', 'Judge 2 Score', 'Judge 3 Score', 'Judge 4 Score', 'Judge 5 Score', 'Total Score (%)'];
$sheet->fromArray($headers, NULL, 'A' . $rowIndex);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getFont()->setBold(true);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(20);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$sheet->getColumnDimension('G')->setWidth(15);
$sheet->getColumnDimension('H')->setWidth(15);
$sheet->getColumnDimension('I')->setWidth(15);
$sheet->getColumnDimension('J')->setWidth(15);

if ($result_male && $result_male->num_rows > 0) {
    $rank = 1;
    $rowIndex++;
    while ($row = $result_male->fetch_assoc()) {
        $scores = [
            $row['judge_1_score'] ?? 0,
            $row['judge_2_score'] ?? 0,
            $row['judge_3_score'] ?? 0,
            $row['judge_4_score'] ?? 0,
            $row['judge_5_score'] ?? 0,
        ];
        $totalScore = array_sum($scores) / (count($scores) * 10) * 100;

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
            number_format($totalScore, 2) . '%',
        ];

        $sheet->fromArray($data, NULL, 'A' . $rowIndex);
        $rank++;
        $rowIndex++;
    }
}

$rowIndex += 2;

$sheet->setCellValue('A' . $rowIndex, 'Female Candidates');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$rowIndex++;

$femaleHeaders = ['Rank', 'Candidate No', 'Full Name', 'Team', 'Judge 1 Score', 'Judge 2 Score', 'Judge 3 Score', 'Judge 4 Score', 'Judge 5 Score', 'Total Score (%)'];
$sheet->fromArray($femaleHeaders, NULL, 'A' . $rowIndex);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getFont()->setBold(true);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':J' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$rowIndex++;

$query_female = "
    SELECT c.cand_no, 
    CONCAT(c.cand_fn, ' ', c.cand_ln) AS full_name, 
    c.cand_team,
    MAX(CASE WHEN us.judge_id = 46 THEN us.score END) AS judge_1_score,
    MAX(CASE WHEN us.judge_id = 47 THEN us.score END) AS judge_2_score,
    MAX(CASE WHEN us.judge_id = 48 THEN us.score END) AS judge_3_score,
    MAX(CASE WHEN us.judge_id = 49 THEN us.score END) AS judge_4_score,
    MAX(CASE WHEN us.judge_id = 50 THEN us.score END) AS judge_5_score,
    (IFNULL(MAX(CASE WHEN us.judge_id = 46 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 47 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 48 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 49 THEN us.score END), 0) +
    IFNULL(MAX(CASE WHEN us.judge_id = 50 THEN us.score END), 0)) / 5 AS total_score
    FROM top5_candidate_female c
    LEFT JOIN top5_scores_female us ON c.cand_no = us.cand_no
    GROUP BY c.cand_no
    ORDER BY total_score DESC
    LIMIT 5
";

$result_female = $conn->query($query_female);

if ($result_female === false) {
    die('Query Error: ' . $conn->error);
}

if ($result_female && $result_female->num_rows > 0) {
    $rank = 1;
    while ($row = $result_female->fetch_assoc()) {
        $scores = [
            $row['judge_1_score'] ?? 0,
            $row['judge_2_score'] ?? 0,
            $row['judge_3_score'] ?? 0,
            $row['judge_4_score'] ?? 0,
            $row['judge_5_score'] ?? 0,
        ];
        $totalScore = array_sum($scores) / (count($scores) * 10) * 100;

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
            number_format($totalScore, 2) . '%',
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

$rowIndex += count($judges) + 1;

$sheet->setCellValue('A' . $rowIndex, 'Tabulator Signature');
$sheet->mergeCells('A' . $rowIndex . ':J' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$rowIndex++;

$sheet->setCellValue('A' . $rowIndex, '____________________');

$writer = new Xlsx($spreadsheet);
$filename = 'Top_5_Candidate_Mr_and_Ms_PTCI_2024.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
