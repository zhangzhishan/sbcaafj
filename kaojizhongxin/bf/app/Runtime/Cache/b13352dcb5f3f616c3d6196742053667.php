<?php if (!defined('THINK_PATH')) exit();?><html xmlns="http://www.w3.org/1999/xhtml"><head><style type="text/css"></style><style>#haloword-pron { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -34px; }#haloword-pron:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -34px; }#haloword-open { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -17px; }#haloword-open:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -17px; }#haloword-close { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px 0; }#haloword-close:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px 0; }#haloword-add { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -51px; }#haloword-add:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -51px; }#haloword-remove { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -94px -68px; }#haloword-remove:hover { background: url(chrome-extension://bhkcehpnnlgncpnefpanachijmhikocj/img/icon.svg) -111px -68px; }</style></head><body>﻿
<title>网站管理系统-网站后台管理</title>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
<style type="text/css">* {
	FONT-SIZE: 9pt; OVERFLOW: hidden
}
BODY {
	MARGIN: 0px
}
</style>

<div></div>
<form onSubmit="return chk(this);" method="post" name="NETSJ_Login" action="__ACTION__/action/1">
<table border="0" cellspacing="0" cellpadding="0" width="940" bgcolor="#ffffff" align="center">
  <tbody>
  <tr>
    <td style="BACKGROUND: url(__ROOT__/app/Common/images/login/login01.jpg);text-align:center; color:#F00;" height="238" ><?php echo ($h); ?></td></tr>
  <tr>
    <td height="190">
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tbody>
        <tr>
          <td style="BACKGROUND: url(__ROOT__/app/Common/images/login/login02.jpg)" height="190" width="208">&nbsp;</td>
          <td style="BACKGROUND: url(__ROOT__/app/Common/images/login/login03.jpg)" width="518">
            <table border="0" cellspacing="0" cellpadding="0" width="320" align="center"><tbody>
              <tr>
                <td height="35" width="40"><img src="__ROOT__/app/Common/images/login/user.gif" width="30" height="30"></td>
                <td height="35" width="38">用户</td>
                <td height="35" width="242"><input name="username" id="username" style="width:180px;"></td>
                
              </tr>
              <tr>
                <td height="35"><img src="__ROOT__/app/Common/images/login/password.gif" width="28" height="32"></td>
                <td height="35">密码</td>
                <td height="35"><input type="password" name="password" id="password" style="width:180px;"></td>
              </tr>
              <tr>
                <td height="40">&nbsp;</td>
                <td height="40">&nbsp;</td>
                <td height="50"><input src="__ROOT__/app/Common/images/login/login.gif" type="image" name="submit"> </td></tr></tbody></table></td>
          <td style="BACKGROUND: url(__ROOT__/app/Common/images/login/login04.jpg)" width="214">&nbsp;</td></tr></tbody></table></td></tr>
  <tr>
    <td style="BACKGROUND: url(__ROOT__/app/Common/images/login/login05.jpg)" height="133">&nbsp;</td></tr></tbody></table></form>
<script language="JavaScript" type="text/JavaScript">
function chk(a)
{
if (a.username.value=="")
{
  alert("请输入管理帐号！");
  a.username.focus();
  return false;
}
if (a.password.value=="")
{
  alert("请输入管理密码");
  a.password.focus();
  return false;
}

// a.submit.value="正在登陆中...";
// a.submit.disabled=true;
// a.Submit.disabled=true;
}
</script>
<div id="haloword-lookup" class="ui-widget-content ui-draggable"><div id="haloword-title"><span id="haloword-word"></span><a herf="#" id="haloword-pron" class="haloword-button" title="发音"></a><audio id="haloword-audio"></audio><div id="haloword-control-container"><a herf="#" id="haloword-add" class="haloword-button" title="加入单词表"></a><a herf="#" id="haloword-remove" class="haloword-button" title="移出单词表"></a><a href="#" id="haloword-open" class="haloword-button" title="查看单词详细释义" target="_blank"></a><a herf="#" id="haloword-close" class="haloword-button" title="关闭查询窗"></a></div><br style="clear: both;"></div><div id="haloword-content"></div></div><div><object id="ClCache" click="sendMsg" host="" width="0" height="0"></object></div></body></html>