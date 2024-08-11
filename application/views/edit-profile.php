<?php
$this->load->view('includes/header');
?>
<style>
  .chosen-container-single .chosen-single {
    padding: 6px !important;
    height: auto !important;
    border: 1px solid #44444450 !important;
  }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <button class="btn btn-secondary btn-sm" id="back-btn"><i class="fas fa-backward"></i></button>&nbsp;
                    <h1>Edit Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <form id="addLeads">
                        <div class="card-body">
                                <div class="card-body">
                                    <div class="row align-items-start">
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientName">Client Name</label>
                                                <input <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="text" class="form-control editInputBox" id="clientName" name="name"
                                                    placeholder="Enter Client Name">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientNumber">Client Number</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="text" 
                                                    oninput="this.value = this.value.replace(/[^0-9.+]/g, '').replace(/(\..*)\./g, '$1');" 
                                                    class="form-control editInputBox" id="clientNumber"
                                                    name="number" placeholder="Enter Client Number">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientEmail">Email address</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="email" class="form-control editInputBox" id="clientEmail"
                                                    name="email" placeholder="Enter email">
                                            </div>


                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label>Country</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="text" class="form-control editInputBox" id="country"
                                                    name="country" placeholder="Enter Country name">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label>State</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="text" class="form-control editInputBox" id="state"
                                                    name="state" placeholder="Enter state name">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label>City</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="text" class="form-control editInputBox" id="city"
                                                    name="city" placeholder="Enter city name">
                                            </div>
                                            

                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="date">Created Date</label>
                                                <input <?php if($_SESSION['username'] != 'sadmin'){ echo 'readonly'; } ?> required type="datetime-local" class="form-control editInputBox" id="date" name="date"
                                                    placeholder="Pickup date">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label>Type of Class</label>
                                                <input type="hidden" name="hidden_class"  id="class_type_hidden" value="">
                                                <select <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly style="cursor:not-allowed"';} ?>  id="class_type" name="class" class="form-control editInputBox customEditInputBox">
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value= '' selected>Select Your Class type</option>

                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Home Visit Yoga Session">Home Visit Yoga</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Private Online Session">Private Online Yoga</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Group Online Session">Group Online Yoga</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Corporate Yoga Booking">Corporate Yoga</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Retreat">Retreat</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Workshop">Workshop</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Teacher Training Courses">TTC</option>
                                                    <option <?php if($_SESSION['admin_role_id'] == 3){echo 'disabled';} ?> value="Yoga Center">Yoga Center</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientCallFrom">Call From</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="time" class="form-control editInputBox customEditInputBox" id="clientCallFrom"
                                                    name="call-from" placeholder="Enter call start time">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientCallTo">Call To</label>
                                                <input  <?php if($_SESSION['admin_role_id'] == 3){echo 'readonly';} ?> required type="time" class="form-control editInputBox customEditInputBox" id="clientCallTo"
                                                    name="call-to" placeholder="Enter call end time">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientMessage">Client's Message</label>
                                                <input required type="text" class="form-control editInputBox customEditInputBox" id="clientMessage"
                                                    name="client-message" placeholder="Enter your message">
                                            </div>

                                            <div class="form-group col-lg-6 col-sm-12">
                                                <label for="clientSource">Lead Source</label>
                                                <input required type="text" class="form-control editInputBox customEditInputBox" id="clientSource"
                                                    name="lead-source" placeholder="Enter lead source">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="attendee_Name">
                                                <label for="attendeeName">Attendee Name</label>
                                                <input readonly required type="text" class="form-control editInputBox customEditInputBox" id="attendeeName"
                                                    name="attendeeName" placeholder="Enter attendee name" value="<?= ($_SESSION['username'] != 'superadmin') ? $_SESSION['fullName'] :''  ?>">
                                            </div>
                                            
                                            <div class="form-group col-lg-6 col-sm-12" id="packageEd">
                                                <label for="package">Package</label>
                                                <input required type="text" onKeyup="calculateP()" class="form-control editInputBox customEditInputBox" id="package" name="package"
                                                    placeholder="Enter your package">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="quotationEd">
                                                <label for="quotation">Quotation</label>
                                                <input required type="text" onKeyup="calculateP()" class="form-control editInputBox customEditInputBox" id="quotation"
                                                    name="quote" placeholder="Enter your message">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="payable">
                                                <label for="payableAmount">Payable Amount</label>
                                                <input readonly required type="text" class="form-control editInputBox customEditInputBox" name="payableAmount" id="payableAmount"/>
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="demoEd">
                                                <label for="demopay">Trial Pay</label>
                                                <input required type="text" class="form-control editInputBox customEditInputBox" id="demopay" name="demoPay" placeholder="Enter Trial Pay">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="demoDate">
                                                <label for="demopay">Trial Date</label>
                                                <input required type="datetime-local" class="form-control editInputBox customEditInputBox" id="demDate"
                                                    name="demDate" placeholder="Enter Trial Date">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="packageEndDate">
                                                <label for="demopay">Package End Date</label>
                                                <input type="date" class="form-control editInputBox customEditInputBox" id="packEndDate"
                                                    name="packageEndDate" placeholder="Enter Package End Date">
                                            </div>
                                            <div class="form-group col-lg-6 col-sm-12" id="attempStatusHolder">
                                                <label class="mt-3 d-block">Status</label>
                                                <div class="btn-group  justify-content-between"  data-toggle="buttons">
                                                    <label class="btn btn-warning">
                                                        <input type="radio" class="editInputBox customEditInputBox"  name="attempt1" id="option_a1" autocomplete="off" value="0" checked="">
                                                        Pending
                                                    </label>
                                                    <label class="btn btn-success active">
                                                        <input type="radio" class="editInputBox customEditInputBox"  name="attempt1" id="option_a2" value="1" autocomplete="off">
                                                        Done
                                                    </label>
                                                    <label class="btn btn-danger">
                                                        <input type="radio" class="editInputBox customEditInputBox"  name="attempt1" id="option_a3" value="2" autocomplete="off">
                                                        Rejected
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-6 col-sm-12" id="attemp1Holder">
                                                <label class="mb-1">Attempt-1</label>
                                                <input type="text" class="form-control editInputBox customEditInputBox mb-2" id="remarks1" name="remarks1" placeholder="Enter user remarks">
                                                <input type="text" class="form-control editInputBox customEditInputBox atemptDate" id="atemptDate1" name="atemptDate1" value="">
                                            </div>

                                            <div class="form-group col-lg-6 col-sm-12" id="attemp2Holder">
                                                <label class="mb-1">Attempt-2</label>
                                                <input type="text" class="form-control editInputBox customEditInputBox mb-2" id="remarks2" name="remarks2" placeholder="Enter user remarks">
                                                <input type="text" class="form-control editInputBox customEditInputBox atemptDate" id="atemptDate2" name="atemptDate2" value="">
                                            </div>

                                            <div class="form-group col-lg-6 col-sm-12" id="attemp3Holder">
                                                <label class="mb-1">Attempt-3</label>
                                                <input type="text" class="form-control editInputBox customEditInputBox mb-2" id="remarks3" name="remarks3" placeholder="Enter user remarks">
                                                <input type="text" class="form-control editInputBox customEditInputBox atemptDate" id="atemptDate3" name="atemptDate3" value="">
                                                <input type="hidden"  id="leadId" name="leadId" value="">
                                            </div>
                                            
                                            <div class="form-group col-lg-6 col-sm-12" id="fullPatrainerPaymentyment">
                                                <label for="trainerPayment">Trainer's Payment</label>
                                                <input required type="number" class="form-control editInputBox customEditInputBox customerInputBox" id="trainerPayment" name="trainerPayment" placeholder="Enter Trainers Payment">
                                            </div>

                                            <div class="form-group col-lg-6 col-sm-12" id="fulltrainerPayDate">
                                                <label for="trainerPayDate">Trainer's Payment Date</label>
                                                <input required type="datetime-local" class="form-control editInputBox customEditInputBox customerInputBox" id="trainerPayDate" name="trainerPayDate">
                                            </div>

                                            <div class="form-group col-lg-6 col-sm-12" id="trainer">
                                                <label>Select Trainer</label>
                                                <div id="trainer_option"></div>
                                            </div>

                                            <div class="form-group col-lg-6"  id="fullPaymentType">
                                                <label>Type of Payment</label>
                                                <select id="payment_type" name="payment_type" class="form-control editInputBox customEditInputBox customerInputBox">
                                                    <option selected>Select Your Payment type</option>
                                                    <option value="Full Payment">Full Payment</option>
                                                    <option value="Partition Payment">Partition Payment</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-12 col-sm-12" id="fullPay">
                                                <label for="fullPayType">Full Payment</label>
                                                <div id="row" class="row mt-2">
                                                    <div class="input-group col-lg-6">
                                                        <input required type="number" id="fullPayType" onkeyup="checkPayableAmount()" name="totalPayAmount" placeholder="Enter Payment" class="form-control m-input editInputBox customEditInputBox customerInputBox">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <input type="datetime-local" name="totalPayDate"  id="totalPay" class="form-control m-input editInputBox customEditInputBox customerInputBox">
                                                    </div>
                                                </div>
                                                <span id="exceed">Full amount cannot exceed payable amount</span>
                                            </div>

                                            
                                            <div class="form-group col-12" id="fullPayment">
                                                <label for="fullPayment">Payment Amount</label>
                                                <div id="oldinput"></div>
                                                
                            
                                                <div id="newinput"></div>
                                                <button id="rowAdder" type="button"
                                                    class="btn btn-dark  editInputBox customEditInputBox customerInputBox mt-3">
                                                    <span class="bi bi-plus-square-dotted">
                                                    </span> ADD
                                                </button>
                                            </div>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer editProfileContainer justify-content-between">
                            <button type="button" class="btn btn-primary w-100" id="save" onclick="addLead()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<?php
