<?php
$this->load->view('includes/header');
?>
<style>
    .list-group-item {
        border: 0px solid rgba(0, 0, 0, .125);
        border-bottom: 1px solid rgba(0, 0, 0, .125);
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <button class="btn btn-secondary btn-sm" id="back-btn"><i
                            class="fas fa-backward"></i></button>&nbsp;
                    <h1>Yoga Center Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Yoga Center Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <p class="text-muted text-center my-12">Center Details</p><br /><br />
                            <div class="overlay hidden">
                                <i class="fas fa-2x fa-sync-alt"></i>
                            </div>
                            <ul class="list-groups list-group-unbordered mb-3 row align-items-start"></ul>
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
    let param = "<?= $_GET['id'] ?>";
    let getData = () => {
        var apiUrl = PANELURL + 'yoga-bookings/view';
        ajaxCallData(apiUrl, { 'bookingId': param }, 'POST')
            .then(function (result) {
                resp = JSON.parse(result);
                respRenewDetails = resp.renew_details;
                resp = resp['data'];
                resppaymentDetails = resp['paymentDetails'];

                $('.list-groups').append(`
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Client Name&nbsp;:</b><span class="mx-2">${resp.client_name}</span>
                                    <a class="float-right"></a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Number&nbsp;:</b><span class="mx-2">${resp.client_number}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Email&nbsp;:</b><span class="mx-2">${resp.email}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Country&nbsp;:</b><span class="mx-2">${resp.country}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>State&nbsp;:</b><span class="mx-2">${resp.state}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>City&nbsp;:</b><span class="mx-2">${resp.city}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Event Type&nbsp;:</b><span class="mx-2">${resp.class_type}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Event Name&nbsp;:</b><span class="mx-2">${resp.event_name}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Event Date&nbsp;:</b><span class="mx-2">${resp.created_date}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Package&nbsp;:</b><span class="mx-2">${resp.package}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Package End Date&nbsp;:</b><span class="mx-2">${resp.package_end_date}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Payment Type&nbsp;:</b><span class="mx-2">${resp.payment_type}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                <li class="list-group-item col-lg-6 col-sm-12">
                                    <b>Total Amount Paid&nbsp;:</b><span class="mx-2">${resp.totalPayAmount}</span>
                                    <a class="float-right">
                                    </a>
                                </li>
                                
                                
                                ${resp.payment_type == 'Partition Payment' ?
                        `<li id="oldinput" class="list-group-item col-lg-12 col-sm-12 text-center  mt-5 mb-5 bg-info p-3">
                                        <b style="border-bottom:1px solid #ddd">Partial Payment History</b>
                                    </li>`:
                        `<li class="list-group-item col-lg-6 col-sm-12">
                                        <b>Full Payment Date&nbsp;:</b><span class="mx-2">${(resp.totalPayDate).slice(0, 10)}&nbsp; at &nbsp;${(resp.totalPayDate).slice(11)}</span>
                                        <a class="float-right"></a>
                                    </li>`
                    }
                                <a href="${PANELURL}yoga-bookings/editEvents?id=${resp.id}&yoga=1" class="btn btn-primary btn-block"><b>Edit Yoga Center</b></a>
                                ${respRenewDetails.length > 0 ? `<li class="list-group-item col-lg-12 col-sm-12 text-center  mt-5 mb-5 bg-info p-3" id="renDetail"><b style="border-bottom:1px solid">Package Renew History</b></li>`: ''}`);

                $.each(resppaymentDetails, function () {
                    newRowAdd =
                        `< div id = "row" class= "row mt-2" >
                                        <div class="input-group col-6">
                                            <p class="amount">Amount:&nbsp;&nbsp;${this.amount}</p>
                                        </div>
                                        <div class="col-6">
                                            <p lass="amountDate">Date:&nbsp;&nbsp;${(resp.created_date).slice(0, 10)}&nbsp; at &nbsp;${(resp.created_date).slice(11)}</p>
                                        </div>
                                    </div >`;
                    $('#oldinput').append(newRowAdd);
                });

                $.each(respRenewDetails, function () {
                    newRowAdd =
                        `<div id = "row" class="row mt-2">
                            <div class="input-group col-6">
                                <p><b>Renew Date:</b>&nbsp;&nbsp;${this.renew_date}</p>
                            </div>
                            <div class="col-6">
                                <p><b>Renew By:</b>&nbsp;&nbsp;${(this.created_by)}</p>
                            </div>
                        </div>`;
                    $('#renDetail').append(newRowAdd);
                });
            })
            .catch(function (err) {
                console.log(err);
            });
    };
    $('#back-btn').on('click', () => { redirect('yoga-bookings') });

    getData();
</script>