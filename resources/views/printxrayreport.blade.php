<!DOCTYPE html>
<html lang="en">
<body>

<div>
        <p style="text-align: center;"><b>X-Ray Count</b><br><b>From: {{$datefrom}} </b><b> To: {{$dateto}}</b></p>
        <p style="text-align: right;"><b>TOTAL : Php. <?php echo number_format($income, 2);?></b></p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="text-align: center;"><b>Date</b></th>
                    <th style="text-align: center;"><b>Xray Count</b></th>
                </tr>
            </thead>
            <tbody class="tbodyreports">
            @foreach($Patientxray as $xraycount)
                <tr>
                    <td style="text-align: center;">{{$xraycount->date_reg}}</td>
                    <td style="text-align: center;">{{$xraycount->counter}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

</div>

</body>
</html>