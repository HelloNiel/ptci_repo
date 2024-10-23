<?php
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

include '../../partial/connection.php';

$query_male = "
    SELECT `id`, `cand_no`, `cand_fn`, `cand_ln`, `cand_team`, `percentage_score` 
    FROM `top3_candidate_male`
    ORDER BY `percentage_score` DESC
    LIMIT 3
";

$result_male = $conn->query($query_male);

$query_female = "
    SELECT `id`, `cand_no`, `cand_fn`, `cand_ln`, `cand_team`, `percentage_score` 
    FROM `top3_candidate_female`
    ORDER BY `percentage_score` DESC
    LIMIT 3
";

$result_female = $conn->query($query_female);

if ($result_male === false || $result_female === false) {
    die('Query Error: ' . $conn->error);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Top Candidates');

$sheet->setCellValue('A1', 'Top 3 Male Candidates of Mr. and Ms. PTCI 2024');
$sheet->mergeCells('A1:F1');
$sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$rowIndex = 2;
$headers = ['Rank', 'Candidate No', 'Full Name', 'Team', 'Percentage Score (%)'];
$sheet->fromArray($headers, NULL, 'A' . $rowIndex);
$sheet->getStyle('A' . $rowIndex . ':E' . $rowIndex)->getFont()->setBold(true);
$sheet->getStyle('A' . $rowIndex . ':E' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':E' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(25);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(25);

if ($result_male && $result_male->num_rows > 0) {
    $rank = 1;
    $rowIndex++;
    while ($row = $result_male->fetch_assoc()) {
        $data = [
            $rank,
            $row['cand_no'],
            $row['cand_fn'] . ' ' . $row['cand_ln'],
            $row['cand_team'],
            number_format($row['percentage_score'], 2) . '%',
        ];

        $sheet->fromArray($data, NULL, 'A' . $rowIndex);
        $rank++;
        $rowIndex++;
    }
}

$rowIndex += 2;

$sheet->setCellValue('A' . $rowIndex, 'Top 3 Female Candidates of Mr. and Ms. PTCI 2024');
$sheet->mergeCells('A' . $rowIndex . ':F' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(14);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

$rowIndex++;
$headers = ['Rank', 'Candidate No', 'Full Name', 'Team', 'Percentage Score (%)'];
$sheet->fromArray($headers, NULL, 'A' . $rowIndex);
$sheet->getStyle('A' . $rowIndex . ':E' . $rowIndex)->getFont()->setBold(true);
$sheet->getStyle('A' . $rowIndex . ':E' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
$sheet->getStyle('A' . $rowIndex . ':E' . $rowIndex)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
$sheet->getColumnDimension('A')->setWidth(15);
$sheet->getColumnDimension('B')->setWidth(15);
$sheet->getColumnDimension('C')->setWidth(30);
$sheet->getColumnDimension('D')->setWidth(25);
$sheet->getColumnDimension('E')->setWidth(25);

if ($result_female && $result_female->num_rows > 0) {
    $rank = 1;
    $rowIndex++;
    while ($row = $result_female->fetch_assoc()) {
        $data = [
            $rank,
            $row['cand_no'],
            $row['cand_fn'] . ' ' . $row['cand_ln'],
            $row['cand_team'],
            number_format($row['percentage_score'], 2) . '%',
        ];

        $sheet->fromArray($data, NULL, 'A' . $rowIndex);
        $rank++;
        $rowIndex++;
    }
}

$rowIndex += 2;

$sheet->setCellValue('A' . $rowIndex, 'Judge Signatures');
$sheet->mergeCells('A' . $rowIndex . ':F' . $rowIndex);
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
$sheet->mergeCells('A' . $rowIndex . ':F' . $rowIndex);
$sheet->getStyle('A' . $rowIndex)->getFont()->setBold(true)->setSize(12);
$sheet->getStyle('A' . $rowIndex)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
$rowIndex++;

$sheet->setCellValue('A' . $rowIndex, '____________________');

$writer = new Xlsx($spreadsheet);
$filename = 'Top_3_Candidates_Mr_and_Ms_PTCI_2024.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
exit;
?>
