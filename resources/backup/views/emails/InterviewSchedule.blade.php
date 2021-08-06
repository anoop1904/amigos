<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>{{$content['website_name']}}</title>
	<style type="text/css">
	a:hover { text-decoration: underline !important; }
</style>
</head>

<body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #e0e0e0;" bgcolor="#e0e0e0" leftmargin="0">
	<!--100% body table-->
	<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#e0e0e0" style="padding-bottom: 30px;">
		<tr>
			<td>
				
				<!--header-->
				<table style="background-color: #fffdf9; margin-top: 30px; text-align: center;" width="70%" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td valign="top" width="2">		</td>
									<td valign="middle" width="664"><table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td height="31"></td>
										</tr>
										<tr>
											<td>
												<h1 style="color: #333; margin-top: 0px; margin-bottom: 0px; font-weight: normal; font-size: 34px; font-family: Georgia, Times New Roman, Times, serif; text-align: center;" align="center">
													{{$content['title']}}
												</h1>
											</td>
										</tr>
										<tr>
											<td height="40">
											</td>
										</tr>
									</table>
									<!--date-->
									<table width="98%" border="0" cellpadding="0" cellspacing="0" style="margin-left:15px;">
										<tr>
											<td width="89" height="42" align="center" valign="top" bgcolor="#014689">
												<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"><tr><td height="5">
													<p style="font-size: 24px; font-family: Georgia, Times New Roman, Times, serif; color: #ffffff; margin-top: 5px; margin-bottom: 0px; text-align: center;" align="center">
														<currentmonthname>
															{{date('d M Y')}}
															<currentyear></p>
															</td></tr></table>

														</td>
													</tr>
												</table><!--/date-->
											</td>
											<td width="18"></td>
										</tr>
									</table>
								</td>
							</tr>
						</table><!--/header-->
						<!--email container-->
						<table bgcolor="#fffdf9" cellspacing="0" border="0" align="center" cellpadding="30" width="70%">
							<tr>
								<td>
									<!--email content-->
									<table cellspacing="0" border="0" id="email-content" cellpadding="0" width="100%">
										<tr>
											<td>
												<!--section 1-->
												<table cellspacing="0" border="0" cellpadding="0" width="100%">
													<tr>
														<td valign="top" align="center">
															<!--line break-->
															<!-- Table Generate Here-->

<table width="100%" border="0">
	<tr>
		<th style="text-align: left;font-weight: bold;">Test </th>
	</tr>
	
</table>


															<!-- Table End Here generate-->

														</td>
													</tr>
												</table><!--/section 1-->
												<!--line break-->
												<table cellspacing="0" border="0" cellpadding="0" width="100%">
													<tr>
														<td height="5"><br><div style="border-bottom:1px solid #000; padding-top:15px;"></div></td>
													</tr>
													<tr>
														<td height="20"></td>
													</tr>
												</table><!--/line break-->
												<!--section 2-->
												<!--section 3-->
												<table cellspacing="0" border="0" cellpadding="0" width="100%">
													<tr>
														<td valign="top" width="100%">
															<h1 style="font-size: 24px; font-family: Georgia, Times New Roman, Times, serif; color: #333333; margin-top: 0px; margin-bottom: 12px;">
																Regards
															</h1>
															<p style="font-size: 16px; line-height: 22px; font-family: Georgia, Times New Roman, Times, serif; color: #333; margin: 0px;">
																{{$content['website_name']}}<br>
																{{$content['address']}}
																<br>
																{{$content['mobile']}}
																<br></p>
															</td>

															<td valign="top" width="174">
																<img src="{{URL('/')}}/assets/img/{{$content['website_logo']}}"  height="35" width="174"/>
															</td>

														</tr>
													</table>
												</td>
											</tr>
										</table><!--/email content-->
									</td>
								</tr>
							</table><!--/email container-->
						</td>
					</tr>
				</table><!--/100% body table-->
			</body>
			</html>