<?php include_once("header.php") ?>
<div class="enable-bootstrap" id="progress_det">
<div class="btn-group btn-group-justified btngrup<?php echo $nota[0]->nota_id ?>">


	<?php
	$valid = false;
	$i=1;
		$reject =false;
		$count = count($semua_pemeriksa);

     						foreach ($semua_pemeriksa as $pem) {
     							if($pem->exam_queue>1){
	     							if($pem->reject_status==1) $reject=true;
									$i++;
								}
     						}
 if(!$reject){
    if($pemeriksa[0]->reject_status==0 and $pemeriksa[0]->ok_status==0 and $pemeriksa[0]->status =="AKTIF" and $pemeriksa[0]->return_status==0 ) $valid = true;
    	if($valid)
	 {
	 ?>
	 	<a class="btn btn-primary" role="button" onclick='progress_ok(<?php echo $pemeriksa[0]->examine_id; ?>,"btngrup<?php echo $nota[0]->nota_id ?>")'>Approve</a>
     	<a class="btn btn-default" role="button" href="<?php echo site_url('notadinas/nav/edit_form_prog/'.$nota[0]->nota_id) ?>/">Edit</a>
     	<?php if($pemeriksa[0]->exam_queue > 0 ) {?>	
     	<a class="btn btn-info" role="button" onclick='progress_reject(<?php echo $pemeriksa[0]->examine_id; ?>,"btngrup<?php echo $nota[0]->nota_id ?>")'>Reject</a>
     	
     	<a class="btn btn-danger" role="button" onclick='progress_return(<?php echo $pemeriksa[0]->examine_id; ?>,"btngrup<?php echo $nota[0]->nota_id ?>")'>Return</a>

	 <a class="btn btn-default" role="button" onclick='javascript:print_window("<?php echo site_url('notadinas/nav/print_nota/'.$nota[0]->nota_id) ?>")' >Print</a>
     
     <?php
 	}
     	}
     
     else 
     {

     	?>
     	
	 <a class="btn btn-default" role="button" onclick='javascript:print_window("<?php echo site_url('notadinas/nav/print_nota/'.$nota[0]->nota_id) ?>")' >Print</a>
		<a class="btn btn-success" id="btn-show-approver" role="button">Show Approver</a>

			<div id="dialog-form-info-pemeriksa" title="Data Folder">
			           <h4> Data Pemeriksa</h4>
					
     		<table>
     			<tr>
     				<td>Keterangan</td>

     			</tr>

     					<?php
     						$i=1;
     						foreach ($semua_pemeriksa as $pem) {
     							if($pem->exam_queue>0 ){
	     							$status;
									if($pem->ok_status==1) $status= "Approved";
									else if($pem->return_status==1) $status= "Returned";
									else if($pem->reject_status==1) $status= "Rejected";
									else $status = "Sedang di Proses";
									echo "<tr><td>Pemeriksa ke-".$i." :</td> <td>".$pem->emp_firstname." </td><td> :".$status."</td></tr>";
									$i++;
								}
     						}
     					?>
     			
     		</table>			            
			</div>

     	<?php
     }
 }
 else
 	  {
     	?>
		<a class="btn btn-default" id="btn-show-approver" role="button">Show Approver</a>

			<div id="dialog-form-info-pemeriksa" title="Data Folder">
			           <h4> Data Pemeriksa</h4>
					
     		<table>
     			<tr>
     				<td>Keterangan</td>
     				<td>:<td>
     				<td>
     					<?php
     						$i=1;
     						foreach ($semua_pemeriksa as $pem) {
     							if($pem->exam_queue>0 ){
	     							$status;
									if($pem->ok_status==1) $status= "Approved";
									else if($pem->return_status==1) $status= "Returned";
									else if($pem->reject_status==1) $status= "Rejected";
									else $status = "Sedang di Proses";
									echo "Pemeriksa ke-".$i." : ".$pem->emp_firstname." : ".$status."<br>";
									$i++;
								}
     						}
     					?>
     				</td>
     			</tr>
     		</table>			            
			</div>
	<?php
     }

     ?>
