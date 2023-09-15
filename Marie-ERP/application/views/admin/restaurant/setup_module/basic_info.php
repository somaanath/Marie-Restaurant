<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<h3 class="customer-profile-group-heading"><?php echo "Basic Information" ?></h3>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet"> -->

<style> 
   .container {
      /* display: flexbox;
      justify-content: center;
      align-items: center; */
      max-width: 1140px;
      /* Adjust the maximum width as needed */
      margin: 0 auto;
   }

   .row {
      margin-bottom: 15px;
      /* Add spacing between rows */
   }

   .card {
      /* display: flex; */
      border: 1px solid #e1e1e1;
      /* Add a border to the card */
      border-radius: 4px;
      /* Rounded corners for the card */
   }

   .card-header {
      background-color: #f8f9fa;
      /* Light gray background color for card header */
      border-bottom: 1px solid #dee2e6;
      /* Gray border at the bottom */
      padding: 0.75rem 1.25rem;
      /* Adjust padding as needed */
   }

   .custom-checkbox .custom-control-label {
      cursor: pointer;
      /* Make the label clickable */
   }

   .btn {
      cursor: pointer;
      /* Make buttons clickable */
   }

   .input-group {
      margin-bottom: 10px;
      /* Add spacing between input groups */
   }

   .form-control[type="number"] {
      display: flexbox;
      width: 65px;
      /* Adjust width as needed */
      text-align: center;
      /* Center-align text in number input fields */
   }

   /* Add additional styling here as needed */
</style>
<div class="row">
   <?php echo form_open($this->uri->uri_string(), array('class' => 'client-form', 'autocomplete' => 'off')); ?>
   <div class="additional"></div>
   <div class="col-md-12">
      <?php if ($restaurant_details[0]['restaurant_id']) { ?>
         <div class="horizontal-scrollable-tabs">
            <div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
            <div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
            <div class="horizontal-tabs">
               <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
                  <li role="presentation" class="<?php if (!$this->input->get('tab')) {
                                                      echo 'active';
                                                   }; ?>">
                     <a href="#basic_info" aria-controls="basic_info" role="tab" data-toggle="tab">
                        <?php echo _l('Basic Details'); ?>
                     </a>
                  </li>
                  <li role="presentation" class="<?php if ($this->input->get('tab') == 'working_hours') {
                                                      echo 'active';
                                                   }; ?>">
                     <a href="#working_hours" aria-controls="working_hours" role="tab" data-toggle="tab">
                        <?php echo _l('Working Hours'); ?>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      <?php } ?>
      <div class="tab-content mtop15">

         <div role="tabpanel" class="tab-pane<?php if (!$this->input->get('tab')) {
                                                echo ' active';
                                             }; ?>" id="basic_info">
            <div class="row">

               <div class="col-md-<?php if (isset($restaurant_details[0]['restaurant_id'])) {
                                       echo 10;
                                    } else {
                                       echo 12;
                                    } ?>">

                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['business_type'] : ''); ?>
                  <?php echo render_select('business_type', get_restaurant_types(), array('types', 'types'), 'Business Type', $value); ?>


                  <!-- Restaurant name -->
                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['business_name'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'placeholder' => 'Enter your Restaurant Name')); ?>
                  <?php echo render_input('business_name', 'Business Name', $value, 'text', $attrs); ?>

                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['seating_capacity'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'placeholder' => 'Enter user mail')); ?>
                  <?php echo render_input('restaurant_mail', 'Email', $value, 'text', $attrs); ?>

                  <!-- Restaurant address -->
                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['b_address'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'placeholder' => 'Enter your Restaurant Address')); ?>
                  <?php echo render_input('b_address', 'Address', $value, 'text', $attrs); ?>

  <!-- Restaurant postcode -->
  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['b_postcode'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'placeholder' => 'Enter your Restaurant Postcode', 'id' => "b_postcode")); ?>
                  <?php echo render_input('b_postcode', 'Post Code', $value, 'text', $attrs);
                  ?>

                  <!-- Restaurant state -->
                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['b_state'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'placeholder' => 'Enter the state', 'id' => 'b_state')); ?>
                  <?php echo render_input('b_state', 'State', $value, 'text', $attrs);
                  ?>
<!-- Restaurant country -->
                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['b_country'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'placeholder' => 'Enter Country', 'id' => 'b_country')); ?>
                  <?php echo render_input('b_country', 'Country', $value, 'text', $attrs);
                  ?>

                  <?php $value = (isset($restaurant_details) ? $plan[0]['restaurant_plan'] : ''); ?>
                  <i class="fa fa-info-circle pull-left" data-toggle="tooltip" data-title="Important"></i>
                  <?php echo render_select('plans', get_plans(), array('restaurant_plan', 'restaurant_plan'), 'Plan', $value); ?>

                  <?php $value = (isset($business_type) ? $business_type : ''); ?>
                  <?php $attr  = array('placeholder' => 'Select Plan'); ?>
                  <?php echo render_select('payment_status', get_payment_status(), array('p_id','payment_status'), 'Payment', $value, $attr); ?>
