<?php
$this->load->view('includes/header');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Renewal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Renewal</li>
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
                                        <button type="button" class="btn btn-sm btn-success mr-3 " onclick=filter()>
                                            Generate&nbsp;&nbsp;<i class="fas fa-arrow-right"></i>
                                        </button>
                                    </div>
                                    <div class="d-flex mr-1 align-items-center">
                                        <input style="height: 32px;" type="date" class="form-control mr-3" id="fromDate"
                                            max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <label for="toDate" class="exampleInputEmail1 mt-1 mr-3 text-muted">To</label>
                                        <input style="height: 32px;" type="date" class="form-control mr-1" id="toDate"
                                            max="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:2% !important;">ID</th>
                                        <th style="width:10% !important;">Client Name</th>
                                        <th style="width:6% !important;">Client Number</th>
                                        <th style="width:5% !important;">Country</th>
                                        <th style="width:5% !important;">State</th>
                                        <th style="width:5% !important;">City</th>
                                        <th style="width:10% !important;">Type Of Class</th>
                                        <th style="width:10% !important;">Date</th>
                                        <th style="width:5% !important;">Package Expire Date</th>
                                        <th style="width:5% !important;">Action</th>
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
        getData(fromDate, toDate);
    }

    let reset = () => {
        let toDate = $("#toDate").val('');
        let fromDate = $("#fromDate").val('');
        getData();
    }

    let getData = (startDate = '', endDate = '') => {
        var apiUrl = PANELURL + 'renewal/view';
        ajaxCallData(apiUrl, {
                startDate: startDate,
                endDate: endDate
            }, 'POST')
            .then(function(result) {
                resp = JSON.parse(result);
                if (resp.success == 1) {
                    response = resp.data;
                    let cols = [{
                            data: null,
                            render: function(data, type, row) {
                                return row.id;
                            }
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return `<a href="${PANELURL}profile?id=${row.id}">${row.name}</a>`;
                            }
                        },
                        {
                            data: "number"
                        },
                        {
                            data: "country"
                        },
                        {
                            data: "state"
                        },
                        {
                            data: "city"
                        },
                        {
                            data: "class_type"
                        },
                        {
                            data: "created_date"
                        },
                        {
                            data: "package_end_date"
                        },
                        {
                            data: null,
                            render: function(data, type, row) {
                                return `<div class="d-flex justify-content-between">
                                            <button title="renew this row" onclick="renewData(${row.id})" class="btn btn-warning btn-xs">
                                                <i class="fa fa-edit mr5"></i>
                                            </button>
                                            <button href="#" title="delete this row" onclick="deleteTelecalling(${row.id})" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash mr5"></i>
                                            </button>
                                        </div>`;
                            }
                        }
                    ]
                    createDataTable("example1", response, cols);
                    $('.buttons-pdf, .buttons-csv').css('height', '33px');

                } else {
                    createDataTable("example1", '', '');
                }
            })
            .catch(function(err) {
                console.log(err);
            });
    };

    getData();

    let deleteTelecalling = (id) => {
        let postData = {
            'id': id,
        }
        ajaxCallData(PANELURL + 'renewal/deleteData', postData, 'POST')
            .then(function(result) {
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
            .catch(function(err) {
                console.log(err);
            });
    };

    let renewData = (id) => {
        let postData = {
            'id': id,
        }
        ajaxCallData(PANELURL + 'renewal/editRenewal', postData, 'POST')
            .then(function(result) {
                jsonCheck = isJSON(result);
                if (jsonCheck == true) {
                    resp = JSON.parse(result);
                    if (resp.success == 1) {
                        getData();
                        notifyAlert('Data renewed successfully!', 'success');
                    } else {
                        notifyAlert('You are not authorized!', 'danger');
                    }
                } else {
                    notifyAlert('You are not authorized!', 'danger');
                }
            })
            .catch(function(err) {
                console.log(err);
            });
    };
</script>