$this->load->view('includes/footer');
?>
<script>
    
    $('#exceed').css('display','none');
    var is_supper = "<?=$_SESSION['is_supper']?>";
    var admin_role_id = "<?=$_SESSION['admin_role_id']?>";
    let param = "<?=$_GET['id']?>";
    $('#leadId').val(param)
    let editLead = (id) => {
        let postData = {
            'id': id,
        }
        ajaxCallData(PANELURL + 'lead/view', postData, 'POST')
            .then(function (result) {
                resp = JSON.parse(result);
                if (resp.success == 1) {
                    response = resp.data;
                    trainers = resp.trainers;
                    paymentDetails = resp.paymentDetails;
                    const date = "<?php   date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d || H:i:s", time()); ?>";
                    //putting values
                    $('#clientName').val(response.name);
                    $('#clientNumber').val(response.number);
                    $('#country').val(response.country);
                    $('#state').val(response.state);
                    $('#city').val(response.city);
                    $('#clientEmail').val(response.email);
                    $('#clientSource').val(response.source);
                    $('#class_type').val(response.class_type);                    
                    $('#clientCallFrom').val(response.call_from);
                    $('#clientCallTo').val(response.call_to);
                    $('#clientMessage').val(response.message);
                    $('#trainerPayment').val(response.payTotrainer);
                    $('#trainerPayDate').val((response.trainerPayDate).slice(0, 16));
                    response.attendeeName==''?'':$('#attendeeName').val(response.attendeeName);
                    $('#date').val( response.created_date );
                    $('#package').val(response.package);
                    $('#quotation').val(response.quotation);
                    $('#payableAmount').val(response.quotation * response.package);
                    $('#demopay').val(response.dempay);
                    $('#demDate').val(response.demDate);
                    $('#packEndDate').val(response.package_end_date);
                    $('#totalPay').val(response.totalPayDate);
                    $('#fullPayType').val(response.full_payment);
                    if (response.attempt1 == 0) {
                        $('#option_a1').attr('checked', true);
                    } else if(response.attempt1 == 1){
                        $('#option_a2').attr('checked', true);
                    }else if(response.attempt1 == 2){
                        $('#option_a3').attr('checked', true);
                    }
                    $('#remarks1').val(response.attempt1Remarks);
                    $('#remarks2').val(response.attempt2Remarks);
                    $('#remarks3').val(response.attempt3Remarks);

                    $('#remarks1').val() !='' ? $('#atemptDate1').val(response.attempt1Date) : $('#atemptDate1').val(date);
                    $('#remarks2').val() !='' ? $('#atemptDate2').val(response.attempt2Date) : $('#atemptDate2').val(date);
                    $('#remarks3').val() !='' ? $('#atemptDate3').val(response.attempt2Date) : $('#atemptDate3').val(date);

                    var html = '';
                    html+=`<select id="select_trainer" name="trainer" class="form-control select_trainer editInputBox">
                                                <option selected>Select Trainer</option>`;
                    $.each(trainers, function(){
                        html += `<option value="${this.id}">${this.name}&nbsp;&nbsp; || M-&nbsp;${this.number}</option>`;
                    });

                    html += `</select>`;
                    $(document).ready(function() {
                            $('.select_trainer').chosen();
                    });
                    
                    $('.chosen-container').addClass('form-control');
                    $('#trainer_option').html(html);
                    response.trainer_id ? $('#select_trainer').val(response.trainer_id) : '';
                    response.payment_type ? $('#payment_type').val(response.payment_type) : '';
                    
                    $.each(paymentDetails, function(){
                        newRowAdd =
                        `<div id="row" class="row mt-2">
                            <div class="input-group col-6">
                                <div class="input-group-prepend">
                                    <button class="btn btn-danger" id="DeleteRow" type="button">
                                        <i class="bi bi-trash"></i>
                                        Delete
                                    </button>
                                </div>
                                <input required type="number" name="fullPayment[]" value="${this.amount}" class="form-control m-input editInputBox customEditInputBox customerInputBox">
                            </div>
                            <div class="col-6">
                                <input type="datetime-local" name="fullPaymentDate[]"  value="${this.created_date}" class="form-control m-input editInputBox customEditInputBox customerInputBox">
                            </div>
                        </div>`;
                        $('#oldinput').append(newRowAdd);
                    });


                    

                    let payType = $( "#payment_type option:selected" ).text();
                    let fullPayAmount = $('#fullPayType').val();
                    $('#fullPayType').val(fullPayAmount);
                    
                    if(payType =='Partition Payment'){
                        $('#fullPayment').css('display', 'block');
                        $('#fullPay').css('display', 'none');
                    }else{
                        $('#fullPay').css('display', 'block');
                        $('#fullPayment').css('display', 'none');
                    }

                    $('#payment_type').change((e)=>{
                        if(e.target.value =='Partition Payment'){
                            $('#fullPayment').css('display', 'block');
                            $('#fullPay').css('display', 'none');
                        }else{
                            $('#fullPayment').css('display', 'none');
                            $('#fullPay').css('display', 'block');
                            $('#fullPayType').val(response.full_payment);
                        }
                    });

                    // hding iputs 
                    if(response.status == 1){
                        $('#isCustomer').val('0');
                        $('#isTelecalling').val('0');

                        $('#fullPay').css('display', 'none');
                        $('#attemp1Holder').css('display', 'none');
                        $('#attempStatusHolder').css('display', 'none');
                        $('#attemp2Holder').css('display', 'none');
                        $('#attemp3Holder').css('display', 'none');
                        $('#fullPayment').css('display', 'none');
                        $('#fullPaymentType').css('display', 'none');
                        $('#trainer').css('display', 'none');
                        $('#attendee_Name').css('display', 'none');
                        $('#packageEd').css('display', 'none');
                        $('#quotationEd').css('display', 'none');
                        $('#demoEd').css('display', 'none');
                        $('#fullPatrainerPaymentyment').css('display', 'none');
                        $('#fulltrainerPayDate').css('display', 'none');
                        $('#payable').css('display', 'none');
                        $('#demoDate').css('display', 'none');
                        $('#packageEndDate').css('display', 'none');
                        $('#back-btn').on('click',()=>{redirect('lead')});
                    }else if(response.status == 2){
                        $('#class_type_hidden').val(response.class_type);

                        $('#isCustomer').val('0');
                        $('#isTelecalling').val('1');

                        $('#fullPay').css('display', 'none');
                        $('#trainer').css('display', 'none');
                        $('#fullPaymentType').css('display', 'none');
                        $('#fullPayment').css('display', 'none');
                        $('#attendeeName').prop('disabled', true);
                        $('#fullPatrainerPaymentyment').css('display', 'none');
                        $('#fulltrainerPayDate').css('display', 'none');
                        $('#back-btn').on('click',()=>{redirect('telecalling')});
                    }else if(response.status == 3){
                        $('#class_type_hidden').val(response.class_type);

                        $('#isCustomer').val('1');
                        $('#isTelecalling').val('1');
                        $('#attemp1Holder').css('display', 'none');
                        $('#attempStatusHolder').css('display', 'none');
                        $('#attemp2Holder').css('display', 'none');
                        $('#attemp3Holder').css('display', 'none');

                        $('#back-btn').on('click',()=>{redirect('customer')});
                        if(admin_role_id == 3){
                            $('.customerInputBox').prop('disabled', false);  
                        }
                    }
                } else {

                }
            })
            .catch(function (err) {
                console.log(err);
            });
    };
    let calculateP = ()=>{
        let package = $('#package').val();
        let quotation = $('#quotation').val();
        let value = package*quotation;
        $('#payableAmount').val(value);
    };
            
    editLead(param);
    
    let addLead = () => {
        $(".editInputBox").prop('disabled', false);
        ajaxCallData(PANELURL + 'lead/edit', $("#addLeads").serialize(), 'POST')
            .then(function (result) {
                response = JSON.parse(result);
                if (response.success == 1) {
                    $('#addLeads')[0].reset();
                    notifyAlert('Your profile data edited successfully', 'success');
                    setTimeout(() => {
                        window.location.href = PANELURL+"profile?id="+param;
                    }, 1000);
                }
            })
            .catch(function (err) {
                console.log(err);
            });
        $(".editInputBox").prop('disabled', true);
    } 

    // /$('.atemptDate').val("<?php   //date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d || H:i:s", time()); ?>");
    
    function disableInput(){
        // $(".editInputBox").prop('disabled', true);

        if(is_supper==1){
            $(".editInputBox").prop('disabled', false);
        }else{
            $(".customEditInputBox").prop('disabled', false);
        }
    }
    disableInput();

    $("#rowAdder").click(function () {
        newRowAdd =
        `<div id="row" class="row mt-2">
            <div class="input-group col-6">
                <div class="input-group-prepend">
                    <button class="btn btn-danger" id="DeleteRow" type="button">
                        <i class="bi bi-trash"></i>
                        Delete
                    </button>
                </div>
                <input required type="number" name="fullPayment[]" placeholder="Enter Payment" class="form-control m-input editInputBox customEditInputBox customerInputBox">
            </div>
            <div class="col-6">
                <input type="datetime-local" name="fullPaymentDate[]" class="form-control m-input editInputBox customEditInputBox customerInputBox" value="${ new Date()}">
            </div>
        </div>`;

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })

    
    let checkPayableAmount = ()=>{
        let payAmnt = parseInt($('#payableAmount').val());
        let fullAmnt = parseInt($('#fullPayType').val());

        if(fullAmnt>payAmnt){
            console.log(payAmnt +'  '+fullAmnt);
            $('button#save').attr('disabled',true);
            $('#fullPayType').css({
                "border": "3px solid red",
                "color": "red"
            });
            $('#exceed').css('display','block');
            $('#exceed').css('color','red');
            notifyAlert('Full amount cannot exceed payable amount', 'danger');
            $('html').css('scroll-behavior','smooth');
        }else{
            $('#exceed').css('display','none');
            $('button#save').attr('disabled',false);
            $('#fullPayType').css({
                "border": "1px solid #ddd",
                "color": "black"
            })
        }
    }
    
</script>
