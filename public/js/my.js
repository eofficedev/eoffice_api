	var kode_tab="tab0";
  function close_tab(id,nama){
        var konf = confirm("are you sure close this tab? unsave change");
	    if (konf==true){
	        $("#"+id).remove();
	        $("."+id).remove();
	        var kode = kode_tab.substring(3,kode_tab.length);
			var jumlah = $(".headingtab").length;	  
	        	$(".headingtab").removeClass("active");
	        	$(".tab-pane").removeClass("active");
	        	
	        	$(".headingtab").first().addClass("active");
	        	$(".tab-pane").first().addClass("active");
	        	
	        
	    }
    }
		function add_tab(id,nama,isi){
                console.log(nama);
                var head = ' <li class="headingtab active '+id+' '+nama+'"><a href="#'+id+'" data-toggle="tab">'+nama+'  <i class="close-tab fa fa-times" onClick=close_tab("'+id+'","'+nama+'")></i></a></li>';
                var konten = '<div  class="tab-pane active" id="'+id+'">'+isi+'</div>';
                document.getElementById('headtab').innerHTML = document.getElementById('headtab').innerHTML+head;
                document.getElementById('konten').innerHTML = document.getElementById('konten').innerHTML+konten;
        }
	function ganti_nav(isi){
		document.getElementById("isi_nav").innerHTML=isi;
	}
	function delete_option(option){
		var x = document.getElementById(option);
        var empnum = x.value;
		x.remove(x.selectedIndex);
        if(option=="sel_disposisi"){

            $("#dis"+empnum).remove();
        }
	}

   function print_window(url)
{
window.open(url, 'Print Nota Dinas', 'width=500,height=500,scrollbars=yes');
}
function get_value_isi(id){
   
        var node = CKEDITOR.instances[id].getData();
        return node;
    }
	function generate_kode_tab(){
		var kode = kode_tab.substring(3,kode_tab.length);
		kode++;
		kode_tab = 'tab'+kode;
		return kode_tab;
	}
    
		$("#compose").click(function(){
				$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('nav/compose') ?>",
	            success: function(data)
	            {
	              $(".tab-pane").removeClass("active");
	              $(".headingtab").removeClass("active");

	              add_tab(generate_kode_tab(),'Compose',data);
	              init_editor();
	            }
				});
			});
			$('.folder-combo').on('change', function() {
  				$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('nav/folder_change/') ?>/"+this.value,
	            success: function(data)
	            {
	            	ganti_nav(data);

	            }
				});
			});
			$("#compose_external").click(function(){
				$.ajax({
                type: "GET",
                async: false,
	            url: "<?php echo site_url('nav/compose_external') ?>",
	            success: function(data)
	            {
	              $(".tab-pane").removeClass("active");
	              $(".headingtab").removeClass("active");

	              add_tab(generate_kode_tab(),'Compose',data);
	              init_editor();
	            }
				});
			});

var pil="";
var del_index=0;
 function add_file(){

            var isi = "<br class='att"+del_index+"'><input  class='att"+del_index+" attachments' type=\"file\" name=\"nota_att[]\" id=\"nota_att[]\" /><a class='att"+del_index+"' onclick='remove_att("+del_index+")'>remove</a>";
            var t = document.getElementById("kolom_attachment");
            del_index++;
            t.innerHTML = t.innerHTML + isi
        }
 function remove_att(id){
 	
    $(".att"+id).remove();
 }
function open_dialog(nama){
	console.log(nama);
	$("#modal-form").modal('show');
    pil = nama;
}
function open_dialog_pemeriksa(nama){
	console.log(nama);
    $("#modal-form-pemeriksa").modal('show');
    pil = nama;
}

