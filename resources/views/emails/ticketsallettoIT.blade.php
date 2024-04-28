<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<!-- Compiled with Bootstrap Email version: 1.3.1 -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
			<meta http-equiv="x-ua-compatible" content="ie=edge">
				<meta name="x-apple-disable-message-reformatting">
					<meta name="viewport" content="width=device-width, initial-scale=1">
						<meta name="format-detection" content="telephone=no, date=no, address=no, email=no">
							<style type="text/css">
      body,table,td{font-family:Helvetica,Arial,sans-serif !important}.ExternalClass{width:100%}.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div{line-height:150%}a{text-decoration:none}*{color:inherit}a[x-apple-data-detectors],u+#body a,#MessageViewBody a{color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit}img{-ms-interpolation-mode:bicubic}table:not([class^=s-]){font-family:Helvetica,Arial,sans-serif;mso-table-lspace:0pt;mso-table-rspace:0pt;border-spacing:0px;border-collapse:collapse}table:not([class^=s-]) td{border-spacing:0px;border-collapse:collapse}@media screen and (max-width: 600px){.w-full,.w-full>tbody>tr>td{width:100% !important}.w-24,.w-24>tbody>tr>td{width:96px !important}.w-40,.w-40>tbody>tr>td{width:160px !important}.p-lg-10:not(table),.p-lg-10:not(.btn)>tbody>tr>td,.p-lg-10.btn td a{padding:0 !important}.p-3:not(table),.p-3:not(.btn)>tbody>tr>td,.p-3.btn td a{padding:12px !important}.p-6:not(table),.p-6:not(.btn)>tbody>tr>td,.p-6.btn td a{padding:24px !important}*[class*=s-lg-]>tbody>tr>td{font-size:0 !important;line-height:0 !important;height:0 !important}.s-4>tbody>tr>td{font-size:16px !important;line-height:16px !important;height:16px !important}.s-6>tbody>tr>td{font-size:24px !important;line-height:24px !important;height:24px !important}.s-10>tbody>tr>td{font-size:40px !important;line-height:40px !important;height:40px !important}}
    </style>
						</head>
						<body style="padding:30px;background-color:white;">

								<h1 class="h3 fw-700" style="padding-top: 0; padding-bottom: 0; font-weight: 900 !important; vertical-align: baseline; font-size: 20px; line-height: 33.6px; margin: 0;text-align:center;color:blue;text-weight:bold" align="center">
                                 Asset Networks (Pvt)Ltd
                                </h1>

							<table style="background-color:white;width:700px;position:center;border-radius: 10px;" align="center">
								<tr>
									<th colspan="2" style="text-align:center">

									</th>
								</tr>
								<tr>
									<th colspan="2" style="text-align:center">&nbsp; Service Ticketing System</th>
								</tr>
								<tr>
									<th colspan="2" style="text-align:center">&nbsp; {{$mailData['tickets_number']}}</th>
								</tr>
								<th style="margin-top84px;"> </br>User Details </br></th>
								<tr>
									<td style="margin-left:5px;width:150px">&nbsp;User</td>
									<td>{{$mailData['ticket_user_name']}}</td>
								</tr>

								<tr>
									<td style="margin-left:5px;width:150px"> &nbsp;  Organization</td>
									<td>{{$mailData['ticket_organization']}}</td>
								</tr>
								<tr>
									<td style="margin-left:5px;width:150px"> &nbsp;  Department</td>
									<td>{{$mailData['ticket_department_name']}}</td>
								</tr>
								<th> Error Details</th>
								<tr>
									<td style="margin-left:5px;width:150px">&nbsp;Device Name</td>
									<td>{{$mailData['ticket_equpment_types']}}</td>
								</tr>
								<tr>
									<td style="margin-left:5px;width:150px">&nbsp;Error</td>
									<td>{{$mailData['ticket_issues_id']}}</td>
								</tr>
								<tr  >
									<td style="margin-left:5px;width:150px ">&nbsp;Note</td>
									<td>{!!  html_entity_decode($mailData['ticket_issues_note']) !!} </td>
								</tr>
								<th>  Contact Details</th>
								<tr>
									<td style="margin-left:5px;width:150px">&nbsp;Email</td>
									<td>{{$mailData['ticket_email']}}</td>
								</tr>
								<tr>
									<td>&nbsp;Mobile Num:</td>
									<td>{{$mailData['ticket_phone_number']}}</td>
								</tr>


                                <tr style="margin-bottom:10px;">
                                    <td></td>
                                   <td></td>
                               </tr>

								<tr style="margin-bottom:10px;">
								     <td></td>
									<td>{{$mailData['daily_tasks_attend_by']}}</td>
								</tr>

								<th> </br> </th>
							</table>

							<table class="ax-center" role="presentation" align="center" border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 16px; margin: 0;" align="left">
                                   </br> <img class="w-40" src="{{$mailData['base_url']}}/assets/img/Asset_network_banner.png" style="height: auto; line-height: 100%; outline: none; text-decoration: none; display: block; width: 160px; border-style: none; border-width: 0;" width="160">
                                  </td>
                                </tr>
                              </tbody>
                            </table>


							 <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;" align="left" width="100%" height="24">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="text-muted text-center" style="color: #718096;" align="center">
                              Asset Networks (Pvt)Ltd. <br>
                              10 Barnes Pl,<br>
                              Colombo 00700 <br>
                            </div>
                            <table class="s-6 w-full" role="presentation" border="0" cellpadding="0" cellspacing="0" style="width: 100%;" width="100%">
                              <tbody>
                                <tr>
                                  <td style="line-height: 24px; font-size: 24px; width: 100%; height: 24px; margin: 0;" align="left" width="100%" height="24">
                                    &#160;
                                  </td>
                                </tr>
                              </tbody>
                            </table>



						</body>
					</html>


