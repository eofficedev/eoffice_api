<!--
<style type="text/css">
    #table-karyawan td, #table-karyawan-2 td, #table-karyawan-3 td {
        padding-left: 20px;
        width: 150px;
        text-align: center;
    }
    #table-karyawan tr {

    }
</style>
-->
<script type="text/javascript">
    $(document).ready(function() {
        $('#listorg').DataTable();
    } );
</script>

<div id="content" style="width: 90%">
    <h2>Daftar Organisasi</h2>
    <!-- style="margin: 0px; padding: 20px; text-align: left;" -->
    <div id="status" style="text-align: center; font-size: smaller; padding-top:10px; padding-bottom: 10px; background-color: yellow; <?php if (!isset($status)) {
    echo 'display:none;';
} ?>" ><b>
            <?php
            if (isset($status)) {
                echo $status;
            }
            ?></b>
    </div>
    <!--<?php
        $this->load->view('filter/org_filter');
    ?>
    <p style="margin-left:20px;">
        <?php
            $filter = "Semua Organisasi";
            
            if($this->input->post('keyword')!=null)
            $filter = $this->input->post('keyword');
        ?>
        
        <i>Filter : <?php echo $filter; ?></i></p>-->
    <table id="listorg" class="display compact" style="width:100%">
        <!-- style="width: 900px; text-align: left; margin-left: 30px; border-spacing: 0px;"-->
        <thead>
        <!-- style="background-color: black; color:white; text-align: center; padding-bottom: 1em"-->
            <tr>
                <th>Kode Organisasi</th>
                <th>Nama Organisasi</th>
                <th>Nama OPD</th>
                <th>Alamat</th>
            </tr>
        </thead>
    <?php
        foreach($org->result() as $row){  
//            ?>
            <tr>
                <!-- class="emp-data"-->
                <!--
                <td style="padding-left: 20px;"><a style="color:black;" href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_id; ?></a></td>
                <td style="padding-left: 20px;"><a style="color:black;" href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_name; ?></a></td>
                <td style="padding-left: 20px;"><a style="color:black;" href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_code; ?></a></td>
                <td style="padding-left: 20px;"><a style="color:black;" href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_address; ?></a></td>
                -->
                <td><a href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_id; ?></a></td>
                <td><a href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_name; ?></a></td>
                <td><a href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_code; ?></a></td>
                <td><a href="org/view/id/<?php echo $row->org_num; ?>"><?php echo $row->org_address; ?></a></td>
            </tr>
            <?php
        }
    ?>
    </table>

    <!--<div style="padding-left: 20px; margin-top:40px;"> <p><b> Total Data : <?php  echo $org->num_rows(); ?> Organisasi
            </b></p>
    </div>-->

</div>
