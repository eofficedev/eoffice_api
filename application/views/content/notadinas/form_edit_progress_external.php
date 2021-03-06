<?php
	include_once("header.php");

 ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/typeahead.js"></script>
<div id = "edit_detail" class="enable-bootstrap">
<div class="btn-group btn-group-justified">
     <a class="btn btn-primary" id="btn-draft" role="button" onclick='simpan_progress()'>Simpan</a>
     <a class="btn btn-info" onclick="paste_ref()" role="button">Paste Ref</a>
     <a class="btn btn-success" id="btn_options "role="button" onclick="open_options()">Options</a>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		CKEDITOR.replace("kepada_nama",{
			uiColor : "#148C4",
			width:"100%",
			height:"75px",
			toolbar :[

			]
		});
	})
</script>
<div role="form" id="form_edit">
	<div class="form-group">
<table >
	<thead>
		<tr>
			<td><H1>Surat Dinas</H1></td>
			<td></td>
			<td></td>
			<td><img class="logo-nota"height="150px" src='<?php echo base_url('css').'/'.$app_config->row()->logo_url; ?>'  height="25%"></td>
		</tr>
	</thead>
	<tbody>
		
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td colspan="2">

				<textarea id="kepada_nama" id="kepada_nama" name="kepada_nama" class="kepada_nama">
					<?php echo $kepada_external[0]->name ?>
				</textarea>
			</td>
		</tr>
		<tr>
			<td>Dari</td>
			<td>:</td>
			<td colspan="2"><select class="form-control sel"  id="dari" style="-webkit-appearance: none;">
				<?php
					echo "<option value='".$dari->emp_num."'>".$dari->emp_firstname." ".$dari->emp_lastname." / ".$dari->job_name."</option>";
				 ?>
			</select>
				<a class='btn btn-success' id='btn-show-kepada' onclick="open_dialog_pemeriksa('dari')">Adress Book</a>
					  <a class='btn btn-default' id='btn-delete-kepada' onclick="delete_option('dari')">Delete</a></td>
		</tr>
		<tr>
			<td>Tembusan</td>
			<td>:</td>
			<td colspan="2"><select class="form-control sel" size="4" id="tembusan">
				<?php 
					foreach ($tembusan as $k) {
						echo "<option value='".$k->emp_num."'>".$k->emp_firstname." ".$k->emp_lastname." / ".$k->job_name."</option>";
					}
				 ?>
			</select>
				<a class='btn btn-success' id='btn-show-kepada' onclick="open_dialog_pemeriksa('tembusan')">Adress Book</a>
					  <a class='btn btn-default' id='btn-delete-kepada' onclick="delete_option('tembusan')">Delete</a>
			</td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td><input class="form-control" type="text" id="nota_attachment_info" value="<?php echo $nota->nota_attachment_info ?>"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td colspan="2">
				<?php
					foreach ($lampiran as $l) {
						echo "<div id='lampiran".$l->lampiran_id."'><a href='".$this->config->item("upload")."/".$l->lampiran_link."'>".$l->lampiran_name."</a>  <a onclick=hapus_lampiran('".$l->lampiran_id."')>Hapus</a></div>";
					}
				?>
				<iframe id="upload_target" name="upload_target" src="" style="width:0px;height:0px;border:0px solid #fff;"></iframe>
				<form id="file_upload_form" target="upload_target" method="post" enctype="multipart/form-data" action="<?php echo site_url('notadinas/nav/upload/') ?>">
						
					<input type="text" id="notaid" value="<?php echo $nota->nota_id; ?>" style="width:0px;height:0px;border:0px" name="notaid">
				<div id="kolom_attachment">

					<input type="file" name="nota_att[]" class="attachments" >
					<input type="submit" style="width:0px;height:0px;border:0px" >
					</div> <a id="addfile" onclick="add_file()")>Add Item</a></td>
			</form>
			</tr>
			<tr>
			<td>Klasifikasi Surat</td>
			<td>:</td>
			<td colspan="2">
				<input type="text" name="kode_masalah" id="kode_masalah" class="form-control typeahead" value='<?php echo $nota->nota_kode_masalah ?>'>
			</td>
		</tr> 
		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td colspan="2"><input class="form-control" type="text" id="perihal" value='<?php echo $nota->nota_perihal ?>'></td>
		</tr>
	</tbody>
	</form>
</table>
<table>

	<tr>
	<td>Isi Surat<br><br></td>
	</tr>
	<tr >
		<td colspan="4">
			<textarea name="nota_isi" id="nota_isi" class="ckeditor  form-control" style="width:100%"><?php echo $nota->nota_isi ?></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td  colspan="2"></td>
	</tr>
	<tr >
		<td style="padding-bottom:100px">
		<div id="text_kota"><?php echo $options[0]->kota ?></div></td>
		<td colspan="3">  <input type = "Date" name="tanggal" id="nota_tanggal" value ="<?php echo $nota->nota_date ?>" class="form-control date-pik"></td>
	</tr>
	<tr >
		<td class="nama" id="nama-dari"><?php  echo $options[0]->jabatan_pengirim ?></td>
	</tr>
	<tr >
		<td class="nik" id="nik-dari"><?php  echo $options[0]->nik_pengirim ?></td>
	</tr>
	<tr>
		<td colspan="2" >Referensi:</br>
			<select class="form-control sel" size="4" id="ref">
				<?php 
					foreach ($referensi as $key) {
						echo"<option value='".$key->nota_referensi."'>".$key->nota_number."</option>";
					}
				?>
			</select >
			<br>
