






<%
	strSQL = "Select Top 5 ID ,F_url ,F_imgs From [ohdp] Where F_class = 1   Order By F_order ,id"
	Set rrs = Conn.Execute(strSQL)
	KKK = 1
	If Not rrs.Eof Then
		While Not rrs.Eof
		
			temp_hdp_url = "#"
			If Not IsNull(rrs(1)) And rrs(1) <> "" Then temp_hdp_url = rrs(1)
			
			temp_hdp_str = temp_hdp_str & "<li flag='"& KKK &"'>"
			temp_hdp_str = temp_hdp_str & "<a class='big_pic' href='"& temp_hdp_url &"' >"
			temp_hdp_str = temp_hdp_str & "<img id='lunbo_"& KKK &"' src='hdp/1haodian/images/blank.gif'  wi='"& rrs(2) &"' si='"& rrs(2) &"'></a></li>"
			
			'只有一张时
			If KKK = 1 Then
				temp_hdp_path = rrs(2)
			End If
			
			KKK = KKK + 1
			rrs.Movenext
		Wend 
	End If
	rrs.CLose : Set rrs = Nothing
%>


<link rel=stylesheet type=text/css href="hdp/1haodian/images/1haodian.css">



<DIV id="promo_show" class="promo_show">
<DIV id="index_menu_carousel" class="promo_wrapper">
<OL class="clearfix">
		
		<%If KKK = 2 Then%>
		<li><a class='big_pic' href='<%=temp_hdp_url%>' ><img id='lunbo_1' src='<%=temp_hdp_path%>' ></a></li>
		<%Else%>
		<%=temp_hdp_str%>
		<%End If%>
  </OL>
  </DIV>
  
  
  
  
<DIV class="show_num_bg"></DIV>
	<UL id="lunboNum" class="none">
	
	<%For NNN = 1 To KKK - 1%>
		<LI <%If NNN = 1 Then Response.Write("class=cur")%>>&#8226;</LI>
	<%Next%>	  

	  
	</UL>
  	<A class="show_next" href="javascript:void(0);"><S></S></A><A class="show_pre" href="javascript:void(0);"><S></S></A></DIV>
</DIV>
</DIV>
</DIV>


<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js" type="text/javascript"></script>-->
<script language="javascript" src="hdp/1haodian/images/1haodian.js"></script>

