<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __dir__.'/../static/phpmailer/src/Exception.php';
require_once __dir__.'/../static/phpmailer/src/PHPMailer.php';
require_once __dir__.'/../static/phpmailer/src/SMTP.php';

require_once __dir__.'/../model/database.php';

 
class Mailer{
	protected $table="users";

	public function __construct(){
        $this->db = Database::instantiate();
    }

    public function randomString($length = 6) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

    public function recoverPassword(){
		$email = $_POST['email'];
		if(empty($email)){
			echo "Email is empty";
		}else{
			$data = array(
				'email'
			);
			$field = array(
				'email'=>"$email"
			);
			 $recover = $this->db->select($this->table,$data,$field);
			if(mysqli_num_rows($recover)==1){
				$password = $this->randomString();
				$encryption = md5($password);
				$data=array('password'=>"$encryption");
				$update = $this->db->update($this->table,$data,array('id'=>'1'));
				if($update == true){
					$this->randPassword($password,$email);
				}else{
					echo "Error in recovery";
				}
			}else{
				echo "Email not matched";
			}
		}
	}

    public function randPassword($password,$email){
    	$mail = new PHPMailer;
		try {
		    //Server settings
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'cloudprazol@gmail.com';                 // SMTP username
		    $mail->Password = 'cloud_prajwol';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		    $mail->SMTPOptions = array(
			    'ssl' => array(
			        'verify_peer' => false,
			        'verify_peer_name' => false,
			        'allow_self_signed' => true
			    	)
				);
	 		//Recipients
		    $mail->setFrom('cloudprazol@gmail.com', '');
		    $mail->addAddress($email);
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Password Recovery';
		    $mail->Body    = 'Your password has been changed. Your  new password is ' . $password;
		    if($mail->send()) {
		    	// echo 'Message has been sent';
		    	header("Location:../admin/index.php");
			}
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}	
    }
}

