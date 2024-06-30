<?php
ob_start(); // Start output buffering

// Include database connection and authentication files
include("db.php");
include("auth.php");

// Fetch deduction details based on deduction_id from URL parameter
$id = intval($_GET['deduction_id']); // Ensure the ID is an integer to prevent SQL injection

$query = "SELECT d.*, e.fname, e.lname, e.net FROM deductions d
LEFT JOIN employee e ON d.employee_id = e.emp_id
WHERE d.deduction_id = $id";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Deduction not found."; // Handle deduction not found scenario
    exit();
}

// Calculate Total Earnings and Net Pay
$totalEarnings = $row['salary'] + $row['overtime'] + $row['bonus'];
$totalDeductions = $row['undertime'] + $row['absences'] + $row['deduction'] + $row['philhealth'] + $row['pagibig'] + $row['sss'];

$netPay = $totalEarnings - $totalDeductions;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <!-- Bootstrap CSS (Minified) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5" id="printableArea">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center">
                    <h4 class="fw-bold">Payslip</h4>
                    <p class="fw-normal">Payment slip for the month of <?php echo date('F Y', strtotime($row['created_at'])); ?></p>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th scope="col">Earnings</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Deductions</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Basic Salary</td>
                                <td><?php echo number_format($row['salary'], 2); ?></td>
                                <td>Undertime</td>
                                <td><?php echo number_format($row['undertime'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>Overtime</td>
                                <td><?php echo number_format($row['overtime'], 2); ?></td>
                                <td>Absences</td>
                                <td><?php echo number_format($row['absences'], 2); ?></td>
                            </tr>
                            <tr>
                                <td>Bonus</td>
                                <td><?php echo number_format($row['bonus'], 2); ?></td>
                                <td>Deduction</td>
                                <td><?php echo number_format($row['deduction'], 2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>PhilHealth</td>
                                <td><?php echo number_format($row['philhealth'], 2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Pagibig</td>
                                <td><?php echo number_format($row['pagibig'], 2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>SSS</td>
                                <td><?php echo number_format($row['sss'], 2); ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="fw-bold">Total Earnings</td>
                                <td colspan="2"><?php echo number_format($totalEarnings, 2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="fw-bold">Total Deductions</td>
                                <td colspan="2"><?php echo number_format($totalDeductions, 2); ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" class="fw-bold">Net Pay</td>
                                <td colspan="2"><?php echo number_format($netPay, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <span class="fw-bold">Net Pay in Words:</span> <br>
                        <span><?php echo convertNumberToWords($netPay); ?> pesos only</span>
                    </div>
                    <div class="col-md-6">
                        <div class="text-end">
                            <span class="fw-bold">For Kalyan Jewellers</span> <br>
                            <span class="fw-bold">Authorised Signatory</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Minified, includes Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Awtomatikong i-print ang page pagkatapos mag-load
        window.onload = function () {
            window.print();
        };
    </script>
</body>

</html>

<?php
// Function to convert number to words
function convertNumberToWords($number)
{
    // A function to convert numbers into words
    // $number = (int)$number;
    $ones = array(
        0 => "Zero",
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Nineteen",
    );
    $tens = array(
        0 => "Twenty",
        1 => "Thirty",
        2 => "Forty",
        3 => "Fifty",
        4 => "Sixty",
        5 => "Seventy",
        6 => "Eighty",
        7 => "Ninety",
    );
    $hundreds = array(
        "Hundred",
        "Thousand",
        "Million",
        "Billion",
        "Trillion",
        "Quadrillion",
        "Quintillion",
    ); //limit t quadrillion
    $number = number_format($number, 2, ".", ",");
    $number_arr = explode(".", $number);
    $wholenum = $number_arr[0];
    $decnum = isset($number_arr[1]) ? $number_arr[1] : '';

    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {
        while (substr($i, 0, 1) == "0") $i = substr($i, 1, 5);
        if ($i < 20) {
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            $rettxt .= $tens[substr($i, 0, 1) - 2] . " " . $ones[substr($i, 1, 1)];
        } else {
            $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0] . " " . $tens[substr($i, 1, 1) - 2] . " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }

    $rettxt .= " Pesos";

    return $rettxt;
}

// Get the buffered content
$content = ob_get_clean();

// Print the buffered content
echo $content;
