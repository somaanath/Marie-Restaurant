<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h3 class="customer-profile-group-heading"><?php echo "Sales Types"; ?></h3>
<div class="row">
   <?php echo form_open($this->uri->uri_string() . '?group=sales_channel', array('class' => 'client-form', 'autocomplete' => 'off')); ?>
   <div class="additional"></div>
   <div class="col-md-12">
      <div class="horizontal-scrollable-tabs">
         <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
         <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
         <div class="horizontal-tabs">
            <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
               <li role="presentation" class="<?php if (!$this->input->get('tab')) {
                                                   echo 'active';
                                                }; ?>">
                  <a href="#sales_channel" aria-controls="sales_channel" role="tab" data-toggle="tab">
                     <?php echo 'Sales Channel' ?>
                  </a>
               </li>

               <li role="presentation" class="<?php if ($this->input->get('tab') == 'sales_table1') {
                                                   echo 'active';
                                                }; ?>">
                  <a href="#sales_table1" aria-controls="sales_table1" role="tab" data-toggle="tab">
                     <?php echo 'Sales Data By Channel' ?>
                  </a>
               </li>

               <li role="presentation">
                  <a href="#sales_table2" aria-controls="sales_table2" role="tab" data-toggle="tab">
                     <?php echo 'Sales By Menu Product' ?>
                  </a>
               </li>
            </ul>
         </div>
      </div>

      <!-- content -->
      <div class="tab-content mtop15">
         <!-- reach -->

         <div role="tabpanel" class="tab-pane<?php if (!$this->input->get('tab')) {
                                                echo ' active';
                                             }; ?>" id="sales_channel">
            <?php if ($customer_custom_fields) { ?>
               <div role="tabpanel" class="tab-pane <?php if ($this->input->get('tab') == 'custom_fields') {
                                                         echo ' active';
                                                      }; ?>" id="custom_fields">
                  <?php $rel_id = (isset($client) ? $client->userid : false); ?>
                  <?php echo render_custom_fields('customers', $rel_id); ?>
               </div>
            <?php } ?>
            <div class="row">
               <div class="col-md-12">
                  <?php $selected = array();
                  if (isset($sales_channel)) {

                     foreach ($sales_channel as $channel) {
                        array_push($selected, $channel);
                     }
                  }
                  ?>
                  <?php $value = (isset($sales_channel) ? $sales_channel : ''); ?>
                  <?php echo render_select('reach[]', get_reach_types(), array('name', 'name'), 'Sales Type', $selected, array('multiple' => true, 'data-actions-box' => true), array(), '', '', false); ?>
                  
                     <a href="#sales_table1" aria-controls="sales_table1" role="tab" data-toggle="tab"><button type="button">Next</button></a>
               </div>
            </div>
         </div>

         <!-- Sales table -->
         <?php if (!empty($sales_channel)) { ?>
            <div role="tabpanel" class="tab-pane" id="sales_table1">
               <div class="mtop15">
                  <table class="table dt-table scroll-responsive" data-order-col="2" data-order-type="desc">
                     <thead>
                        <tr>
                           <th>Sales Types</th>

                           <?php foreach ($sales_channel as $channel) { ?>

                              <th>
                                 <?php echo $channel; ?>
                              </th>

                           <?php } ?>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <th>Foods</th>
                           <?php for ($i = 0; $i < count($sales_channel); $i++) { ?>
                              <th>
                                 <input type="text" name="food_values[]">
                              </th>
                           <?php } ?>

                        </tr>
                        <tr>
                           <th>Beverages</th>
                           <?php for ($j = 0; $j < count($sales_channel); $j++) { ?>
                              <th>
                                 <input type="text" name="beverages_values[]">
                              </th>
                           <?php } ?>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         <?php } ?>
         <!-- Sales table 2 -->
      </div>
      <?php echo form_close(); ?>
   </div>
</div>