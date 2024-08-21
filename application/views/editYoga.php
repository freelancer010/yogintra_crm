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
                    <button class="btn btn-secondary btn-sm" id="back-btn"><i
                            class="fas fa-backward"></i></button>&nbsp;
                    <h1>Edit Yoga Center</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit Yoga Center</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <form id="addLeads">
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="clientName">Client Name</label>

                                        <input type="hidden" value="" name="eventId" id="eventId">

                                        <input <?php if ($_SESSION['admin_role_id'] == 3) {
                                            echo 'readonly';
                                        } ?> required
                                            type="text" class="form-control editInputBox" id="clientName" name="name"
                                            placeholder="Enter Client Name">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="clientNumber">Client Number</label>
                                        <input <?php if ($_SESSION['admin_role_id'] == 3) {
                                            echo 'readonly';
                                        } ?> required
                                            type="text"
                                            oninput="this.value = this.value.replace(/[^0-9.+]/g, '').replace(/(\..*)\./g, '$1');"
                                            class="form-control editInputBox" id="clientNumber" name="number"
                                            placeholder="Enter Client Number">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="clientEmail">Email address</label>
                                        <input <?php if ($_SESSION['admin_role_id'] == 3) {
                                            echo 'readonly';
                                        } ?> required
                                            type="email" class="form-control editInputBox" id="clientEmail" name="email"
                                            placeholder="Enter email">
                                    </div>


                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label>Country</label>
                                        <input <?php if ($_SESSION['admin_role_id'] == 3) {
                                            echo 'readonly';
                                        } ?> required
                                            type="text" class="form-control editInputBox" id="country" name="country"
                                            placeholder="Enter Country name">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label>State</label>
                                        <input <?php if ($_SESSION['admin_role_id'] == 3) {
                                            echo 'readonly';
                                        } ?> required
                                            type="text" class="form-control editInputBox" id="state" name="state"
                                            placeholder="Enter state name">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label>City</label>
                                        <input <?php if ($_SESSION['admin_role_id'] == 3) {
                                            echo 'readonly';
                                        } ?> required
                                            type="text" class="form-control editInputBox" id="city" name="city"
                                            placeholder="Enter city name">
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12" id="attendee_Name">
                                        <label for="eventName">Yoga Center Name</label>
                                        <input required type="text" class="form-control editInputBox customEditInputBox"
                                            id="eventName" name="eventName" placeholder="Enter event name">
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="sdate">Start Date</label>
                                        <input required type="datetime-local" class="form-control" id="sdate"
                                            name="start_date" placeholder="Pickup date">
                                    </div>
                                    <div class="form-group col-lg-6 col-sm-12">
                                        <label for="edate">End Date</label>
                                        <input required type="datetime-local" class="form-control" id="edate"
                                            name="end_date" placeholder="Pickup date">
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12" id="packageEd">
                                        <label for="package">Package</label>
                                        <input required type="text" onKeyup="calculateP()"
                                            class="form-control editInputBox customEditInputBox" id="package"
                                            name="package" placeholder="Enter your package">
                                    </div>

                                    <div class="form-group col-lg-6 col-sm-12" id="packageEndDate">
                                        <label for="packageEndDate">Package End Date</label>
                                        <input required type="date" class="form-control" id="packEndDate"
                                            name="packageEndDate" placeholder="Enter Package End Date">
                                    </div>

                                    <div class="form-group col-12" id="fullPaymentType">
                                        <label>Type of Payment</label>
                                        <select id="payment_type" name="payment_type"
                                            class="form-control editInputBox customEditInputBox customerInputBox">
                                            <option selected>Select Your Payment type</option>
                                            <option value="Full Payment">Full Payment</option>
                                            <option value="Partition Payment">Partition Payment</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-12 col-sm-12" id="fullPay">
                                        <label for="fullPayType">Full Payment</label>
                                        <div id="row" class="row mt-2">
                                            <div class="input-group col-lg-6">
                                                <input required type="number" id="fullPayType"
                                                    onkeyup="checkPayableAmount()" name="totalPayAmount"
                                                    placeholder="Enter Payment"
                                                    class="form-control m-input editInputBox customEditInputBox customerInputBox">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="datetime-local" name="totalPayDate" id="totalPay"
                                                    class="form-control m-input editInputBox customEditInputBox customerInputBox">
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
                        <button type="button" class="btn btn-primary w-100" id="save"
                            onclick="editEvent()">Save</button>
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

    $('#exceed').css('display', 'none');
    var is_supper = "<?= $_SESSION['is_supper'] ?>";
    var admin_role_id = "<?= $_SESSION['admin_role_id'] ?>";
    let param = "<?= $_GET['id'] ?>";
    $('#eventId').val(param)
    let editLead = (id) => {
        let postData = {
            'id': id,
        }
        ajaxCallData(PANELURL + 'YogaBooking/getBookingProfile', { 'bookingId': param }, 'POST')
            .then(function (result) {
                resp = JSON.parse(result);
                if (resp.success == 1) {
                    response = resp.data;
                    paymentDetails = resp.data.paymentDetails;
                    const date = "<?php date_default_timezone_set('Asia/Kolkata');
                    echo date("Y-m-d || H:i:s", time()); ?>";
                    //putting values
                    $('#clientName').val(response.client_name);
                    $('#clientNumber').val(response.client_number);
                    $('#country').val(response.country);
                    $('#state').val(response.state);
                    $('#city').val(response.city);
                    $('#clientEmail').val(response.email);
                    $('#class_type').val(response.class_type);
                    $('#eventName').val(response.event_name);
                    $('#package').val(response.package);
                    $('#packEndDate').val(response.package_end_date);
                    $('#sdate').val(response.s_date);
                    $('#edate').val(response.e_date);


                    $('#totalPay').val(response.totalPayDate);
                    $('#fullPayType').val(response.totalPayAmount);
                    response.payment_type ? $('#payment_type').val(response.payment_type) : '';

                    $.each(paymentDetails, function () {
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




                    let payType = $("#payment_type option:selected").text();
                    let fullPayAmount = $('#fullPayType').val();
                    $('#fullPayType').val(fullPayAmount);

                    if (payType == 'Partition Payment') {
                        $('#fullPayment').css('display', 'block');
                        $('#fullPay').css('display', 'none');
                    } else {
                        $('#fullPay').css('display', 'block');
                        $('#fullPayment').css('display', 'none');
                    }

                    $('#payment_type').change((e) => {
                        if (e.target.value == 'Partition Payment') {
                            $('#fullPayment').css('display', 'block');
                            $('#fullPay').css('display', 'none');
                        } else {
                            $('#fullPayment').css('display', 'none');
                            $('#fullPay').css('display', 'block');
                            $('#fullPayType').val(response.full_payment);
                        }
                    });

                    $('#back-btn').on('click', () => { redirect('yoga-bookings/view?id=<?= $_GET['id'] ?>') });

                } else {

                }
            })
            .catch(function (err) {
                console.log(err);
            });
    };
    let calculateP = () => {
        let package = $('#package').val();
        let quotation = $('#quotation').val();
        let value = package * quotation;
        $('#payableAmount').val(value);
    };

    editLead(param);

    let editEvent = () => {
        $(".editInputBox").prop('disabled', false);
        ajaxCallData(PANELURL + 'yoga-bookings/add', $("#addLeads").serialize(), 'POST')
            .then(function (result) {
                response = JSON.parse(result);
                if (response.success == 1) {
                    $('#addLeads')[0].reset();
                    notifyAlert('Your profile data edited successfully', 'success');
                    setTimeout(() => {
                        window.location.href = PANELURL + "yoga-bookings/view?id=" + param;
                    }, 1000);
                }
            })
            .catch(function (err) {
                console.log(err);
            });
        $(".editInputBox").prop('disabled', true);
    }

    // /$('.atemptDate').val("<?php   //date_default_timezone_set('Asia/Kolkata'); echo date("Y-m-d || H:i:s", time()); ?>");

    function disableInput() {
        // $(".editInputBox").prop('disabled', true);

        if (is_supper == 1) {
            $(".editInputBox").prop('disabled', false);
        } else {
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
                <input type="datetime-local" name="fullPaymentDate[]" class="form-control m-input editInputBox customEditInputBox customerInputBox" value="${new Date()}">
            </div>
        </div>`;

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })


    let checkPayableAmount = () => {
        let payAmnt = parseInt($('#payableAmount').val());
        let fullAmnt = parseInt($('#fullPayType').val());

        if (fullAmnt > payAmnt) {
            console.log(payAmnt + '  ' + fullAmnt);
            $('button#save').attr('disabled', true);
            $('#fullPayType').css({
                "border": "3px solid red",
                "color": "red"
            });
            $('#exceed').css('display', 'block');
            $('#exceed').css('color', 'red');
            notifyAlert('Full amount cannot exceed payable amount', 'danger');
            $('html').css('scroll-behavior', 'smooth');
        } else {
            $('#exceed').css('display', 'none');
            $('button#save').attr('disabled', false);
            $('#fullPayType').css({
                "border": "1px solid #ddd",
                "color": "black"
            })
        }
    }

</script>