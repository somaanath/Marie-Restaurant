<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h3 class="customer-profile-group-heading"><?php echo "Cuisine Types"; ?></h3>
<div class="row">
   <?php echo form_open($this->uri->uri_string()."?group=cuisine_types",array('class'=>'client-form','autocomplete'=>'off')); ?>
   <div class="additional"></div>
   <div class="col-md-12">
    
      <div class="tab-content mtop15">
         <?php hooks()->do_action('after_custom_profile_tab_content',isset($restaurant_details) ? $restaurant_details : true); ?>

         <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="contact_info">
            <div class="row">

               <div class="col-md-12">

               <?php $selected = array();
                     if(isset($cuisine_types)){
                        
                       foreach($cuisine_types as $type){
                          array_push($selected,$type);
                 
                       }
                     }
                     ?>
                  <!-- cuisine name -->
                  <?php $value = (isset($cuisine_types) ? $cuisine_types: ''); ?>
                  <?php echo render_select_with_input_group('cuisine[]', get_cuisine_types(), array('name', 'name'), 'Cuisine Type', $selected, '<a href="#" onclick="new_kb_group();return false;"><i class="fa fa-plus"></i></a>', array('multiple' => true, 'data-actions-box' => true), $_, $_, $_, false); ?>

                  <!-- reach -->

                  
                  
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php echo form_close(); ?>
</div>

