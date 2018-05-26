<?php 

	 $appconfig = $app_config->row();
	  ?>
<link rel="stylesheet" type="text/css" href="<?php  echo $this->config->item('css') ?>mycss.css"> 
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.8.1.min.js"></script>
<style type="text/css">
	td p, td h1{
		margin:0;
	}
</style>
<div style="margin-left:1cm;margin-right:1cm;" class="enable-bootstrap">
<form role="form" enctype="multipart/form-data" method="post">
	<input type="hidden" name="nota_id" class="<?php echo $nota[0]->nota_id ?>" value="<?php echo $nota[0]->nota_id ?>" >
	<div class="form-group"><input type="text" id="idnota" value ="<?php echo $nota[0]->nota_id ?>" readonly="readonly" style="visibility:hidden">
	
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
<div id="kop">
<?php echo $nota[0]->kop_surat; ?>
	
</div>
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


<table>
	
	
				
</table>
<?php if(count($tembusan)>0){ ?>
<table>
	<tr>
			<td  colspan="4">Tembusan ini disampaikan kepada:<br>
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
</table>
<?php } ?>
</form>
</div>

</div>
<script type="text/javascript">
	$( document ).ready(function() {
    	window.print();
	});
</script>