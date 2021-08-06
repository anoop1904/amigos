<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<title>{{$content['website_name']}}</title>
	<style type="text/css">
	a:hover { text-decoration: underline !important; }
        .listData{
                background: #eaedef;
                margin-bottom: 5px;
                padding: 20px;
                border-radius: 10px;
        }
</style>
</head>

<body style="background-color: #ffffff;">

        <div style="background: #ffffff;border: 1px solid gray;margin: 5px 5%;padding: 10px 2%;">
            	<div>  
        Hello {{ $content['candidateList'][0]->userBy->name }},
        <div>
            <br/>
            <br/>
            
            <p>
                You have {{ count($content['candidateList']) }} Interview scheduled for today, below are the details of interview & candidate:
            </p>
            <br/>
            <br/>

            <div class="listBody">
                
                
                @foreach($content['candidateList'] as $candidateLists)
                     <div class="listData">
                        <table>
                            <tr>
                                <td>Candidate Name</td>
                                <td>:</td>
                                <td>{{ $candidateLists->student->FirstName }}</td>
                            </tr> 
                            <tr>
                                <td>Candidate Current Title & Company</td>
                                <td>:</td>
                                <td></td>
                            </tr> 
                            <tr>
                                <td>Candidate Phone No.</td>
                                <td>:</td>
                                <td>{{ $candidateLists->student->Phone }}</td>
                            </tr> 
                            <tr>
                                <td>Job Title</td>
                                <td>:</td>
                                <td>{{ $candidateLists->jobs->JobTitle }}</td>
                            </tr> 
                            <tr>
                                <td>When</td>
                                <td>:</td>
                                <td>{{ $candidateLists->interview_date .' [ '.$candidateLists->interview_time.' ] ' }}</td>
                            </tr> 
                            <tr>
                                <td>Scheduled By</td>
                                <td>:</td>
                                <td>{{ $candidateLists->user->name }}</td>
                            </tr> 
                            <tr>
                                <td colspan="3">
                                    <a target="_blank" href="{{ URL('/admin/candidate_detail/'.encrypt($candidateLists->jobid).'/'.$candidateLists->student_id.'/view') }}">View Candidate Profile</a>
                                </td>
                            </tr> 
                        </table>
            </div>
                @endforeach
                
  
            </div>



<br/>
<p>Regards,</p>

<p>{{ $content['candidateList'][0]->user->name }}</p>



	<!--email container-->
<table bgcolor="#fffdf9" cellspacing="0" border="0" align="center" cellpadding="30" width="100%">
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
        </div>
        
        
        
	
			</body>
			</html>