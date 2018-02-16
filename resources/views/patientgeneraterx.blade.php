<!DOCTYPE html>
<html lang="en">
<body>

<div>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">
                        <b>NEGROS FAMILY HEALTH SERVICES, INC.</b><br>
                        <span>NORTH ROAD, DARO (IN FRONT OF NOPH)<br>DUMAGUETE CITY, NEGROS ORIENTAL<br>TEL No. (035)225-3544<br></span>
                        <hr>
                    </th>
                    <th style="text-align: center;">
                        <b>NEGROS FAMILY HEALTH SERVICES, INC.</b><br>
                        <span>NORTH ROAD, DARO (IN FRONT OF NOPH)<br>DUMAGUETE CITY, NEGROS ORIENTAL<br>TEL No. (035)225-3544<br></span>
                        <hr>
                    </th>
                </tr>

                <tr>
                    <th style="text-align: left;">
                    <?php $datenow = date("Y-m-d"); ?>
                        <span><br>
                            &nbsp;<b>Name :</b> &nbsp;&nbsp;&nbsp;{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}<br>
                            &nbsp;<b>Age/Sex:</b>&nbsp;&nbsp;{{$info->age}} / {{$info->gender}}<br>
                            &nbsp;<b>Date:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$datenow}}
                        </span>
                    </th>
                    <th style="text-align: left;">
                        <span><br>
                            &nbsp;<b>Name :</b> &nbsp;&nbsp;&nbsp;{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}<br>
                            &nbsp;<b>Age/Sex:</b>&nbsp;&nbsp;{{$info->age}} / {{$info->gender}}<br>
                            &nbsp;<b>Date:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$datenow}}
                        </span>
                    </th>
                </tr>

                <tr>
                    <th style="text-align: left;">
                        <span style="font-size: 14pt;"><b>Rx</b></span>
                    </th>
                    <th style="text-align: left;">
                        <span style="font-size: 14pt;"><b>Rx</b></span>
                    </th>
                </tr>

                <tr><th></th></tr>

            </thead>
        </table>

        <table>
            <tbody>
                <tr>
                    <td>
                        <table style="border: 1px solid black;">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid black;text-align: center;">&nbsp;<b>Drug</b></th>
                                    <th style="border: 1px solid black;text-align: center;">&nbsp;<b>Frequency</b></th>
                                    <th style="border: 1px solid black;text-align: center;">&nbsp;<b>Quantity</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($med as $medmed)
                                <tr>
                                    <td style="border: 1px solid black;">&nbsp;{{$medmed->drug}}</td>
                                    <td style="border: 1px solid black;">&nbsp;{{$medmed->frequency}}</td>
                                    <td style="border: 1px solid black;">&nbsp;{{$medmed->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="border: 1px solid black;">
                            <thead>
                                <tr>
                                    <th style="border: 1px solid black;text-align: center;">&nbsp;<b>Drug</b></th>
                                    <th style="border: 1px solid black;text-align: center;">&nbsp;<b>Frequency</b></th>
                                    <th style="border: 1px solid black;text-align: center;">&nbsp;<b>Quantity</b></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($med as $medmed)
                                <tr>
                                    <td style="border: 1px solid black;">&nbsp;{{$medmed->drug}}</td>
                                    <td style="border: 1px solid black;">&nbsp;{{$medmed->frequency}}</td>
                                    <td style="border: 1px solid black;">&nbsp;{{$medmed->quantity}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr><td></td></tr>
                <tr><td></td></tr>

                <tr>
                    <td>
                        <b style="text-transform: uppercase;font-size:10pt;"><u>{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</u></b><br>
                        <span>License No.:</span>
                    </td>
                    <td>
                        <b style="text-transform: uppercase;font-size:10pt;"><u>{{$doc->f_name}} {{$doc->m_name}} {{$doc->l_name}}, {{$doc->credential}}</u></b><br>
                        <span>License No.:</span>
                    </td>
                </tr>
            </tbody>
        </table>

</div>

</body>
</html>