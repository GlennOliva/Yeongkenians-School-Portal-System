<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Pdf</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            
            color: #495057;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #ffffff;
        }

        tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        p {
            text-align: center;
            font-size: 24px;
            color: #007bff;
            margin-top: 20px;
        }
    </style>
</head>
<body style="padding: 10px;">
    <p>GENERAL FLAVIANO YENGKO SENIOR HIGH SCHOOL</p>

    <table>
        <tr>
            <th>Subject</th>
            <th>Instructor</th>
            <th>1st Grading</th>
            <th>2nd Grading</th>
            <th>3rd Grading</th>
            <th>4th Grading</th>
            <th>Average</th>
            <th>Remarks</th>
        </tr>

        <?php foreach ($grades as $grade): ?>
            <tr>
                <td><?= $grade['subject'] ?></td>
                <td><?= $grade['instructor'] ?></td>
                <td><?= $grade['1st_grading'] ?></td>
                <td><?= $grade['2nd_grading'] ?></td>
                <td><?= $grade['3rd_grading'] ?></td>
                <td><?= $grade['4th_grading'] ?></td>
                <td><?= $grade['average'] ?></td>
                <td><?= $grade['remarks'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
