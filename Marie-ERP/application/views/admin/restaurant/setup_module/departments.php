<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h3 class="customer-profile-group-heading"><?php echo "Departments"; ?></h3>
<div class="row">
   <?php echo form_open($this->uri->uri_string()."?group=departments",array('class'=>'client-form','autocomplete'=>'off')); ?>
   <div class="additional"></div>
   <div class="col-md-12">
    
      <div class="tab-content mtop15">
         <?php hooks()->do_action('after_custom_profile_tab_content',isset($restaurant_details) ? $restaurant_details : true); ?>

         <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="contact_info">
            <div class="row">

               <div class="col-md-12">

               <?php $selected = array();
                     if(isset($departments)){
                        
                        foreach($departments as $type){
                           array_push($selected,$type);
                        }
                     }
                     ?>
                  <?php $value = (isset($departments) ? $departments: ''); ?>
                  <?php echo render_select('departments[]', get_departments_types(), array('department_name', 'department_name'), 'Departments', $selected, array('multiple' => true, 'data-actions-box' => true), array(), '', '', false); ?>  
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php echo form_close(); ?>
</div>

