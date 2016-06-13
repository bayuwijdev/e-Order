<?php

		include("../library/lib_func.php");
			$id_pesanan=$_GET['id_pesanan']; 

			$id_member=$_POST['id_member'];
			$isi_pesan = $_POST['isi_pesan'];
			

			$email_to = $id_member;     
	        $email_subject = "Langkah untuk Pembayaran Pemesanan di e-Order";         
	     
	        function died($error) {
	            // your error code can go here
	     
	            echo "We are very sorry, but there were error(s) found with the form you submitted. ";     
	            echo "These errors appear below.<br /><br />";     
	            echo $error."<br /><br />";     
	            echo "Please go back and fix these errors.<br /><br />";     
	            die();
	     
	        }
	     
	        // validation expected data exists
	     
	        if(!isset($_POST['id_member']) ||         
	            !isset($_POST['isi_pesan'])) {     
	            died('Form proses pembayaran yang anda submit belum lengkap. Silahkan lengkapi terlebih dahulu !');       
	        }
	     
	        $email_from = "bayu_wpp@outlook.com"; // required
	        $comments = $_POST['isi_pesan']; // required
	     
	        $error_message = "";
	     
	        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	     
	      if(!preg_match($email_exp,$email_to)) {     
	        $error_message .= 'Alamat email member yang memesan tidak valid!<br />';
	      }
	        $string_exp = "/^[A-Za-z .'-]+$/";     	     
	      if(strlen($comments) < 2) {     
	        $error_message .= 'Pesan proses pembayaran yang kamu masukkan terlalu singkat!<br />';
	      }
	     
	      if(strlen($error_message) > 0) {     
	        died($error_message);     
	      }
	     
	        $email_message = "Informasi pesan yang dikirim sebagai berikut : <br>";
	     
	        function clean_string($string) {
	     
	          $bad = array("content-type","bcc:","to:","cc:","href");
	     
	          return str_replace($bad,"",$string);
	     
	        }
	     
	        $email_message .= "Email : ".clean_string($email_to)."<br>";     
	        $email_message .= "Pesan : ".clean_string($comments)."<br>";
	         
	     
	    // create email headers
	    //$headers = "MIME-Version: 1.0" . "\r\n";
	    //$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	    $headers = 'MIME-Version: 1.0' . "\r\n".
	    'Content-type:text/html;charset=UTF-8' . "\r\n".
	    'From: '.$email_from."\r\n".
	    'Reply-To: '.$email_from."\r\n" .     
	    'X-Mailer: PHP/' . phpversion();
	     
	    if(mail($email_to, $email_subject, $email_message, $headers)){
					echo "<script type='text/javascript'>
						window.alert('Email proses pembayaran telah terkirim!')
					  </script>";
	    } else {
	    		echo "<script type='text/javascript'>
						window.alert('Email proses pembayaran gagal terkirim!')
					  </script>";
	    	
	    }

      		
      		$update="UPDATE pesanan SET  
            diarsipkan = 'Y'
            WHERE id_pesanan='$id_pesanan'";

		$link=koneksi_db();

		$res=mysql_query($update,$link); 
            if(!$res ) {
               echo "<script type='text/javascript'>
						window.alert('die('Could not archieve order data because : ' . mysql_error())')
					  </script>";
            }
            echo "<script type='text/javascript'>
						window.alert('Pesanan telah diarsipkan!')
					  </script>
					  <script>document.location='merk_add_view.php'</script>
					  ";
?>