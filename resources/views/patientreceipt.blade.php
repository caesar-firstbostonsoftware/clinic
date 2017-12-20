<!DOCTYPE html>
<html lang="en">
<body>

<div>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">
                        <b style="font-size:9pt;">NEGROS FAMILY HEALTH SERVICES, INC.</b><br>
                        <span style="font-size: 7pt;">NORTH ROAD, DARO (IN FRONT OF NOPH)<br>DUMAGUETE CITY, NEGROS ORIENTAL<br>TEL No. (035)225-3544</span>
                    </th>
                    <th style="text-align: center;">
                        <!-- <b style="font-size:9pt;">NEGROS FAMILY HEALTH SERVICES, INC.</b><br>
                        <span style="font-size: 7pt;">NORTH ROAD, DARO (IN FRONT OF NOPH)<br>DUMAGUETE CITY, NEGROS ORIENTAL<br>TEL No. (035)225-3544</span> -->
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <span style="font-size: 7pt;"><br>
                            <b>Date :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$totalbill->visit_date}}<br>
                            <b>Receipt # :</b> &nbsp;{{$recno}}<br>
                            <b>Name :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}<br>
                            <b>Gender :</b> &nbsp;&nbsp;&nbsp;&nbsp;{{$info->gender}}<br>
                            <b>Age :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->age}}
                        </span>
                    </th>
                    <th style="text-align: left;">
                        <!-- <span style="font-size: 7pt;"><br>
                            <b>Receipt # :</b> &nbsp;{{$recno}}<br>
                            <b>Name :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}<br>
                            <b>Gender :</b> &nbsp;&nbsp;&nbsp;&nbsp;{{$info->gender}}<br>
                            <b>Age :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->age}}
                        </span> -->
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">SERVICES</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->name}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    &nbsp;&nbsp;&nbsp;{{$ap->adminP->name}}<br>
                                @endif
                            @endforeach
                        </span>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">PRICE</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->price}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    @if($ap->adminP->price == 0)
                                        <br>
                                    @else
                                        &nbsp;&nbsp;&nbsp;{{$ap->adminP->price}}<br>
                                    @endif
                                @endif
                            @endforeach
                        </span>
                    </th>

                    <th style="text-align: left;">
                        <!-- <b style="font-size:9pt;">SERVICES</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->name}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    &nbsp;&nbsp;&nbsp;{{$ap->adminP->name}}<br>
                                @endif
                            @endforeach
                        </span> -->
                    </th>
                    <th style="text-align: right;">
                        <!-- <b style="font-size:9pt;">PRICE</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->price}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    @if($ap->adminP->price == 0)
                                        <br>
                                    @else
                                        &nbsp;&nbsp;&nbsp;{{$ap->adminP->price}}<br>
                                    @endif
                                @endif
                            @endforeach
                        </span> -->
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
        <?php $total =  number_format($totalbill->totalbill, 2);?>
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">AMOUNT</b>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">{{$total}}</b>
                    </th>

                    <th style="text-align: left;">
                        <!-- <b style="font-size:9pt;">AMOUNT</b> -->
                    </th>
                    <th style="text-align: right;">
                        <!-- <b style="font-size:9pt;">{{$total}}</b> -->
                    </th>
                </tr>
            </thead>
        </table>
        <table style="width:100%;">
        <?php $discounted_price =  number_format($totalbill->discounted_price, 2);?>
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">LESS DISCOUNT</b>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">{{$discounted_price}}</b>
                    </th>

                    <th style="text-align: left;">
                        <!-- <b style="font-size:9pt;">LESS DISCOUNT</b> -->
                    </th>
                    <th style="text-align: right;">
                        <!-- <b style="font-size:9pt;">{{$discounted_price}}</b> -->
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">---------------</b>
                    </th>

                    <th style="text-align: left;">
                    </th>
                    <th style="text-align: right;">
                        <!-- <b style="font-size:9pt;">---------------</b> -->
                    </th>
                </tr>
            </thead>
        </table>
        
        <table style="width:100%;">
        <?php $discounted_total =  number_format($totalbill->discounted_total, 2);?>
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">TOTAL</b>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">Php. {{$discounted_total}}</b>
                    </th>

                    <th style="text-align: left;">
                        <!-- <b style="font-size:9pt;">TOTAL</b> -->
                    </th>
                    <th style="text-align: right;">
                        <!-- <b style="font-size:9pt;">Php. {{$discounted_total}}</b> -->
                    </th>
                </tr>
            </thead>
        </table>
</div>

<!-- <div>
        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: center;">
                        <b style="font-size:9pt;">NEGROS FAMILY HEALTH SERVICES, INC.</b><br>
                        <span style="font-size: 7pt;">NORTH ROAD, DARO (IN FRONT OF NOPH)<br>DUMAGUETE CITY, NEGROS ORIENTAL<br>TEL No. (035)225-3544</span>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <span style="font-size: 7pt;"><br>
                            <b>Receipt # :</b> &nbsp;{{$recno}}<br>
                            <b>Name :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->f_name}} {{$info->m_name}} {{$info->l_name}}<br>
                            <b>Gender :</b> &nbsp;&nbsp;&nbsp;&nbsp;{{$info->gender}}<br>
                            <b>Age :</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$info->age}}
                        </span>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">SERVICES</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->name}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    &nbsp;&nbsp;&nbsp;{{$ap->adminP->name}}<br>
                                @endif
                            @endforeach
                        </span>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">PRICE</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->price}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    @if($ap->adminP->price == 0)
                                        <br>
                                    @else
                                        &nbsp;&nbsp;&nbsp;{{$ap->adminP->price}}<br>
                                    @endif
                                @endif
                            @endforeach
                        </span>
                    </th>

                    <th style="text-align: left;">
                        <b style="font-size:9pt;">SERVICES</b>
                        <span style="font-size: 7pt;"><br>
                            @foreach($PatientService as $ap)
                                @if($ap->admin_panel_id != 0 && $ap->admin_panel_sub_id != 0)
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$ap->adminsubP->name}}<br>
                                @elseif($ap->admin_panel_id != 0)
                                    &nbsp;&nbsp;&nbsp;{{$ap->adminP->name}}<br>
                                @endif
                            @endforeach
                        </span>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
        <?php $total =  number_format($totalbill->totalbill, 2);?>
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">AMOUNT</b>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">{{$total}}</b>
                    </th>
                </tr>
            </thead>
        </table>
        <table style="width:100%;">
        <?php $discounted_price =  number_format($totalbill->discounted_price, 2);?>
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">LESS DISCOUNT</b>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">{{$discounted_price}}</b>
                    </th>
                </tr>
            </thead>
        </table>

        <table style="width:100%;">
            <thead>
                <tr>
                    <th style="text-align: left;">
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">---------------</b>
                    </th>
                </tr>
            </thead>
        </table>
        
        <table style="width:100%;">
        <?php $discounted_total =  number_format($totalbill->discounted_total, 2);?>
            <thead>
                <tr>
                    <th style="text-align: left;">
                        <b style="font-size:9pt;">TOTAL</b>
                    </th>
                    <th style="text-align: right;">
                        <b style="font-size:9pt;">Php. {{$discounted_total}}</b>
                    </th>
                </tr>
            </thead>
        </table>
</div> -->

</body>
</html>