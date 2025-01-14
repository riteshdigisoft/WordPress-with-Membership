<?php
if(is_user_logged_in()){
    
}else{
    echo '<style>.dashbaord-header,body.page-template-archive-case-logs .sidebar{display:none !important;}.content.profile_content{height: auto !important;}</style>';
}
    /* Template Name: Case Logs Archive Custom */

get_header('dashboard');

echo get_template_part( 'template-headers/sidebar-dashboard' );

?>

<div class="content profile_content">
    <div class="container pt-5 ps-5 pe-5 pb-1">
        <div class="row">
         <div class="col-md-9">         
            <?php
                $User_Id = get_current_user_id();
                $args = array(  
                'post_type' => 'case-logs',
                'post_status' => 'publish',
                'orderby'=> 'date', 
                'author' => $User_Id,
                'posts_per_page' => -1
                );
                $loop = new WP_Query( $args ); 
                if ( $loop->have_posts()  ){  
                    echo '<ul id="arch_caselog" class="caselogs_display_lists display_lists">';
                    //echo '<h2>Case Logs All</h2>';
                ?>
                
                <?php    
                while ( $loop->have_posts() ) : $loop->the_post();
                    $postId = get_the_ID();
                    $post_slug = $post->post_name;
                    $fcname = get_field('facility_name_case');
                    $agecase = get_field('age_case');
                    $gendercase = get_field('gender_case');
                    $phystatus = get_field('physical_status_case');
                    $traumaemg = get_field('traumaemergency_case');
                    $clinicalnot = get_field('clinical_notes_case');
                    $peripheral = get_field('peripheral_case');
                    $document_name = get_field('document_name');
                    $datecselog = get_field('case_log_date');

                    $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
                    $administartionvalues = get_post_meta($postId,'administration_data',true);
                    $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
                    $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);
                    $imgs = get_post_meta($postId,'caselogs_attachment_id',true);

                    $va1 = explode(',', $AnesthesiaTypevalues);
                    $va2 = explode(',', $administartionvalues);
                    $va3 = explode(',', $Proceduresvalues);
                    $va4 = explode(',', $AnatomicalCategoryvalues);


                    $vaules1 = array_unique($va1);
                    $vaules2 = array_unique($va2);
                    $vaules3 = array_unique($va3);
                    $vaules4 = array_unique($va4);
            ?>
                <li class="caselogs_list list-display">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <h5><?php echo $fcname; ?></h5>
                            </div>
                            <div class="col-lg-6 text-end">
                                <a class="editcaselog btn" href="<?php echo get_site_url(); ?>/profile/case-logs/?caseid=<?php echo $postId; ?>">Edit</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Facility Name:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $fcname; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Age:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $agecase; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Gender:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $gendercase; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Date:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $datecselog; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Physcial Status:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $phystatus; ?>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_label">
                                        Trauma/Emergency:
                                    </div>
                                    <div class="data_values">
                                    <?php echo $traumaemg; ?>
                                    </div>
                                </div>
                                <?php if($imgs){ ?>
                                <div class="attachments">
                                    <div class="data_label">
                                        <h3>Attachments:</h3>
                                    </div>
                                    <?php                                    
                                    $meta = explode(',', $imgs);
                                    foreach ($meta as $metas) {
                                        $attch_name = basename( get_attached_file($metas ) );
                                        echo '<a target="_blank" href="'.wp_get_attachment_url($metas).'">'.$attch_name.'</a><br>';
                                    }
                                    ?>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-6">
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                    <b> Anesthesia Type:</b>

                                    <ul>
                                        <?php foreach($vaules1 as $antype){
                                            echo '<li>'.$antype.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Administration:</b>

                                    <ul>
                                        <?php foreach($vaules2 as $admin){
                                            echo '<li>'.$admin.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Anesthesia Procedures:</b>

                                    <ul>
                                        <?php foreach($vaules3 as $anpro){
                                            echo '<li>'.$anpro.'</li>';
                                        } ?>
                                    </ul>
                                    </div>
                                </div>
                                <div class="data-row lic_rows_data">
                                    <div class="data_labels">
                                        <b>Anatomical Category:</b>

                                        <ul>
                                            <?php foreach($vaules4 as $ancat){
                                                echo '<li>'.$ancat.'</li>';
                                            } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </li>
            <?php
            endwhile;
            echo '</ul>';
            }/*else{
                echo "Add your Clinical Information!";
            }	*/
            ?>
        </div>
        <div class="col-md-3">
            <div class="csl_search">    
            <input type="text" id="keyword" placeholder="Enter Name">
            <h5 class="legend">Anesthesia Procedures</h5>
            <ul>
                <li><input type="radio" name="ap" class="ap" value="Arterial Insertion"> Arterial Insertion</li>
                <li><input type="radio" name="ap" class="ap" value="Arterial BP Monitoring"> Arterial BP Monitoring</li>
                <li><input type="radio" name="ap" class="ap" value="Central Line Insertion"> Central Line Insertion</li>
                <li><input type="radio" name="ap" class="ap" value="CVP Monitoring"> CVP Monitoring</li>
                <li><input type="radio" name="ap" class="ap" value="Epidural Blood Patch"> Epidural Blood Patch</li>
                <li><input type="radio" name="ap" class="ap" value="Pulmonary Artery Catheter Insertion"> Pulmonary Artery Catheter Insertion</li>
                <li><input type="radio" name="ap" class="ap" value="Ultrasound for arterial access"> Ultrasound for arterial access</li>
                <li><input type="radio" name="ap" class="ap" value="Ultrasound for venous access"> Ultrasound for venous access</li>
            </ul>
            <button class="caselog_search" id="caselog_search" >Search</button>
            </div> 
        </div>
<!--------------Repeat table------------------->
<?php
 if ( $loop->have_posts()  ){  
                echo '<div id="pdf">';    
           ?>
                
                <?php    
                while ( $loop->have_posts() ) : $loop->the_post();
                    $postId = get_the_ID();
                    $post_slug = $post->post_name;
                    $fcname = get_field('facility_name_case');
                    $agecase = get_field('age_case');
                    $gendercase = get_field('gender_case');
                    $phystatus = get_field('physical_status_case');
                    $traumaemg = get_field('traumaemergency_case');
                    $clinicalnot = get_field('clinical_notes_case');
                    $peripheral = get_field('peripheral_case');
                    $document_name = get_field('document_name');
                    $datecselog = get_field('case_log_date');

                    $AnesthesiaTypevalues = get_post_meta($postId,'AnesthesiaType_data',true);
                    $administartionvalues = get_post_meta($postId,'administration_data',true);
                    $Proceduresvalues = get_post_meta($postId,'AnesthesiaProcedures_data',true);
                    $AnatomicalCategoryvalues = get_post_meta($postId,'AnatomicalCategory_data',true);

                    $va1 = explode(',', $AnesthesiaTypevalues);
                    $va2 = explode(',', $administartionvalues);
                    $va3 = explode(',', $Proceduresvalues);
                    $va4 = explode(',', $AnatomicalCategoryvalues);
            ?>

                <table border="1" cellpadding="4" cellspacing="4" id="myTab" class="table table-striped" width="100%" style="margin-bottom: 20px;">
                    <colgroup>
                        <col width="50%">
                            <col width="50%">
                    </colgroup>
                    <thead>
                        <tr class='warning'>
                            <th colspan="2" align="left" style="padding-left: 10px; text-transform: uppercase; font-size: 16px;"><?php echo $fcname; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td><strong>Facility Name:</strong><?php echo $fcname; ?><br>
                        <strong>Document Name:</strong><?php echo $document_name; ?>
                                    <strong>Age:</strong><?php echo $agecase; ?><br>
                                    <strong>Gender:</strong><?php echo $gendercase; ?><br>
                                    <strong>Date:</strong><?php echo $datecselog; ?><br>
                                    <strong>Physcial Status:</strong><?php echo $phystatus; ?><br>
                                    <strong>Trauma/Emergency:</strong><?php echo $traumaemg; ?><br>
                            </td>
                              <td>
                                <strong>Anesthesia Type:</strong><?php foreach($va1 as $antype){
                                            echo $antype.'<br>';
                                        } ?>
                                     <strong>Administration:</strong>
                                        <?php foreach($va2 as $admin){
                                            echo $admin.'<br>';
                                        } ?>
                                    <strong>Anesthesia Procedures:</strong>
                                        <?php foreach($va3 as $anpro){
                                            echo $anpro.'<br>';
                                        } ?>
                                    <strong>Anatomical Category:</strong>
                                        <?php foreach($va4 as $anpro){
                                            echo $anpro.'<br>';
                                        } ?>
                                    
                              </td>
                        </tr>
                    </tbody>
                </table>
           <?php
            endwhile;
           echo '</div>';
            }

?>


<!-----For PDF Generate---------->            

            

            <div class="printBtns" style="display:flex; justify-content: space-between;">
            <button onclick="printDiv('pdf','Title')">PRINT PDF</button>

            </div>
            <script>
                jQuery('#caselog_search').click(function(){
                    jQuery('.ApWait').show();
                    fetch();
                    fetchTable();
                });
            </script>
        </div>
    </div>
</div>
<div class="ApWait" style="display: none;">
  <div class="loader_child">
    <div id="loading-bar-spinner" class="spinner">
      <div class="spinner-icon"></div>
    </div>
  </div>
</div>
<style type="text/css">
    #myTab{display: none;}
    #case-log-title{
        font-size:30px;

    }
    /*loading icon start*/
    .ApWait{display: none;width: 100%;height: 100%;border: 0 solid black;
       position: fixed;top: 0;left: 0;padding: 2px;
       box-shadow: inset 0 0 0 8000px rgba(0, 0, 0, 0.30);
       z-index: 99999;}
       .loader_child{position:absolute;top:50%;left:50%;padding:15px;
       -webkit-transform:translate(-50%,-50%);
       -moz-transform:translate(-50%,-50%);
       -o-transform:translate(-50%,-50%);
       transform:translate(-50%,-50%);
       }
       #loading-bar-spinner.spinner {
       left: 50%;margin-left: -20px;top: 50%;margin-top: -20px;
       position: absolute;
       animation: loading-bar-spinner 500ms linear infinite;
       }
       #loading-bar-spinner.spinner .spinner-icon {
       width: 40px;height: 40px;border:  solid 4px transparent;
       border-top-color:  #2695FF;
       border-left-color: #2695FF;
       border-radius: 50%;
       -webkit-animation: initial;
       animation: initial;
       }
       @keyframes loading-bar-spinner {
       0%   { transform: rotate(0deg);   transform: rotate(0deg); }
       100% { transform: rotate(360deg); transform: rotate(360deg); }
       }
/*loading icon end*/
</style>

<script type="text/javascript">
function fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#keyword').val(), ap: jQuery('.ap').val() },
        success: function(data) {
            jQuery('.ApWait').hide();
            jQuery('#arch_caselog').html( data );
        }
    });

}

function fetchTable(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch_pdf_table', keyword: jQuery('#keyword').val() },
        success: function(data) {
            jQuery('.ApWait').hide();
            jQuery('#pdf').html( data );
        }
    });

}

function printDiv(divId,title) {

  let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
  mywindow.document.write(`<html><head><title>Case Logs</title>`);
  mywindow.document.write('</head><body>');
  mywindow.document.write(document.getElementById(divId).innerHTML);
  mywindow.document.write('</body></html>');

  mywindow.document.close(); // necessary for IE >= 10
  mywindow.focus(); // necessary for IE >= 10*/

  mywindow.print();
  mywindow.close();

  return true;
}

</script>
<?php
if(is_user_logged_in()){
    get_footer('dashboard');
}else{

}
?>