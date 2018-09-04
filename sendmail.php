<?php
/**
 * 一键发送邮件
 *
**/
if(isset($_POST['id'])&&$_POST['html']!=''){
  require_once "./mail.class.php";

  $config = array(
    'exmail'=>array("smtp.exmail.qq.com","25","465"), // 腾讯企业邮箱
    'qq'=>array("smtp.qq.com","25","465"), // 腾讯QQ邮箱
    '163'=>array("smtp.163.com","25","465") // 网易163邮箱、企业邮箱
  );

  $from = array(
    '163'=>array('abc123@163.com','123456'), // 邮箱，密码
    'qq'=>array('123456789@qq.com','123456') // 邮箱，密码
  );
  $to = array(
    '163'=>'sbmboy@gmail.com',
    'qq'=>'sbmboy@gmail.com',
  );

  $smtpserver = $config['qq'][0]; //SMTP服务器
  $smtpserverport = $config['qq'][1]; //SMTP端口号
  $smtpusermail = $from[$_POST['id']][0]; //SMTP发件邮箱
  $smtpemailto = $to[$_POST['id']]; //发给谁
  $smtpuser = $from[$_POST['id']][0]; //SMTP用户名，
  $smtppass = $from[$_POST['id']][1]; //SMTP用户密码

  $mailtitle = '留言'; //主题
  $mailcontent = $_POST['html']; //构建内容
  $mailtype = "HTML"; //邮件内容为HTML格式

  $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass); //实例化对象
  $smtp->debug = false; //关闭调试信息
  $state = $smtp->sendmail($smtpemailto, $smtpusermail, $mailtitle, $mailcontent, $mailtype); //发送邮件
  //检查发送状态
  if($state==""){
    echo "邮件发送失败，请检查密码或其他设置";
  }else if(strlen($state)!=0){
    echo "邮件发送成功";
  }else{
    echo "未知错误";
  }
}else{
  echo 'Error';
}
?>