<!-- mail -->

                  <!-- Restaurant dine capacity -->
                  <?php $value = (isset($restaurant_details) ? $restaurant_details[0]['seating_capacity'] : ''); ?>
                  <?php $attrs = (isset($restaurant_details) ? array() : array('autofocus' => true, 'min' => '0')); ?>
                  <?php echo render_input('seating_capacity', 'Dine-in capacity', $value, 'number', $attrs); ?>
                  
               </div>

            </div>

            <?php if ($restaurant_details[0]['restaurant_id']) { ?>
               <button>
                  <a href="#working_hours" aria-controls="working_hours" role="tab" data-toggle="tab">Next</a>
               </button>
         </div>
         <div role="tabpanel" class="tab-pane" id="working_hours">
            <div class="container">
               <!-- Sunday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-sunday">
                              <label class="custom-control-label" for="whs-sunday">
                                 <span class="d-none d-sm-inline">Sunday</span>
                                 <span class="d-inline d-sm-none">Sun</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>
                        <!-- ... (rest of your Sunday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" name="sun[]" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" name="sun[]" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>

               <!-- Monday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-monday">
                              <label class="custom-control-label" for="whs-monday">
                                 <span class="d-none d-sm-inline">Monday</span>
                                 <span class="d-inline d-sm-none">Mon</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>
                        <!-- ... (rest of your Monday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>

               <!-- Tuesday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-tuesday">
                              <label class="custom-control-label" for="whs-tuesday">
                                 <span class="d-none d-sm-inline">Tuesday</span>
                                 <span class="d-inline d-sm-none">Tue</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>
                        <!-- ... (rest of your Tuesday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <!-- Wednesday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-wednesday">
                              <label class="custom-control-label" for="whs-wednesday">
                                 <span class="d-none d-sm-inline">Wednesday</span>
                                 <span class="d-inline d-sm-none">Wed</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>
                        <!-- ... (rest of your Wednesday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>

               <!-- Thursday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-thursday">
                              <label class="custom-control-label" for="whs-thursday">
                                 <span class="d-none d-sm-inline">Thursday</span>
                                 <span class="d-inline d-sm-none">Thu</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>
                        <!-- ... (rest of your Thursday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>

               <!-- Friday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-friday">
                              <label class="custom-control-label" for="whs-friday">
                                 <span class="d-none d-sm-inline">Friday</span>
                                 <span class="d-inline d-sm-none">Fri</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>


                        <!-- ... (rest of your Friday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>

               <!-- Saturday -->
               <div class="row">
                  <div class="col-12 col-sm-6">
                     <div class="card mb-3">
                        <div class="card-header">
                           <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="whs-saturday">
                              <label class="custom-control-label" for="whs-saturday">
                                 <span class="d-none d-sm-inline">Saturday</span>
                                 <span class="d-inline d-sm-none">Sat</span>
                              </label>
                              <span class="ml-auto float-right"> <!-- This class will align content to the right -->
                                 <button class="btn btn-outline-success btn-sm js-whs__add-btn" type="button">
                                    <i class="bi bi-plus"></i> Add
                                 </button>
                              </span>
                           </div>
                        </div>
                        <!-- ... (rest of your Saturday card code) -->
                        <div class="card-body">
                           <div class="row">
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="09">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                              <div class="col-6">
                                 <div class="form-group">
                                    <div class="input-group">
                                       <input type="number" class="form-control" aria-label="Hour" max="12" min="0" placeholder="09" value="13">
                                       <div class="input-group-append">
                                          <span class="input-group-text">:</span>
                                       </div>
                                       <input type="number" class="form-control" aria-label="Minute" max="60" min="0" placeholder="00" value="00">
                                    </div>
                                 </div>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>
      <?php } ?>
      </div>

   </div>
   <?php $this->load->view('admin/clients/client_group'); ?>
   <?php echo form_close(); ?>
</div>
<script>
   var div = document.createElement('div');
   div.setAttribute("id", "div1");
   var label = document.createElement('label');
   label.setAttribute('class', 'control-label');
   label.setAttribute('for', 'state');
   label.innerText = "State";
   var selectEle = document.createElement('select');
   selectEle.setAttribute("id", "state");
   selectEle.setAttribute('name', 'state'); // Add a name attribute for form submission

   // div.appendChild(label);
   // div.appendChild(selectEle);

   // Append the created elements to the appropriate parent element
   var put = document.querySelector(".panel-body"); // Use querySelector instead of getElementsByClassName
   put.appendChild(div);

   // Function to handle input change
   function handleInputChange(inputElement) {
      var newValue = inputElement.value;
      fetchData(newValue);
   }
   // Attach the event listener to the input field
   // var inputElement = document.getElementById('restaurant_name');
   var inputElement = document.getElementById('b_postcode');
   var inputElementForState = document.getElementById('b_state');
   var inputElementForCountry = document.getElementById('b_country');
   inputElement.addEventListener('blur', function() {
      console.log("funcation call");
      // This function will be called when the input field loses focus
      handleInputChange(inputElement);
   });

   async function fetchData(newValue) {
      const response = await fetch(
         `https://app.zipcodebase.com/api/v1/search?apikey=81b4a800-4014-11ee-a4b5-adb669b8a556&codes=${newValue}`
      );

      const data = await response.json();

      // Assuming data.results is an object, not an array
      // const stateList = data.results[newValue].map(element => element.state);

      // Get the select element
      // var selectElement = document.getElementById('state');

      // Clear existing options
      // selectElement.innerHTML = '';

      inputElementForState.value = data.results[newValue][0]['state']

      if(data.results[newValue][0]['country_code'] == 'IN'){
         inputElementForCountry.value = "India"   
       }else{
         inputElementForCountry.value = "Malaysia" 
       }

            //inputElementForCountry.value = data.results[newValue][0]['country_code']

      // Populate the select element with options
      // stateList.forEach(state => {
      //    var option = document.createElement('option');
      //    option.value = state;
      //    option.textContent = state;
      //    selectElement.appendChild(option);
      // });
   }
</script>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      // Function to create a new set of hour inputs
      function createHourInputs() {
         // Create a Bootstrap row
         const row = document.createElement('div');
         row.classList.add('row');

         // Create and append the start hour input column
         const startHourColumn = document.createElement('div');
         startHourColumn.classList.add('col-6');
         const startHourInput = document.createElement('input');
         startHourInput.type = 'number';
         startHourInput.className = 'form-control';
         startHourInput.setAttribute('max', '12');
         startHourInput.setAttribute('min', '0');
         startHourInput.setAttribute('placeholder', '09');
         startHourInput.value = '09';
         startHourColumn.appendChild(startHourInput);
         row.appendChild(startHourColumn);

         // Create and append the start minute input column
         const startMinuteColumn = document.createElement('div');
         startMinuteColumn.classList.add('col-6');
         const startMinuteInput = document.createElement('input');
         startMinuteInput.type = 'number';
         startMinuteInput.className = 'form-control';
         startMinuteInput.setAttribute('max', '60');
         startMinuteInput.setAttribute('min', '0');
         startMinuteInput.setAttribute('placeholder', '00');
         startMinuteInput.value = '00';
         startMinuteColumn.appendChild(startMinuteInput);
         row.appendChild(startMinuteColumn);

         // Create and append the end hour input column
         const endHourColumn = document.createElement('div');
         endHourColumn.classList.add('col-6');
         const endHourInput = document.createElement('input');
         endHourInput.type = 'number';
         endHourInput.className = 'form-control';
         endHourInput.setAttribute('max', '12');
         endHourInput.setAttribute('min', '0');
         endHourInput.setAttribute('placeholder', '09');
         endHourInput.value = '09';
         endHourColumn.appendChild(endHourInput);
         row.appendChild(endHourColumn);

         // Create and append the end minute input column
         const endMinuteColumn = document.createElement('div');
         endMinuteColumn.classList.add('col-6');
         const endMinuteInput = document.createElement('input');
         endMinuteInput.type = 'number';
         endMinuteInput.className = 'form-control';
         endMinuteInput.setAttribute('max', '60');
         endMinuteInput.setAttribute('min', '0');
         endMinuteInput.setAttribute('placeholder', '00');
         endMinuteInput.value = '00';
         endMinuteColumn.appendChild(endMinuteInput);
         row.appendChild(endMinuteColumn);

         // Create and append the Delete button column
         const deleteButtonColumn = document.createElement('div');
         deleteButtonColumn.classList.add('col-12');
         const deleteButton = document.createElement('button');
         deleteButton.textContent = 'Delete';
         deleteButton.className = 'btn btn-outline-danger btn-sm js-whs__remove-btn';
         deleteButton.type = 'button';
         deleteButtonColumn.appendChild(deleteButton);
         row.appendChild(deleteButtonColumn);

         // Add event listener to the Delete button
         deleteButton.addEventListener('click', function() {
            // Remove this set of hour inputs (the parent row)
            row.parentElement.removeChild(row);
         });

         return row;
      }

      // Add event listeners to the "Add" buttons
      const addButtons = document.querySelectorAll('.js-whs__add-btn');
      addButtons.forEach(addButton => {
         addButton.addEventListener('click', function() {
            // Find the corresponding card body
            const cardBody = this.closest('.card').querySelector('.card-body');
            // Create a new set of hour inputs
            const newHourInputs = createHourInputs();
            // Append the new hour inputs to the card body
            cardBody.appendChild(newHourInputs);
         });
      });
   });
</script>
</body>

</html>