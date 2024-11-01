<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Width and Height Table</title>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        table {
            width: 100%;
            height: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>
                    <image src="{{asset('images/logo.png')}}" width="150px" height="200px" />
                </th>
                <th colspan="3">
                    <h2>MERIT DATALIGHT COLLEGE</h2>
                    <h5>Motto: Creating and evious legacy <br />
                        Address: Cadid Estate Phase II Opposite Origan 2nd Bus Stop Badagry Exp-way, Lagos<br />
                        Email: datalight444@gmail.com<br />
                        Tel: 07041112438, 07033056074, 08179531056
                    </h5>
                </th>
                <th> &nbsp;</th>



            </tr>
        </thead>
        <tbody>

            <tr>
                <td colspan="5"><b>TERMINAL SHEET</b></td>

            </tr>
            <tr>
                <td>END OF: THIRD TERM</td>
                <td>REPORT FOR: 2023/2024</td>
                <td colspan="3"></td>

            </tr>
            <tr>
                <td>NAME OF STUDENT:</td>
                <td colspan="3">Lawal Damilola</td>
                <td> &nbsp;</td>
            </tr>
            <tr>
                <td>Gender: FEMALE</td>
                <td>AGE: 9YEARS</td>
                <td>ADMISSION NO: MSDL005</td>
                <td>CLASS: BASIC 3</td>
                <td>HEIGHT: </td>
            </tr>
            <tr>
                <td>NO. OF TIMES SCHOOL OPENED: 116</td>
                <td>NO. OF TIMES PRESENT: 116</td>
                <td>SCHOOL RE-OPEN ON: 16- Sep-2024: </td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td colspan="3"><B>PERFORMANCE IN SUBJECTS</B></td>
                <td>Row 6 - Column 2</td>
                <td>Row 6 - Column 3</td>

            </tr>
            <tr>
                <td colspan="5">
                    <table>
                        <tr>
                            <th>SUBJECT</th>
                            <th>CONTINUOS<BR /> ASSESSMENT(30%)</th>
                            <th>END OF TERM<BR /> EXAM SCORE (70%)</th>
                            <th>1ST TERM <BR /> 100%</th>
                            <th>2ND TERM <BR /> 100% </th>
                            <th>3RD TERM <BR /> 100% </th>
                            <th>WEIGHT <BR />AVERAGE</th>
                            <th>GRADE</th>
                            <th>REMARKS</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>ENGLISH</td>
                                <td>30</td>
                                <td>70</td>
                                <td>100</td>
                                <td>100</td>
                                <td>100</td>
                                <td>100</td>
                                <td>AA</td>
                                <td>EXCELLENT</td>
                            </tr>
                            <tr>
                                <td>ENGLISH</td>
                                <td>30</td>
                                <td>70</td>
                                <td>100</td>
                                <td>100</td>
                                <td>100</td>
                                <td>100</td>
                                <td>AA</td>
                                <td>EXCELLENT</td>
                            </tr>

                            <tr>
                                <td>TOTAL</td>
                                <td>30</td>
                                <td>70</td>
                                <td>100</td>
                                <td>100</td>
                                <td>100</td>
                                <td>100</td>
                                <td>--</td>
                                <td>--</td>
                            </tr>

                            <tr>
                                <td>GRAND TOTAL</td>
                                <td>2400</td>
                                <td colspan="5">WEIGHTEDAVG: 79.21%</td>
                                <td>FINAL GRADE</td>
                                <td>A</td>
                                
                            </tr>

                        </tbody>
                    </table>

                </td>

            </tr>
            <tr>
                <td>Row 8 - Column 1</td>
                <td>Row 8 - Column 2</td>
                <td>Row 8 - Column 3</td>
                <td>Row 8 - Column 4</td>
                <td>Row 8 - Column 5</td>
            </tr>
            <tr>
                <td>Row 9 - Column 1</td>
                <td>Row 9 - Column 2</td>
                <td>Row 9 - Column 3</td>
                <td>Row 9 - Column 4</td>
                <td>Row 9 - Column 5</td>
            </tr>
            <tr>
                <td>Row 10 - Column 1</td>
                <td>Row 10 - Column 2</td>
                <td>Row 10 - Column 3</td>
                <td>Row 10 - Column 4</td>
                <td>Row 10 - Column 5</td>
            </tr>
        </tbody>
    </table>
</body>

</html>