</div>
<form role="form" id="form_compose" enctype="multipart/form-data" method="post">
	
	<input type="text" id="idnota" value ="<?php echo $nota[0]->nota_id ?>" readonly="readonly" style="visibility:hidden">
	<div class="enable-bootstrap form-group" >
<!-- <table width="100%" align="center" style="border-bottom: solid black" >
		<tr>
			<td width="150px"><img class="logo-nota" height="100px" src='<?php echo base_url('css').'/'.$app_config->row()->logo_url; ?>'></td>
			<td colspan="3" align="center">
				<H3 style='text-transform: uppercase;margin-top: 0px !important'>PEMERINTAH DAERAH KABUPATEN KEPULAUAN SULA</H2>
				<h2 style='text-transform: uppercase;margin-top: 0px !important'><?php echo $dari_emp->org_name ?></h1>
				<span><?php echo $dari_emp->org_address ?></span>
			</td>
		</tr>
</table> -->
<?php echo $nota[0]->kop_surat; ?>
<div style="background: black;height:2px"></div>
<table>
	<tr>
		<td >

<table>
	<tr>
		<td colspan="4" align="right"></td>
	</tr>
	
		<tr>
			<td>Nomor</td>
			<td style='width:5px'>:</td>
			<td><?php echo $nota[0]->nota_number ?></td>
		</tr >
		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td><?php echo ($nota[0]->nota_attachment_info != "" ? $nota[0]->nota_attachment_info."<br>": "" ) ?>
				<?php
					foreach ($lampiran as $l) {
						echo "<a href='".$this->config->item("upload")."/".$l->lampiran_link."'>".$l->lampiran_name."</a><br>";
						
					}
				?>
			</td>
		</tr>
		
		<tr>
			<td style="width:100px">Perihal</td>
			<td>:</td>
			<td>
				<div style="width:30%;float:left"></div>
				<div style="width:70%;float:left;text-decoration: underline;"><?php echo $nota[0]->nota_perihal ?></div>

			</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>
				
		</td>
	</tr>
</table>
</td>
		<td width="240px">
			<table >
				<tr></tr>
				<tr>
					<td style="color:white">&nbsp;</td>
					<td colspan="2"><?php echo $options[0]->kota.", ". date("j F  Y", strtotime($nota[0]->nota_date)) ?></td></tr>
				<tr>
					<td></td>
					<td style="width:150px">Kepada</td>
					<td></td>
				</tr>
		
		<?php 

		foreach ($kepada as $n => $k) {
			?>
				<tr>
					<td align="right" style="text-align: center"><?php if($n==0)  echo "Yth."; ?> </td>
					<td><?php echo $k->job_name ?></td>
				</tr>
			<?php
		}
		 ?>
		 <?php 
		foreach ($kepada_external as $k) {
			?>
				<tr>
					<td align="right" style="text-align: center">Yth. </td>
					<td><?php echo $k->name ?></td>
				</tr>
			<?php
		}
		 ?>
		<!-- <tr>
			<td colspan="4">
				<?php
					$i=1;
					foreach ($kepada as $k) {
						echo $i . ". Yth. ".$k->job_name ."<br>";
						$i++;
					}
				 ?>
			</td>
		</tr> -->
		
		<?php if(count($kepada_external) ==0){
			?>
		<tr>
			<td></td>
			<td>Di-</td>
		</tr>
		<tr>
			<td></td>
			<td align="center">Tempat</td>
		</tr>
			<?php
		} ?>
		
			</table>			
		</td>
	</tr>
</table>
<br>
<br>
<br>
<br>

<table>
			<tr>
			<td style="padding-left: 105px">Dengan Hormat<br><br></td>
			</tr>
			<tr>
				<td  style="padding-left: 105px" >
					<div class='nota_isi' align="justify" style="width:100%;height:auto ;word-wrap: break-word">

					<?php echo $nota[0]->nota_isi ?>
					</div>
				</td>
			</tr>
			<tr>
				<td width="100%">
					<div style="float:right">
						<p align="center">
							<b style="text-decoration: underline;"><?php echo $options[0]->jabatan_pengirim  ?></b>
								<br><br><br><br><br>
								<b style="text-decoration: underline;"><?php echo $dari_emp->emp_firstname ?></b><br>
								<b style="">Nip. <?php echo $options[0]->nik_pengirim ?></b>
								<br><br><br>
						</p>
					</div>
				</td>
			</tr>
		</table>