<a class='btn btn-default'  onclick="delete_option('ref')">Delete</a><br></td>
		</td>
	</tr>
	<tr style="display:none">
		<td colspan="2">Komentar:<br>
		<textarea class="form-control" id="comment">

		</textarea>
	<br>
	<br></td>
	</tr>
</table>

</div>
<div class="btn-group btn-group-justified">
     <a class="btn btn-primary" id="btn-draft" role="button" onclick='simpan_progress()'>Simpan</a>
     <a class="btn btn-info" onclick="paste_ref()" role="button">Paste Ref</a>
     <a class="btn btn-success" id="btn_options "role="button" onclick="open_options()">Options</a>
</div>
</div>
<script type="text/javascript">
	var selectedMasalah = <?php echo $nota->nota_kode_masalah ?>;
  	<?php 
  	 	$option = array();
  		$selected = false;
  		foreach ($masalah as $m) {
			// $option[$m->kode_masalah] = $m->kode_masalah . " / " . $m->masalah;
			$n = new stdClass();
			$n->id=$m->kode_masalah;
			$n->name = $m->kode_masalah . " / " . $m->masalah;
			$option[] = $n;
			if($nota->nota_kode_masalah == $m->kode_masalah)
				$selected = $n;
		}
  	?>
  	var selected = <?php echo json_encode($selected) ?>;
  	var typeData = <?php echo json_encode($option) ?>;

var $input;
	$(document).ready(function(){
		
		$input = $(".typeahead");
		$(".collapse").on("show",function(){
			console.log(this);
		});
			$input.typeahead({
			  source: typeData,
			  autoSelect: true
		});

		$input.typeahead("setDefault",selected);
		$input.change(function() {
			console.log($input.typeahead("getActive").id)
		});
	});
</script>
<script type="text/javascript">
	
    $( document ).ready(function() {
    	init_editor("nota_isi");
	});

			function hapus_lampiran(id){
				$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('notadinas/nav/hapus_lampiran/') ?>/"+id,
	            success: function(data)
	            {
	            	$("#lampiran"+id).remove();
	            }
				});
			}
		
    function simpan_progress(){
    	var nota_id = document.getElementById("notaid").value;
        var dari = document.getElementById("dari").value;
        var opttembusan = document.getElementById("tembusan").options;
        var lampiran = $('input:text.lampiran').serialize();
       var kode_masalah = $input.typeahead("getActive").id;
        var nota_attachment_info = document.getElementById("nota_attachment_info").value;
         var perihal = document.getElementById("perihal").value;
        var isi = get_value_isi("nota_isi");
        var attachment = document.getElementsByClassName("attachments");
        var tanggal_nota = document.getElementById("nota_tanggal").value;
        var komentar = document.getElementById("comment").value;
       	// var ck = document.getElementById("kepada").length;
       	var ct = document.getElementById("tembusan").length;
       
	       	var kepada=["-1"];
	       	var kepada_nama=[get_value_isi("kepada_nama")];
	       	var tembusan=[];
	       	var pemeriksa=[];
	       
	       	for (var i = 0 ; i < ct; i++) {
	       		tembusan.push(opttembusan[i].value);
	       	}
	     
	       	
	        var fdata = new FormData();
	       	fdata.append("nota_id",nota_id);
	       	fdata.append("nota_perihal",perihal);
	        fdata.append("nota_isi",isi);
	        fdata.append("nota_sender",dari);
	        fdata.append("nota_date",tanggal_nota);
	        fdata.append("nota_attachment_info",nota_attachment_info);
	        fdata.append("nota_kode_masalah",kode_masalah);
	        fdata.append("kepada",kepada);
	        fdata.append("kepada_nama",kepada_nama);
	        fdata.append("tembusan",tembusan);
	        fdata.append("lampiran",lampiran);
	        fdata.append("attachment",attachment);
	        fdata.append("pemeriksa",pemeriksa);
	        fdata.append("komentar",komentar);
	        fdata.append("attachment", attachment);
					
	    var optref = document.getElementById("ref").options;    	
       	var cr = document.getElementById("ref").length;
	    var ref=[]
	    if(cr >0){
       		for (var i = 0 ; i < cr; i++) {
       			ref.push(optref[i].value);
       		}
       		
       	}
	   	
	        fdata.append("referensi",ref);
	        $.ajax({
	            type:"POST",
	            cache:false,
	            url:"<?php echo site_url('notadinas/nav/simpan_progress/') ?>/"+nota_id,
	            data: fdata,
			     processData: false,
			     contentType: false,
	            success: function (data){
            		document.getElementById('file_upload_form').submit();
		document.getElementById('nota_id_config').value = data;
            		document.getElementById('save-config').submit();
            		url =  "<?php echo site_url('notadinas/nav/nota_det_prog/') ?>/"+nota_id+"/<?php echo $user_aktif->emp_num ?>";
				           		$.ajax({
					            type:"GET",
					            cache:false,
					            url:url,
					             processData: false,
							     contentType: false,
					            success: function (data){
					            	setTimeout(function(){
					            		window.location = url;

					            	},3000)
					                },
					        	 error: function(xhr, textStatus, error){
								      console.log(xhr.statusText);
								      console.log(textStatus);
								      console.log(error);
								  }
					        });
	            },
	        	 error: function(xhr, textStatus, error){
				      console.log(xhr.statusText);
				      console.log(textStatus);
				      console.log(error);
				  }
	        });
	   	 
    }
</script>
<?php 
include_once("dialog_form.php")
?>
</div>
</div>
</div>
</div>
