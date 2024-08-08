<?php
$this->load->view('includes/header');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EVENTS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">EVENTS</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header yogintra align-items-center d-flex justify-content-between">
                            <!-- <h3 class="card-title">All EVENTS here</h3> -->
                            <a href="event/add" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Events</a>
                            <a href="#" onclick="filterDue()" class="btn btn-sm btn-secondary ml-auto">&nbsp;&nbsp;Due Customers</a>
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
                                        <input style="height: 32px;" type="date" class="form-control mr-1" id="toDate" max="<?php echo date('Y-m-d', strtotime("tomorrow"));?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Client Name</th>
                                        <th>Client Number</th>
                                        <th>Class Type</th>
                                        <th>Event Name</th>
                                        <th>Package</th>
                                        <th>Full Pay</th>
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
    
    let filterDue = () => {
        getData([],[],'totalPayAmount');
    }
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

    let getData = (startDate='',endDate='',due_type='') => {
        var apiUrl = PANELURL + 'event';
        ajaxCallData(apiUrl, {'event':'getData',startDate:startDate,endDate:endDate,due_type:due_type}, 'POST')
            .then(function (result) {
                resp = JSON.parse(result);
                if (resp.success == 1) {
                    response = resp.data;
                    response['trainer'] = resp.trainer;


                    let cols = [
                        { data: "id" },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return `<a href="${PANELURL}event/view?id=${row.id}">${row.client_name}</a>`;
                            }
                        },
                        { data: "client_number" },
                        { data: "class_type" },
                        { data: "event_name"},
                        { data: "package"},
                        { data: "totalPayAmount"},
                        {
                            data: null,
                            render: function (data, type, row) {
                                return `<div class="d-flex justify-content-between px-1">
                                            <?php if($_SESSION['admin_role_id'] == 1){?>
                                            <button href="#" title="delete this row" onclick="deletecustomer(${row.id})" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            <?php }?>
                                            <a href="event/editEvents?id=${row.id}" title="edit" class="btn btn-warning btn-xs mr5">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a target ="_blank" href="invoice/event?id=${row.id}" title="download invoice" class="btn btn-secondary btn-xs mr5">
                                                <i class="fa fa-download"></i>
                                            </a>
                                        </div>`;
                            }
                        }
                    ];
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

    let deletecustomer = (id) => {
        let postData = {
            'id': id,
        }
        ajaxCallData(PANELURL + 'event/delete', postData, 'POST')
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