</table>
<table>
	<tr>
			<td  colspan="4"><?php if(count($tembusan)> 0) echo "Tembusan ini disampaikan kepada:<br>"; ?>
	<?php
					$i=1;
					foreach ($tembusan as $k) {
							$g = ($k->emp_gender == "L" ? "Bpk." : "Ibu.");
						echo $i.". ".$g." ".$k->job_name."<br>";
						$i++;
					}
				 ?>
				</td>
			</tr>
<tr>
		<td>
			Komentar<br><?php 
			foreach ($komentar as $k) {
				echo "<div style='margin-top:5px;border:1px solid black;' class='komentars'>".$k->comment."<br><br>from : ".$k->emp_firstname . " " . $k->emp_lastname."</div>";
			}
		?>
		<br>
	</td>
	</tr>
	<?php 
	if($valid){
	?>

	<tr  >
		<td id="komentar_saya">Komentar Anda<br>
		<textarea class="form-control" id="comment"></textarea><br></td>
	</tr>
	<?php
		}
	 ?>

</table>

<?php 
	include_once("ref_det.php");
?>

</div>
<script type="text/javascript">

	var user = "<?php echo $user_aktif->emp_firstname ?>";
	user = user + " <?php echo $user_aktif->emp_lastname ?>";
function val(){
	var komentar = document.getElementById("comment").value;
	if(komentar!="")return true;
	else return false;
}
 function progress_ok(exam_id,cls){
 		if(val()==false) {
 			alert("silahkan submit komentar sebelum anda melanjutkan");
 			return false;
 		}
    	$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('notadinas/nav/progress_ok/') ?>/"+exam_id,
	            success: function(data)
	            {
	            	submit_komen();
	             alert(data);
	             	$("."+cls).remove();
	             	window.location.reload();
				}
				});

    }
    function progress_reject(exam_id,cls){
    	if(val()==false) {
 			alert("silahkan submit komentar sebelum anda melanjutkan");
 			return false;
 		}
 		$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('notadinas/nav/progress_reject/') ?>/"+exam_id,
	            success: function(data)
	            {
	            	submit_komen();
	             alert(data);
	             	$("."+cls).remove();
				}
				});

    }
    function progress_return(exam_id,cls){
    	if(val()==false) {
 			alert("silahkan submit komentar sebelum anda melanjutkan");
 			return false;
 		}$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('notadinas/nav/progress_return/') ?>/"+exam_id,
	            success: function(data)
	            {
	            	submit_komen();
	             alert(data);
	             	$("."+cls).remove();
				}
				});

    }
function edit_prog_form(nota_id){
	$.ajax({
		type:"GET",
		url:"<?php echo site_url('notadinas/nav/edit_form_prog/') ?>/"+nota_id,
		success:function (data){
			document.getElementById("progress_det").innerHTML = data;
		}
	});
}

function submit_komen(){
	var komentar = document.getElementById("comment").value;
	var id_nota = document.getElementById("idnota").value;
	var tr = document.getElementById("komentar_saya");
	var fdata = new FormData();
       	fdata.append("komentar",komentar);
	$.ajax({
            type:"POST",
            cache:false,
            url:"<?php echo site_url('notadinas/nav/add_komen/'.$user_aktif->emp_num) ?>/"+id_nota,
            data: fdata,
		     processData: false,
		     contentType: false,
            success: function (data){
                alert("komentar telah di submit");
                tr.innerHTML = "<div style='margin-top:5px;border:1px solid black;'  class='komentars'>"+komentar+"<br><br>from : "+user+"</div>";
            }
        
        });
}
$( document ).ready(function() {
    	init_editor("nota_isi");
	});
</script>
</div>