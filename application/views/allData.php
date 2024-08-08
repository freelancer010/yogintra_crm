<?php
$this->load->view('includes/header');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Data</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header yogintra align-items-center d-flex justify-content-between">
                            <div class="row align-items-center ml-auto" style="margin-bottom:-2px">
                                <div class="filter d-flex justify-content-center align-items-center">
                                    <div class="d-flex mr-1 align-items-center">                                  
                                        <button  type="button" class="btn btn-sm btn-success mr-3 " onclick=filter()>
                                            Generate&nbsp;&nbsp;<i class="fas fa-arrow-right"></i>
                                        </button>
                                        <!-- <button type="button" class="btn btn-danger mr-3" onclick=reset()>reset</button> -->
                                    </div>
                                    <div class="d-flex mr-1 align-items-center">
                                        <!-- <label for="fromDate" class="exampleInputEmail1 mr-1 text-muted ">From</label> -->
                                        <input style="height: 32px;" type="date" class="form-control mr-3" id="fromDate" max="<?php echo date('Y-m-d');?>">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label for="toDate" class="exampleInputEmail1 mt-1 mr-3 text-muted">To</label>
                                        <input style="height: 32px;" type="date" class="form-control mr-1" id="toDate" max="<?php echo date('Y-m-d');?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Client Number</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th style="width:200px !important">Type Of Class</th>
                                        <th style="width:200px !important">Date</th>
                                        <th>Lead Stage</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
    let filter = () => {
        let toDate = $("#toDate").val();
        let fromDate = $("#fromDate").val();
        getData(fromDate,toDate);
    }

    let reset = () => {
        let toDate = $("#toDate").val('');
        let fromDate = $("#fromDate").val('');
        getData();
    }

    let getData = (startDate='',endDate='') => {
        var apiUrl = PANELURL + 'lead/allData';
        ajaxCallData(apiUrl, {startDate:startDate,endDate:endDate}, 'POST')
            .then(function (result) {
                resp = JSON.parse(result);
                if (resp.success == 1) {
                    response = resp.data;
                    let cols = [
                        { data: "id" },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return `<a href="${PANELURL}profile?id=${row.id}">${row.name}</a>`;
                            }
                        },
                        { data: "number" },
                        { data: "country" },
                        { data: "state" },
                        { data: "city" },
                        { data: "class_type" },
                        { data: "created_date" },
                        {
                            data: null,
                            render: function (data, type, row) {
                                    return `${
                                        (row.is_tellecalling == 0 && row.is_customer == 0  && row.is_rejected == 0) ? '<p class="mx-3 my-auto bg-secondary p-1 text-center" style="border-radius:12px">Lead</p>': 
                                            (row.is_tellecalling == 1 && row.is_customer == 0 && row.is_rejected == 0  ) ? '<p class="mx-3 my-auto bg-warning p-1 text-center" style="border-radius:12px">Telecalling</p>':
                                                (row.is_tellecalling == 1 && row.is_customer == 1) ? '<p class="mx-3 my-auto bg-success p-1 text-center" style="border-radius:12px">Customer</p>' :
                                                    (row.is_tellecalling == 1 && row.is_customer == 0  && row.is_rejected == 1 ) ? '<p class="mx-3 my-auto bg-danger p-1 text-center" style="border-radius:12px">Rejected</p>' :
                                                ''
                                    }`;
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return `<div class="d-flex justify-content-between px-3">
                                        <a href="profile/edit?id=${row.id}" title="edit" class="btn btn-warning btn-xs mr5">
                                                <i class="fa fa-edit"></i>
                                        </a>
                                        <button href="#" title="delete this row" onclick="deleteTelecalling(${row.id})" class="btn btn-danger btn-xs">
                                        <i class="fa fa-trash"></i></button>
                                    </div class="d-flex">`;
                            }
                        }
                    ]
                    createDataTable("example1", response, cols);
                } else {
                    createDataTable("example1", '', '');
                }
                $('.buttons-pdf, .buttons-csv').css('height', '33px');
            })
            .catch(function (err) {
                console.log(err);
            });
    };

    getData();

    let change_status = (id, status) => {
        let postData = {
            'id': id,
            'status': status
        }
        ajaxCallData(PANELURL + 'telecalling/changeStatus', postData, 'POST')
            .then(function (result) {
                jsonCheck = isJSON(result);
                if (jsonCheck == true) {
                    resp = JSON.parse(result);
                    if (resp.success == 1) {
                        notifyAlert(resp.message, 'success');
                    } else {
                        notifyAlert('You are not authorized!', 'danger');
                    }
                } else {
                    notifyAlert('You are not authorized!', 'danger');
                }
                getData();
            })
            .catch(function (err) {
                console.log(err);
            });
    };

    let change_back_toLeads = (id, status) => {
        let postData = {
            'id': id,
            'status': status
        }
        ajaxCallData(PANELURL + 'telecalling/changeStatusToLeads', postData, 'POST')
            .then(function (result) {
                jsonCheck = isJSON(result);
                if (jsonCheck == true) {
                    resp = JSON.parse(result);
                    if (resp.success == 1) {
                        getData();
                        notifyAlert(resp.message, 'success');
                    } else {
                        notifyAlert('You are not authorized!', 'danger');
                    }
                } else {
                    notifyAlert('We are sorry, You are not authorized!', 'danger');
                }
            })
            .catch(function (err) {
                console.log(err);
            });
    };

    let deleteTelecalling = (id) => {
        let postData = {
            'id': id,
        }
        ajaxCallData(PANELURL + 'telecalling/deleteData', postData, 'POST')
            .then(function (result) {
                jsonCheck = isJSON(result);
                if (jsonCheck == true) {
                    resp = JSON.parse(result);
                    if (resp.success == 1) {
                        getData();
                        notifyAlert('Deleted successfully!', 'success');
                    } else {
                        notifyAlert('You are not authorized!', 'danger');
                    }
                } else {
                    notifyAlert('You are not authorized!', 'danger');
                }

            })
            .catch(function (err) {
                console.log(err);
            });
    };
</script>