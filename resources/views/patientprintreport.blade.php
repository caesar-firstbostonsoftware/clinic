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
                        		<td>{{$reason->chief_complaint}}</td>
                        		@endif
                    		</tr>
                    		<tr>
                        		<td><b>History of Present Illness:</b></td>
                        		@if(!$reason)
                        		<td>N / A</td>
                    			@else
                        		<td>{{$reason->history_of_present_illness}}</td>
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
                        				{{$past->surgery}}
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
                        				{{$past->hypertension}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Diabetes Mellitus:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                        				{{$past->diabetes_mellitus}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Previous Hospitalization:&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
                        		<td>
                        			@if(!$past)
                        				N / A
                        			@else
                        				{{$past->previous_hospitalization}}
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
                        				{{$past->diseases_diagnosed}}
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
                        				{{$past->vaccination1001}}
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
                        				{{$social->allergy}}
                        			@endif
                        		<br>
                        			@if(!$social)
                        			@else
                        				{{$social->allergy_desc}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Do you drink alcohol?</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$social)
                        				N / A
                        			@else
                        				{{$social->alcohol}}
                        			@endif
                        		<br>
                        			@if(!$social)
                        			@else
                        				{{$social->alcohol_desc}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Do you smoke?</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$social)
                        				N / A
                        			@else
                        				{{$social->smoke}}
                        			@endif
                        		<br>
                        			@if(!$social)
                        			@else
                        				{{$social->smoke_desc}}
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
                        				{{$PE->gen_survey}}
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
                        								{{$PE->bp}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>HR:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->hr}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>RR:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Temp.:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->temp}}
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
                        				{{$PE->head}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Neck:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->neck}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Chest / Lung:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->chest_lung}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Heart:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->heart}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Abdomen:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->abdomen}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Back:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->back}}
                        			@endif
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="text-align: right;"><b>Extremities:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->extermity}}
                        			@endif
                        		</td>
                    		</tr>
                     		<tr>
                        		<td style="text-align: right;"><b>Neuro Exam:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			@if(!$PE)
                        				N / A
                        			@else
                        				{{$PE->neuro_exam}}
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
            				{{$diagnosis->diagnosis}}
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
            				{{$plan->plan}}
            			@endif
            		</p>
            	</td>
            </tr>

            <tr>
            	<td>
            	<h3><i>MEDICATIONS</i></h3>
             		<table border="1" cellpadding="3" cellspacing="0">
                		<tbody>
                			<tr>
                    			<th style="text-align: center">Drug</th>
                    			<th style="text-align: center">Frequency</th>
                    			<th style="text-align: center">Quantity</th>
                    			<th style="text-align: center">Status</th>
                			</tr>
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
                        				{{$p_xray->finding_info}}
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
                        				{{$uriuri->doctor->f_name}} {{$uriuri->doctor->f_name}} {{$uriuri->doctor->f_name}}, {{$uriuri->doctor->credential}}
                        			@endif
                        		</td>
                    		</tr>

                    		<tr>
                        		<td style="width: 35%; text-align: right;"><b>PHYSICAL:</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        		<td>
                        			Yes
                        		</td>
                    		</tr>
                        	<tr>
                        		<td style="width: 25%; text-align: right;"></td>
                        		<td>
                            		<table border="0" cellpadding="0">
                                		<tbody>
                                			<tr>
                                				<td style="width: 50%;"><b>Color:</b></td>
                                				<td style="width: 50%;">
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->bp}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Transparency:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->hr}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Specific Gravity:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
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
                        			Yes
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 25%; text-align: right;"></td>
                        		<td>
                            		<table border="0" cellpadding="0">
                                		<tbody>
                                			<tr>
                                				<td style="width: 50%;"><b>Glucose:</b></td>
                                				<td style="width: 50%;">
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->bp}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Bilirubin:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->hr}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Ketone:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Blood:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>pH:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Protein:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Urobilinogen:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Nitrities:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Leucocytes:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
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
                        			Yes
                        		</td>
                    		</tr>
                    		<tr>
                        		<td style="width: 25%; text-align: right;"></td>
                        		<td>
                            		<table border="0" cellpadding="0">
                                		<tbody>
                                			<tr>
                                				<td style="width: 50%;"><b>WBC:</b></td>
                                				<td style="width: 50%;">
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->bp}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>RBC:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->hr}}
                        							@endif
                                				</td> 
                                			</tr> 
                                			<tr>
                                				<td><b>Epith. Cells:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Bacteria:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Cast(s):</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Cast(s):</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Crystal(s):</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Crystal(s):</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Amorphous Materials:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Mucus Thread:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Others:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Others:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
                        							@endif
                                				</td> 
                                			</tr>
                                			<tr>
                                				<td><b>Others:</b></td>
                                				<td>
                                					@if(!$PE)
                        								N / A
                        							@else
                        								{{$PE->rr}}
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

            <tr>
            	<td>
            	<h2>TOTAL : &nbsp;&nbsp;&nbsp;PHP. 100.00</h2>
            	</td>
            </tr>

		</tbody>
	</table>
</body>
</html>