function loadDataSub(ac,org,emp){
	var body = $(".ac"+ac+"-"+emp).html();
	
	if(body == "loading..."){
	
		$.ajax({
			method:"GET",
			url:SITE_URL+"/notadinas/nav/get_emp_sub_dir/"+org,
			success:function(data){
				data = JSON.parse(data);
				var b ="";
				for(var i=0;i<data.length;i++){
					var empdet="";
					// console.log(data[i]);
					if(ac.search("jabatan")> -1)
						empdet = data[i].job_id+"-"+data[i].job_name;
					else if(ac.search("nama")>-1)
						empdet = data[i].emp_firstname+" "+data[i].emp_lastname+"/"+data[i].job_code+"-"+data[i].emp_id+"/"+data[i].org_id;

					if(data[i].kepala){
						var template = $(".accordionTemplate").html();
						template = template.replace(new RegExp("{{empnum}}", "g"),data[i].emp_num);
						template = template.replace(new RegExp("{{orgnum}}", "g"),data[i].org_num);		
						template = template.replace(new RegExp("{{accordion}}", "g"),ac);		
						template = template.replace("{{dataEmp}}",empdet);
						
						b+=template;		
					}
					else{

						b+="<div>"+empdet+"<button onClick='pilih("+data[i].emp_num+")'>Pilih</button></div>";
					}
				}
				// console.log(b);
				// b = (b=="")? "<div>No data</div>":b;
				// b = (b=="")? "<div>No data</div>":b;
				$(".ac"+ac+"-"+emp).html(b);
				$("#"+ac+"-"+emp+" .collapse").collapse("hide");
				
			}
		})
	}
}
function pilih(empnum){
	if(pil=="pemeriksa"){
	    var selectdari = document.getElementById("dari");
	    if(selectdari.length=1){
	        if(empnum==selectdari.options[0].value){
	            alert("data dari dan pemeriksa tidak boleh sama!");
	            return false;
	        }
	    }
	    if(aktif_user==empnum){
	            alert("Pembuat nota tidak di perkenankan sebagai pemeriksa!");
	            return false;   
	    }
	}

	document.getElementById(pil);
var x = document.getElementById(pil);
	
	                    ;
    for(var i = 0;i<x.length;i++){
        if(x.options[i].value == empnum){
            alert("Data pilihan tidak boleh ada duplikasi, silahkan cek field "+pil);
            return false;
        }
    }
	$.ajax({
			method:"GET",
			url:SITE_URL+"/notadinas/nav/get_emp_det/"+empnum,
			success:function(data){
				data = JSON.parse(data);
				console.log(data);
				var option = document.createElement("option");
				option.text = data.emp_firstname + " " + data.emp_lastname +"/"+data.job_name;
				option.value = empnum;
			 	if(pil =="dari"){
			 		 x.remove(0);
                    var nama_dari = document.getElementById("nama-dari");
                    var nik_dari = document.getElementById("nik-dari");
                    nama_dari.innerHTML = data.job_name;
                    nik_dari.innerHTML ="NIP : " + data.emp_id;
                    document.getElementById("nama_pengirim").value = data.job_name;
                    document.getElementById("nik_pengirim").value = data.emp_id;
                    document.getElementById("jabatan_pengirim").value = data.job_name;
                    document.getElementById("unit_pengirim").value = data.org_name;
                    document.getElementById("nama-dari").innerHTML=data.job_name;
                    document.getElementById("kota").value=data.org_city;
                    document.getElementById("text_kota").innerHTML=data.org_city;
                    // console.log(data);
                        if(aktif_user==empnum){
                                alert("Pembuat nota tidak di perkenankan sebagai pengirim!");
                                return false;
                            
                        }
			 	}
			 	x.add(option, x.options[null]);
			 	 if(pil=="sel_disposisi"){
			 		 x.remove(0);
                                      var value_nama = data.emp_firstname + " "+data.emp_lastname + " / " + data.job_name;
       //          var textbox  = "<tr class='attdis"+empnum+"'><td><input type=hidden name='disposisi_kepada[]' value='"+empnum+"'><input readonly type=\"text\" value='"+value_nama+"' ></td><td><a onclick=remove_att('dis"+empnum+"')>Delete</a></td><td><select name=\"nota_tindakan[]\" >";
       //                        textbox  =textbox+"<option value='Untuk dihadiri'>Untuk dihadiri</option>";
       //                              textbox  =textbox+"<option value='Untuk diketahui'>Untuk diketahui</option>";
       //                              textbox  =textbox+"<option value='Setuju dilaksanakan dan proses selanjutnya'>Setuju dilaksanakan dan proses selanjutnya</option>";
       //                              textbox  =textbox+"<option value='Buatkan konsep jawabannya'>Buatkan konsep jawabannya</option>";
       //                              textbox  =textbox+"<option value='Harap menjadi perhatian Sdr.'>Harap menjadi perhatian Sdr.</option>";
       //                              textbox  =textbox+"<option value='Proses sesuai kewenangan Sdr.'>Proses sesuai kewenangan Sdr.</option>";
       //                              textbox  =textbox+"<option value='Agar dijawab langsung oleh Sdr.'>Agar dijawab langsung oleh Sdr.</option>";
       //                              textbox  =textbox+"<option value='Harap dibicarakan langsung dengan kami'>Harap dibicarakan langsung dengan kami</option>";
       //                             textbox  =textbox+" <option value='Harap dilaporkan hasilnya'>Harap dilaporkan hasilnya</option>";
       //                              textbox  =textbox+"<option value='Agar diperiksa dan ditindaklanjuti'>Agar diperiksa dan ditindaklanjuti</option>";
       //                              textbox  =textbox+"<option value='Manfaatkan informasi ini'>Manfaatkan informasi ini</option>";
       //                              textbox  =textbox+"<option value='Ajukan saran tindak lanjut'>Ajukan saran tindak lanjut</option>";
       //                              textbox  =textbox+"<option value='Teruskan hal ini ke jajaran Sdr.'>Teruskan hal ini ke jajaran Sdr.</option>";
       //                              textbox  =textbox+"<option value='Harap prioritaskan tugas ini'>Harap prioritaskan tugas ini</option>";
       //                              textbox  =textbox+"</select></td></tr>";
       //          var isitindakan = document.getElementById("tindakan").innerHTML
       //          document.getElementById("tindakan").innerHTML =   isitindakan+textbox;
       		var source = ['Untuk diketahui','Setuju dilaksanakan dan proses selanjutnya',"Buatkan konsep jawabannya",
       						"Harap menjadi perhatian Sdr.","Proses sesuai kewenangan Sdr.","Agar dijawab langsung oleh Sdr.",
       						"Harap dibicarakan langsung dengan kami","Harap dilaporkan hasilnya","Agar diperiksa dan ditindaklanjuti",
       						"Manfaatkan informasi ini", "Ajukan saran tindak lanjut", "Teruskan hal ini ke jajaran Sdr.","Harap prioritaskan tugas ini"]
	        var textbox  = "<tr class='attdis"+empnum+"'><td><input type=hidden name='disposisi_kepada[]' value='"+empnum+"'><input readonly type=\"text\" value='"+value_nama+"' ></td><td><a onclick=remove_att('dis"+empnum+"')>Delete</a></td><td><input type='text' name=\"nota_tindakan[]\" class='typeahead-"+empnum+"'></td>";
	                   var isitindakan = document.getElementById("tindakan").innerHTML
                document.getElementById("tindakan").innerHTML =   isitindakan+textbox;
     			$(".typeahead-"+empnum).typeahead({source:source});

                 }
                if(pil == "pemeriksa" || pil=="dari" || pil=="tembusan"){
                	$('#modal-form-pemeriksa').modal("hide");
                	
			 	}
                else
                	$('#modal-form').modal("hide");
			}
		});
}
function submitKepadaCustom(){
	var x = document.getElementById(pil);
	var option = document.createElement("option");
		option.text = $("input[name=txt_kepada]").val();
		option.value = "-1";
		if(option.text == "")
		{
			alert("Data tidak boleh kosong");
			return true;
		}
		x.add(option,x.options[null]);
        $("input[name=txt_kepada]").val("");
        $('#modal-form').modal("hide");
}
