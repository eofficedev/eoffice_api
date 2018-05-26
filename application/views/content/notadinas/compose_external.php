<?php 
	include_once("header.php");
?>
<style type="text/css">
@media print {
    #print-link {
        display: none;
    }
}
@import url('//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
.accordion-toggle:before {
    font-family: 'FontAwesome';
    content: "+";
}
.accordion-opened .accordion-toggle:before {    
    content: "-";    
}

</style>
        <script type="text/javascript" src="<?php echo base_url(); ?>public/js/typeahead.js"></script>
<div id = "compose_detail" class="enable-bootstrap formulir" >
<div class="btn-group btn-group-justified">
	 <a class="btn btn-primary" role="button" onclick='submit_all()'>Submit</a>
     <a class="btn btn-default" id="btn-draft" role="button" onclick='submit_draft()'>Simpan Draft</a>
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
<div role="form" id="form_compose" onload=''>
	<div class="form-group">
<table >
	<thead>
		<tr>
			<td colspan="3"><H1>Surat Dinas</H1></td>
			<td><img class="logo-nota" height="150px" src='<?php echo base_url('css').'/'.$app_config->row()->logo_url; ?>'  height="25%"></td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Kepada</td>
			<td>:</td>
			<td colspan="2">
				<textarea id="kepada_nama" id="kepada_nama" name="kepada_nama" class="kepada_nama">
					
				</textarea>
			</td>
		</tr>
		<tr>
			<td>Dari</td>
			<td>:</td>
			<td colspan="2"><select class="form-control sel"  id="dari" style="-webkit-appearance: none;"></select>
				<a class='btn btn-success' id='btn-show-kepada' onclick="open_dialog_pemeriksa('dari')">Address Book</a>
					  <a class='btn btn-default' id='btn-delete-kepada' onclick="delete_option('dari')">Delete</a></td>
		</tr>
		<tr>
			<td>Tembusan</td>
			<td>:</td>
			<td colspan="2"><select class="form-control sel" size="4" id="tembusan"></select>
				<a class='btn btn-success' id='btn-show-kepada' onclick="open_dialog_pemeriksa('tembusan')">Address Book</a>
					  <a class='btn btn-default' id='btn-delete-kepada' onclick="delete_option('tembusan')">Delete</a>
			</td>
		</tr><tr>
			<td>Pemeriksa</td>
			<td>:</td>
			<td colspan="2"><select class="form-control sel" size="4" id="pemeriksa"></select>
				<a class='btn btn-success' id='btn-show-kepada' onclick="open_dialog_pemeriksa('pemeriksa')">Address Book</a>
					  <a class='btn btn-default' id='btn-delete-kepada' onclick="delete_option('pemeriksa')">Delete</a>
			</td>
		</tr>
		<tr>
			<td>Lampiran</td>
			<td>:</td>
			<td><input class="form-control" type="text" id="nota_attachment_info"></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td colspan="2">
				<iframe id="upload_target" name="upload_target" src="" style="width:0px;height:0px;border:0px solid #fff;"></iframe>
				<form id="file_upload_form" target="upload_target" method="post" enctype="multipart/form-data" action="<?php echo site_url('notadinas/nav/upload/') ?>">
					<input type="text" id="notaid" style="width:0px;height:0px;border:0px" name="notaid">
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
				<input type="text" name="kode_masalah" id="kode_masalah" class="form-control typeahead">
			</td>
		</tr> 
		
		<tr>
			<td>Perihal</td>
			<td>:</td>
			<td colspan="2"><input class="form-control" type="text" id="perihal"></td>
		</tr>
	</tbody>
	</form>
</table>
<table>
	<tr>
	<td>Isi Surat<br><br></td>
	</tr>
	<tr>
		<td colspan=4>
			<textarea name="nota_isi" id="nota_isi" class="ckeditor nota_isi" style="width:100%"></textarea></td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td ></td>
	</tr>
	<tr >
		<td  style="padding-bottom:100px"><div style="float:left" id="text_kota"><?php if(isset($options[0]->kota)) echo $options[0]->kota ; else echo $result->row()->org_city?></div>,</td>
		<td colspan="2">  <input style="width:150px" type = "Date" value=<?php echo date("Y-m-d") ?> name="tanggal" id="nota_tanggal" class="form-control date-pik"></td>
	</tr>
	<tr >
		<td class="nama" id="nama-dari"></td>
	</tr>
	<tr >
		<td class="nik" id="nik-dari"></td>
	</tr>
	<tr>
		<td colspan="2">Referensi :<br>
			<select class="form-control sel" size="4" id="ref"></select ><br>

<a class='btn btn-default'  onclick="delete_option('ref')">Delete</a><br></td>
		</td>
	</tr>
	<tr >
		<td colspan="2">Komentar:<br><textarea class="form-control" id="comment"></textarea></td>
	</tr>
</table>

</div>
<div class="btn-group btn-group-justified">
	 <a class="btn btn-primary" role="button" onclick='submit_all()'>Submit</a>
     <a class="btn btn-default" id="btn-draft" role="button" onclick='submit_draft()'>Simpan Draft</a>
     <a class="btn btn-info" onclick="paste_ref()" role="button">Paste Ref</a>
     <a class="btn btn-success" id="btn_options "role="button" onclick="open_options()">Options</a>
</div>
</div>
	<?php 

include_once("dialog_form.php");
?>
<script type="text/javascript">
	
  	<?php 
  	 	$option = array();
  		foreach ($masalah as $m) {
			// $option[$m->kode_masalah] = $m->kode_masalah . " / " . $m->masalah;
			$n = new stdClass();
			$n->id=$m->kode_masalah;
			$n->name = $m->kode_masalah . " / " . $m->masalah;
			$option[] = $n;
		}
  	?>
  	var typeData = <?php echo json_encode($option) ?>;
  	// var typeData =[{"id":"a","value":"a"},{"id":"n",'value':"name"}];
var $input;
	$(document).ready(function(){
		console.log(typeData);
		$input = $(".typeahead");
	
			$input.typeahead({
		  source: typeData,
		  autoSelect: true,
		  // displayText: function(item){ return item.value;}
		});

		$input.change(function() {
			console.log($input.typeahead("getActive").id)
		});
	});
</script>
<script type="text/javascript">


function submit_draft(){
        // var optkepada = document.getElementById("kepada").options;
        var dari = document.getElementById("dari").value;
        var opttembusan = document.getElementById("tembusan").options;
        var optpemeriksa = document.getElementById("pemeriksa").options;
        var lampiran = $('input:text.lampiran').serialize();

        //Eka: test kode masalah field for entry
        var testKodeMslh = $('#kode_masalah').val();
        //console.log("kode masalah-->" + testKodeMslh);
        if(testKodeMslh != "")
            var kode_masalah = $input.typeahead("getActive").id;

        var nota_attachment_info = document.getElementById("nota_attachment_info").value;
        var perihal = document.getElementById("perihal").value;
        var isi = get_value_isi("nota_isi");
        var kepada_nama =[ get_value_isi("kepada_nama")];
        var kepada =["-1"];
       console.log(kepada_nama);

        var attachment = document.getElementsByClassName("attachments");
        var tanggal_nota = document.getElementById("nota_tanggal").value;
        var komentar = document.getElementById("comment").value;
       	// var ck = document.getElementById("kepada").length;
       	var ct = document.getElementById("tembusan").length;
       	var cp = document.getElementById("pemeriksa").length;
       	   	var tembusan=[];
	       	var pemeriksa=[];
	       	for (var i = 0 ; i < ct; i++) {
	       		tembusan.push(opttembusan[i].value);
	       	}
	       	for (var i = 0 ; i < cp; i++) {
	       		pemeriksa.push(optpemeriksa[i].value);
	       	}
	        var fdata = new FormData();
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
	            url:"<?php echo site_url('notadinas/nav/submit_draft/'.$user_aktif->emp_num) ?>",
	            data: fdata,
			     processData: false,
			     contentType: false,
	            success: function (data){
	            	document.getElementById('notaid').value = data;
            		document.getElementById('file_upload_form').submit();
	            	document.getElementById('nota_id_config').value = data;
	            	
            		document.getElementById('save-config').submit();
	           		var url="<?php echo site_url('notadinas/nav/edit_form') ?>/"+data;
                	$.ajax({
			            type:"GET",
			            cache:false,
			            url:url,
			            data: fdata,
					     processData: false,
					     contentType: false,
			            success: function (data){
					            	//document.getElementById("compose_detail").innerHTML = data;               
								setTimeout(function(){
				document.getElementById('compose_detail').innerHTML = "Nota Telah di simpan di draft";
	            
								},3000);
					
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
 function submit_all(){

 		var konf = confirm("Apakah Anda yakin akan submit nota dinas ini?");
 		if (konf==true){
        // var optkepada = document.getElementById("kepada").options;
        var optref = document.getElementById("ref").options;
        var optdari = document.getElementById("dari").options;
        var opttembusan = document.getElementById("tembusan").options;
        var optpemeriksa = document.getElementById("pemeriksa").options;
        var lampiran = $('input:text.lampiran').serialize();
        var isi = get_value_isi("nota_isi");

        //Eka: test kode masalah field for entry
        var testKodeMslh = $('#kode_masalah').val();
        //console.log("kode masalah-->" + testKodeMslh);
        if(testKodeMslh != "")
            var kode_masalah = $input.typeahead("getActive").id;

        var nota_attachment_info = document.getElementById("nota_attachment_info").value;
        var perihal = document.getElementById("perihal").value;
        var attachment = $('input:file.attachments').val();
        var tanggal_nota = document.getElementById("nota_tanggal").value;
        var komentar = document.getElementById("comment").value;
       	// var ck = document.getElementById("kepada").length;
       	var cd = document.getElementById("dari").length;
       	var ct = document.getElementById("tembusan").length;
       	var cr = document.getElementById("ref").length;
       	var cp = document.getElementById("pemeriksa").length;


        var kepada_nama = [get_value_isi("kepada_nama")];
        var kepada =["-1"];
        // console.log("kepada",kepada_nama);
        // return true;
 	var pesan="";
 	var sbmt=false;
 	if( cd ==0){
 		pesan = pesan +" field Dari, ";
 		sbmt=true;
 	} 
 	if( komentar=="" ){
 		pesan = pesan +" field Komentar, ";
 		sbmt=true; 		
    }

 	if(isi=="" ){
 		pesan = pesan +" field Isi, ";
 		sbmt=true; 		
    }

    //Eka: add kode masalah check
    if(testKodeMslh == "" ){
        pesan = pesan +" field Klasifikasi Surat, ";
        sbmt=true;
    }

 	if(perihal=="" ){
 		pesan = pesan +" field Perihal, ";
 		sbmt=true; 		
    }

     if(sbmt){
     	alert("Silahkan lengkapi " + pesan + " terlebih dahulu.");
     	return false;
     }
       	else{
       	var tembusan=[];
       	var pemeriksa=[];
       	var ref=[];
       	for (var i = 0 ; i < ct; i++) {
       		tembusan.push(opttembusan[i].value);
       	}
       	for (var i = 0 ; i < cp; i++) {
       		pemeriksa.push(optpemeriksa[i].value);
       	}
       	if(cr >0){
       		for (var i = 0 ; i < cr; i++) {
       			ref.push(optref[i].value);
       		}
       		
       	}
		var dari = optdari[0].value;
        
       	pemeriksa.push(dari);
       	var fdata = new FormData();
       	fdata.append("nota_perihal",perihal);
        fdata.append("referensi",ref);
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
            	console.log(kepada_nama);
		
        $.ajax({
            type:"POST",
            cache:false,
            url:"<?php echo site_url('notadinas/nav/submit_nota/'.$user_aktif->emp_num) ?>",
            data: fdata,
		     processData: false,
		     contentType: false,
            success: function (data){
            	document.getElementById('nota_id_config').value = data;
            		document.getElementById('save-config').submit();
                document.getElementById('notaid').value = data;
            	document.getElementById('file_upload_form').submit();
            		var url="<?php echo site_url('notadinas/nav/nota_det_prog') ?>/"+data+"/<?php echo $user_aktif->emp_num ?>";
                	$.ajax({
            type:"GET",
            cache:false,
            url:url,
            data: fdata,
		     processData: false,
		     contentType: false,
            success: function (data){
            	$.ajax({
           		 type:"GET",
		            cache:false,
		            url:url,
		            data: fdata,
				     processData: false,
				     contentType: false,
		            success: function (data){
		            	//document.getElementById("compose_detail").innerHTML = data;               
		            	setTimeout(function(){
		            		 window.location =url;
		            		},3000);
		            }
		        
		        });
            	
            }
        
        });
            }
        
        });

    	}
   	  }
    }

</script>
</div>

