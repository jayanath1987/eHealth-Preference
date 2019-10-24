
<?php
/*
--------------------------------------------------------------------------------
HHIMS - Hospital Health Information Management System
Copyright (c) 2011 Information and Communication Technology Agency of Sri Lanka
<http: www.hhims.org/>
----------------------------------------------------------------------------------
This program is free software: you can redistribute it and/or modify it under the
terms of the GNU Affero General Public License as published by the Free Software 
Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,but WITHOUT ANY 
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR 
A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.

You should have received a copy of the GNU Affero General Public License along 
with this program. If not, see <http://www.gnu.org/licenses/> 




---------------------------------------------------------------------------------- 
Date : June 2016
Author: Mr. Jayanath Liyanage   jayanathl@icta.lk

Programme Manager: Shriyananda Rathnayake
URL: http://www.govforge.icta.lk/gf/project/hhims/
----------------------------------------------------------------------------------
*/
include_once("header.php");	///loads the html HEAD section (JS,CSS)

?>
<?php echo Modules::run('menu'); //runs the available menu option to that usergroup ?>
<script language="javascript"> 

                    function add_stock(drug_count_id){
                        var inpdrgi = parseInt($(String("#inpdrgi_"+drug_count_id)).val());
                        var hdrug = parseInt($(String("#hdrug")).val());     
                        var AddCount = parseInt($(String("#inp_"+drug_count_id)).val());
			var who_drug_count = parseInt($(String("#inp_"+drug_count_id)).val());
                        var who_remain_count = parseInt($(String("#inp_"+drug_count_id)).val());
			var current_count = $("#cell_"+drug_count_id).html();
                        var remain_count = $("#ajxcell_"+drug_count_id).html();
                        var hdrug_S = parseInt($(String("#hdrug_"+drug_count_id)).val());
                        
			if (current_count==""){
				current_count =0;
			}
                        if (remain_count==""){
				remain_count =0;
			}
                        
			if (who_drug_count){
				who_drug_count = parseInt(parseInt(+who_drug_count)+parseInt(+current_count));
                                //remain_count = parseInt(parseInt(+who_remain_count)+parseInt(+remain_count));
                                
				var request = $.ajax({
					url: "<?php echo base_url(); ?>index.php/drug_stock/add_stock/",
					type: "post",
					data:{"drug_count_id":drug_count_id,"who_drug_count":who_drug_count,"who_remain_count":remain_count, "hdrug" : hdrug, "AddCount":AddCount, "inpdrgi":inpdrgi, "hdrug_S":hdrug_S}
				});
				request.done(function (response, textStatus, jqXHR){
					if(response == drug_count_id){
						$("#cell_"+response).html(who_drug_count).removeClass("label-warning").addClass("label-success");
                                                $("#ajxcell_"+response).html(remain_count).removeClass("label-warning").addClass("label-success");
						$("#inp_"+response).val("");
					}
				});
			}
		}
                
                
                
                function remove_stock(drug_count_id){
                        var inpdrgi = parseInt($(String("#inpdrgi_"+drug_count_id)).val());
                        var hdrug = parseInt($(String("#hdrug")).val());     
                        var AddCount = parseInt($(String("#inp2_"+drug_count_id)).val());
			var who_drug_count = parseInt($(String("#inp2_"+drug_count_id)).val());
                        var who_remain_count = parseInt($(String("#inp2_"+drug_count_id)).val());
			var current_count = $("#cell_"+drug_count_id).html();
                        var remain_count = $("#ajxcell_"+drug_count_id).html();
                        var hdrug_S = parseInt($(String("#hdrug_"+drug_count_id)).val());
                        
			if (current_count==""){
				current_count =0;
			}
                        if (remain_count==""){
				remain_count =0;
			}
                        
			if (who_drug_count){
				who_drug_count = parseInt(parseInt(+who_drug_count)+parseInt(+current_count));
                                //remain_count = parseInt(parseInt(+who_remain_count)+parseInt(+remain_count));
                                
				var request = $.ajax({
					url: "<?php echo base_url(); ?>index.php/drug_stock/remove_stock/",
					type: "post",
					data:{"drug_count_id":drug_count_id,"who_drug_count":who_drug_count,"who_remain_count":remain_count, "hdrug" : hdrug, "AddCount":AddCount, "inpdrgi":inpdrgi, "hdrug_S":hdrug_S}
				});
				request.done(function (response, textStatus, jqXHR){
					if(response == drug_count_id){
						$("#cell_"+response).html(who_drug_count).removeClass("label-warning").addClass("label-success");
                                                $("#ajxcell_"+response).html(remain_count).removeClass("label-warning").addClass("label-success");
						$("#inp_"+response).val("");
					}
				});
			}
		}
                
                function add_favourite(dd_id){
                       
                        var dd_id = dd_id;
                                                
			//var who_drug_count = parseInt($(String("#inp_"+dcid)).val());
			//var current_count = $("#chk_"+drug_count_id).html();
                        var flage = 0;
                        if (document.getElementById("chk_"+dd_id).checked){
                            flage = 1;
                        }    
                            
			
				//who_drug_count = parseInt(parseInt(+who_drug_count)+parseInt(+current_count));
				var request = $.ajax({
					url: "<?php echo base_url(); ?>index.php/preference/add_favourite/",
					type: "post",
					data:{"dd_id":dd_id,"flage":flage}
				});
				 request.done(function (response, textStatus, jqXHR){
                                   
					if(response == drug_count_id){
						$("#cell_"+response).html(who_drug_count).removeClass("label-warning").addClass("label-success");
						$("#inp_"+response).val("");
					}
				}); 
			
		} 
                
	</script>
	<div class="container" style="width:95%;">
		<div class="row" style="margin-top:55px;">
		  <div class="col-md-2 ">
			<?php //echo Modules::run('leftmenu/questionnaire'); //runs the available left menu for preferance ?>
			<?php 
					echo Modules::run('leftmenu/preference'); //runs the available left menu for preferance 
			?>
		  </div>
                    
		  <div class="col-md-10 ">
		  		<?php 
					if (isset($error)){
						echo '<div class="alert alert-danger"><b>ERROR:</b>'.$error.'</div>';
						exit;
					}
					
				?>		  
				<div class="panel panel-default"  >
					<div class="panel-heading"><b>My Drug Management </b>
					</div>
					<div class="well well-sm">
						<?php
							if ( empty($drug_list)) {
									echo 'There is no drugs in your List. <a href="'.site_url("preference/load_user_drug").'">Load drugs</a>';
							}
				
						else{
                                                        echo '<input id="searchInput" value="Type To Filter"   style="width: 930px; border-color: #9ecaed; box-shadow: 0 0 10px #9ecaed;" >';
							echo '<table class="table table-condensed table-bordered table-striped table-hover">';
                                                                        echo '<tr>';
									echo '<th>';
									echo '<b>Drug Name</b>';
									echo '</th>';
                                                                        echo '<th>';
									echo '<b>Add to Favourite</b>';
									echo '</th>';
									                                                                     

								echo '<tbody id="fbody">';
								for ($i=0; $i<count($drug_list); ++$i){
									echo '<tr>';
                                                                        echo '<td>';
									echo $drug_list[$i]["name"];
									echo '</td>';
							
                                                                        echo '<td >';
                                                                                echo ' <input  id="chk_'.$drug_list[$i]["id"].'" type="checkbox" class=""   step=100 onclick=add_favourite("'.$drug_list[$i]["id"].'") '; if($drug_list[$i]["Active"]== "1"){ echo 'checked=checked;'; } echo '>';
										//if($drug_list[$i]["Active"]== "1"){ echo 'checked=checked;'; }
									echo '</td>';
                                                                        
								echo '</tr>';
								}
                                                                
							echo "</tbody></table>";
                                                        
						}
						
					?>
                                            </div>
				</div>
			</div>
		</div>
	</div>
<script type="text/javascript">
            
            $("#searchInput").keyup(function () { 
    //split the current value of searchInput
    var data = this.value.split(" ");
    //create a jquery object of the rows
    var jo = $("#fbody").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.
    jo.filter(function (i, v) {
        var $t = $(this);
        for (var d = 0; d < data.length; ++d) {
            if ($t.is(":contains('" + data[d] + "')")) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});
            
        </script> 	
	