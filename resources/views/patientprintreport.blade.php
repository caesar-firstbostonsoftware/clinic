<!DOCTYPE html>
<html>
<style type="text/css">
	td{
		font-size: 10pt;
	}
</style>
<body>
	<table>
		<tbody>

			<tr>
            	<td>
            		<h3><i>PERSONAL INFO</i></h3>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 16%;"><b>Name:</b></td>
                        		<td>{{$patient->f_name}} {{$patient->m_name}} {{$patient->l_name}}</td>
                    		</tr>
                    		<tr>
                        		<td><b>Gender:</b></td>
                        		<td>{{$patient->gender}}</td>
                    		</tr>
                    		<tr>
                        		<td><b>Birthdate:</b></td>
                        		<td>{{$patient->dob}}</td>
                    		</tr>
                    		<tr>
                        		<td><b>Age:</b></td>
                        		<td>{{$patient->age}}</td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>

            <tr>
            	<td>
            		<h3><i>REASON FOR CONSULATION</i></h3>
                	<table>
                    	<tbody>
                    		<tr>
                    			<td style="width: 35%;"><b>Chief Complaint:</b></td>
                    			@if(!$reason)
                    			<td>N / A</td>
                    			@else
                                    @if(!$reason->chief_complaint)
                                        <td>N / A</td>
                                    @else
                        		      <td>{{$reason->chief_complaint}}</td>
                                    @endif
                        		@endif
                    		</tr>
                    		<tr>
                        		<td><b>History of Present Illness:</b></td>
                        		@if(!$reason)
                        		<td>N / A</td>
                    			@else
                                    @if(!$reason->chief_complaint)
                                        <td>N / A</td>
                                    @else
                        		        <td>{{$reason->history_of_present_illness}}</td>
                                    @endif
                        		@endif
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>

            <tr>
            	<td>
            		<h3><i>PAST MEDICAL HISTORY</i></h3>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 35%; text-align: right;"><b>Surgery:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                                        @if(!$past->surgery)
                                            N / A
                                        @else
                                            {{$past->surgery}}
                                        @endif
                        			@endif
                        			<br>
                        		<hr>
                        			<table border="0" cellpadding="3">
                            			<tbody>
                            				<tr>
                                				<td style="text-align:left">Date</td>
                                				<td style="text-align:left">Operation</td>
                            				</tr>
                            				@if(!$past)
                            				@else
                            				@foreach($past->surgery1001 as $sursur)
                            				@if(!$sursur->id)
                            				@else
                                            <tr>
                                    			<td>{{$sursur->date}}</td>
                                    			<td>{{$sursur->operation}}</td>
                                			</tr>
                                			@endif
                                			@endforeach
                                			@endif
                                        </tbody>
                                    </table>
                        		<hr>
                                </td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Hypertension:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                                        @if(!$past->hypertension)
                                            N / A
                                        @else
                                            {{$past->hypertension}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Diabetes Mellitus:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                                        @if(!$past->diabetes_mellitus)
                                            N / A
                                        @else
                                            {{$past->diabetes_mellitus}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Previous Hospitalization:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                                        @if(!$past->previous_hospitalization)
                                            N / A
                                        @else
                                            {{$past->previous_hospitalization}}
                                        @endif
                        			@endif
                        		<br>
                        		<hr>
                        			<table border="0" cellpadding="3">
                            			<tbody>
                            				<tr>
                                				<td style="text-align:left">Date</td>
                                				<td style="text-align:left">Diagnosis</td>
                            				</tr>
                            				@if(!$past)
                            				@else
                            				@foreach($past->hospitalization as $hoshos)
                            				@if(!$hoshos->id)
                            				@else
                                            <tr>
                                    			<td>{{$hoshos->date}}</td>
                                    			<td>{{$hoshos->diagnosis}}</td>
                                			</tr>
                                			@endif
                                			@endforeach
                                			@endif
                                        </tbody>
                                    </table>
                        		<hr>
                                </td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Diseases Diagnosed:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                                        @if(!$past->diseases_diagnosed)
                                            N / A
                                        @else
                                            {{$past->diseases_diagnosed}}
                                        @endif
                        			@endif
                        		<br>
                        		<hr>
                        			<table border="0" cellpadding="3">
                            			<tbody>
                            				<tr>
                                				<td style="text-align:left">Date</td>
                                				<td style="text-align:left">Disease</td>
                            				</tr>
                            				@if(!$past)
                            				@else
                            				@foreach($past->disease as $disease)
                            				@if(!$disease->id)
                            				@else
                                            <tr>
                                    			<td>{{$disease->date}}</td>
                                    			<td>{{$disease->disease}}</td>
                                			</tr>
                                			@endif
                                			@endforeach
                                			@endif
                                        </tbody>
                                    </table>
                        		<hr>
                                </td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Vaccinations:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                                        @if(!$past->vaccination)
                                            N / A
                                        @else
                                            {{$past->vaccination}}
                                        @endif
                        			@endif
                        		<br>
                        		<hr>
                        			<table border="0" cellpadding="3">
                            			<tbody>
                            				<tr>
                                				<td style="text-align:left">Date</td>
                                				<td style="text-align:left">Vaccine</td>
                            				</tr>
                            				@if(!$past)
                            				@else
                            				@foreach($past->vaccination1001 as $vacvac)
                            				@if(!$vacvac->id)
                            				@else
                                            <tr>
                                    			<td>{{$vacvac->date}}</td>
                                    			<td>{{$vacvac->vaccine}}</td>
                                			</tr>
                                			@endif
                                			@endforeach
                                			@endif
                                        </tbody>
                                    </table>
                        		<hr>
                                </td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>

            <tr>
            	<td>
            		<h3><i>SOCIAL HISTORY</i></h3>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 35%; text-align: right;"><b>Allergies?</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$social)
                        				N / A
                        			@else
                                        @if(!$social->allergy)
                                            N / A
                                        @else
                                            {{$social->allergy}}
                                        @endif
                        			@endif
                        		<br>
                        			@if(!$social)
                        			@else
                                        @if(!$social->allergy_desc)
                                        @else
                                            {{$social->allergy_desc}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Do you drink alcohol?</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$social)
                        				N / A
                        			@else
                                        @if(!$social->alcohol)
                                            N / A
                                        @else
                                            {{$social->alcohol}}
                                        @endif
                        			@endif
                        		<br>
                        			@if(!$social)
                        			@else
                                        @if(!$social->alcohol_desc)
                                        @else
                                            {{$social->alcohol_desc}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Do you smoke?</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$social)
                        				N / A
                        			@else
                                        @if(!$social->smoke)
                                            N / A
                                        @else
                                            {{$social->smoke}}
                                        @endif
                        			@endif
                        		<br>
                        			@if(!$social)
                        			@else
                                        @if(!$social->smoke_desc)
                                        @else
                                            {{$social->smoke_desc}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>

            <tr>
            	<td>
            	<h3><i>PHYSICAL EXAM</i></h3>
                	<table>
                    	<tbody>
                    		<tr>
                        		<td style="width: 35%; text-align: right;"><b>General Survey:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->gen_survey)
                                            N / A
                                        @else
                                            {{$PE->gen_survey}}
                                        @endif
                        			@endif	
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Vital Signs:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td><hr>
                            		<table border="0" cellpadding="0">
                                		<tbody>
                                			<tr>
                                				<td style="width: 20%;"><b>BP:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                                                        @if(!$PE->bp)
                                                            N / A
                                                        @else
                                                            {{$PE->bp}}
                                                        @endif
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>HR:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                                                        @if(!$PE->hr)
                                                            N / A
                                                        @else
                                                            {{$PE->hr}}
                                                        @endif
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>RR:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                                                        @if(!$PE->rr)
                                                            N / A
                                                        @else
                                                            {{$PE->rr}}
                                                        @endif
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Temp.:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                                                        @if(!$PE->temp)
                                                            N / A
                                                        @else
                                                            {{$PE->temp}}
                                                        @endif
                        							@endif
                                				</td> 
                                			</tr> 
                            			</tbody>
                            		</table>
                            	<hr>
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Head:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->head)
                                            N / A
                                        @else
                                            {{$PE->head}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Neck:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->neck)
                                            N / A
                                        @else
                                            {{$PE->neck}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Chest / Lung:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->chest_lung)
                                            N / A
                                        @else
                                            {{$PE->chest_lung}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Heart:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->heart)
                                            N / A
                                        @else
                                            {{$PE->heart}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Abdomen:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->abdomen)
                                            N / A
                                        @else
                                            {{$PE->abdomen}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Back:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->back)
                                            N / A
                                        @else
                                            {{$PE->back}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Extremities:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->extermity)
                                            N / A
                                        @else
                                            {{$PE->extermity}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                     		<tr>
                        		<td style="text-align: right;"><b>Neuro Exam:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                                        @if(!$PE->neuro_exam)
                                            N / A
                                        @else
                                            {{$PE->neuro_exam}}
                                        @endif
                        			@endif
                        		</td>
                    		</tr>
                		</tbody>
                	</table>
            	</td>
            </tr>

            <tr>
            	<td>
            	<h3><i>DIAGNOSIS</i></h3>
            		<p>
            			@if(!$diagnosis)
            				N / A
            			@else
                            @if(!$diagnosis->diagnosis)
                                N / A
                            @else
                                {{$diagnosis->diagnosis}}
                            @endif
            			@endif
            		</p>
            	</td>
            </tr>

            <tr>
                <td>
                <h3><i>PLAN</i></h3>
                    <p>
                        @if(!$plan)
                            N / A
                        @else
                            @if(!$plan->plan)
                                N / A
                            @else
                                {{$plan->plan}}
                            @endif
                        @endif
                    </p>
                </td>
            </tr>

            <tr>
                <td>
                <h3><i>MEDICATIONS</i></h3>
                    <table border="1" cellpadding="3" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="text-align: center">Date Started</th>
                                <th style="text-align: center">Drug</th>
                                <th style="text-align: center">Frequency</th>
                                <th style="text-align: center">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($med as $medmed)
                            <tr>
                                <td>{{$medmed->date_start}}</td>
                                <td>{{$medmed->drug}}</td>
                                <td>{{$medmed->frequency}}</td>
                                <td>{{$medmed->quantity}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <h3><i>X-Ray</i></h3>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 20%;"><b>X-Ray Date:</b></td>
                                <td style="width: 80%;">
                                    @if(!$p_xray)
                                        N / A
                                    @else
                                        @foreach($p_xray->xraydate as $datdat)
                                            @if(!$datdat->id)
                                                {{$p_xray->xray_date}}
                                            @else
                                                {{$datdat->date}}
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Physician Name:</b></td>
                                <td>
                                    @if(!$p_xray)
                                        N / A
                                    @else
                                        {{$p_xray->doctor->f_name}} {{$p_xray->doctor->f_name}} {{$p_xray->doctor->f_name}}, {{$p_xray->doctor->credential}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Result / Finding:</b></td>
                                <td>
                                    @if(!$p_xray)
                                        N / A
                                    @else
                                        <b>{{$p_xray->finding}}</b>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align: justify;">
                                    @if(!$p_xray)
                                        N / A
                                    @else
                                        @if(!$p_xray->finding_info)
                                            N / A
                                        @else
                                            {{$p_xray->finding_info}}
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                <h3><i>Lab Test</i></h3>
                    <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Urinalysis</h4>
                    <table>
                        <tbody>
                            <tr>
                                <td style="width: 35%; text-align: right;"><b>Physician Name:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>
                                    @if(!$uriuri)
                                        N / A
                                    @else
                                        {{$uriuri->phy->f_name}} {{$uriuri->phy->f_name}} {{$uriuri->phy->f_name}}, {{$uriuri->phy->credential}}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 35%; text-align: right;"><b>PHYSICAL:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>
                                    @if(!$uriuri)
                                        N / A
                                    @else
                                        {{$uriuri->physical}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%; text-align: right;"></td>
                                <td>
                                    <table border="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60%;"><b>Color:</b></td>
                                                <td style="width: 40%;">
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->color)
                                                            N / A
                                                        @else
                                                            {{$uriuri->color}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td><b>Transparency:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->transparency)
                                                            N / A
                                                        @else
                                                            {{$uriuri->transparency}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td><b>Suriuricific Gravity:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->specific_gravity)
                                                            N / A
                                                        @else
                                                            {{$uriuri->specific_gravity}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                        </tbody>
                                    </table>
                                    <hr>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 35%; text-align: right;"><b>CHEMICAL:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>
                                    @if(!$uriuri)
                                        N / A
                                    @else
                                        {{$uriuri->chemical}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%; text-align: right;"></td>
                                <td>
                                    <table border="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60%;"><b>Glucose:</b></td>
                                                <td style="width: 40%;">
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->glucose)
                                                            N / A
                                                        @else
                                                            {{$uriuri->glucose}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td><b>Bilirubin:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->bilirubin)
                                                            N / A
                                                        @else
                                                            {{$uriuri->bilirubin}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td><b>Ketone:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->ketone)
                                                            N / A
                                                        @else
                                                            {{$uriuri->ketone}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Blood:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->blood)
                                                            N / A
                                                        @else
                                                            {{$uriuri->blood}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>pH:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->ph)
                                                            N / A
                                                        @else
                                                            {{$uriuri->ph}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Protein:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->protein)
                                                            N / A
                                                        @else
                                                            {{$uriuri->protein}}
                                                        @endif
                                                        
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Urobilinogen:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->urobilinogen)
                                                            N / A
                                                        @else
                                                            {{$uriuri->urobilinogen}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Nitrities:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->nitrites)
                                                            N / A
                                                        @else
                                                            {{$uriuri->nitrites}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Leucocytes:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->leucocytes)
                                                            N / A
                                                        @else
                                                            {{$uriuri->leucocytes}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 35%; text-align: right;"><b>MICROSCOPIC:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>
                                    @if(!$uriuri)
                                        N / A
                                    @else
                                        {{$uriuri->microscopic}}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 25%; text-align: right;"></td>
                                <td>
                                    <table border="0" cellpadding="0">
                                        <tbody>
                                            <tr>
                                                <td style="width: 60%;"><b>WBC:</b></td>
                                                <td style="width: 40%;">
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->wbc)
                                                            N / A
                                                        @else
                                                            {{$uriuri->wbc}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td><b>RBC:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->rbc)
                                                            N / A
                                                        @else
                                                            {{$uriuri->rbc}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr> 
                                            <tr>
                                                <td><b>Epith. Cells:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->epith_cell)
                                                            N / A
                                                        @else
                                                            {{$uriuri->epith_cell}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Bacteria:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->bacteria)
                                                            N / A
                                                        @else
                                                            {{$uriuri->bacteria}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Cast(s):</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->cast)
                                                            N / A
                                                        @else
                                                            {{$uriuri->cast}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->cast2)
                                                            N / A
                                                        @else
                                                            {{$uriuri->cast2}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Crystal(s):</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->crystal)
                                                            N / A
                                                        @else
                                                            {{$uriuri->crystal}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        
                                                    @else
                                                        @if(!$uriuri->crystal2)
                                                            N / A
                                                        @else
                                                            {{$uriuri->crystal2}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Amorphous Materials:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->amorphous_material)
                                                            N / A
                                                        @else
                                                            {{$uriuri->amorphous_material}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Mucus Thread:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->mucus_thread)
                                                            N / A
                                                        @else
                                                            {{$uriuri->mucus_thread}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td><b>Others:</b></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->other)
                                                            N / A
                                                        @else
                                                            {{$uriuri->other}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->other2)
                                                            N / A
                                                        @else
                                                            {{$uriuri->other2}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    @if(!$uriuri)
                                                        N / A
                                                    @else
                                                        @if(!$uriuri->other3)
                                                            N / A
                                                        @else
                                                            {{$uriuri->other3}}
                                                        @endif
                                                    @endif
                                                </td> 
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- <tr>
            	<td>
            	<h2>TOTAL : &nbsp;&nbsp;&nbsp;PHP. <?php echo number_format($income, 2, '.', '');?></h2>
            	</td>
            </tr> -->

		</tbody>
	</table>
</body>
</html>