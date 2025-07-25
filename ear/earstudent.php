<?php
include('../config.php');
include(root.'master/header.php'); 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mt-2">
                <div class="col-sm-12">
                    <h1>(<?=$_SESSION['yearname'].' - '. $_SESSION['gradename'] ?>) <?=$lang['earstu_title']?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <table>
                                <tr>
                                    <td><a href="<?=roothtml.'ear/eargrade.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-arrow-left"></i>&nbsp;
                                            <?=$lang['btnback']?>
                                        </a></td>
                                    <td><a href="<?=roothtml.'ear/new_earstudent.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-plus"></i>&nbsp;
                                            <?=$lang['earstu_add']?>
                                        </a></td>
                                    <td><a href="<?=roothtml.'ear/studentexam.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-book"></i>&nbsp;
                                            <?=$lang['earstu_exam']?>
                                        </a></td>
                                    <td>
                                        <a href="<?=roothtml.'ear/studentactivity.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-user"></i>&nbsp;
                                            <?=$lang['earstu_activity']?>
                                        </a>
                                    </td>
                                    <td>
                                        <form method="POST" action="earstudent_action.php">
                                            <input type="hidden" name="hid">
                                            <input type="hidden" name="ser">
                                            <button type="submit" name="action" value="excel"
                                                class="btn btn-sm btn-<?=$color?>"><i
                                                    class="fas fa-file-excel"></i>&nbsp;<?=$lang['btnexcel']?></button>
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST" action="earstudent_action.php">
                                            <input type="hidden" name="hid">
                                            <input type="hidden" name="ser">
                                            <button type="submit" name="action" value="pdf"
                                                class="btn btn-sm btn-<?=$color?>"><i
                                                    class="fas fa-file-excel"></i>&nbsp;PDF</button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?=roothtml.'ear/studenttimetable.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-table"></i>&nbsp;
                                            <?=$lang['earstu_timetable']?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=roothtml.'ear/studentattendance.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-history"></i>&nbsp;
                                            <?=$lang['earstu_attendance']?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=roothtml.'ear/studentreport.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-bar-chart-o"></i>&nbsp;
                                            <?=$lang['earstu_report']?>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="<?=roothtml.'ear/examreport.php'?>" type="button"
                                            class="btn btn-sm btn-<?=$color?>"><i class="fas fa-table"></i>&nbsp;
                                            <?=$lang['earstu_examreport']?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- Card body -->
                        <div class="card-body">
                            <table width="100%">
                                <tr>
                                    <td width="20%">
                                        <div class="form-group row">
                                            <label for="inputEmail3"
                                                class="col-sm-5 col-form-label"><?=$lang['show']?></label>
                                            <div class="col-sm-7">
                                                <select id="entry" class="custom-select btn-sm">
                                                    <option value="10" selected>10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="60%" class="float-right">
                                        <div class="form-group row">
                                            <label for="inputEmail3"
                                                class="col-sm-2 col-form-label"><?=$lang['search']?></label>
                                            <div class="col-sm-10">
                                                <input type="search" class="form-control" id="searching"
                                                    placeholder="Search...">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <div id="show_table" class="table-responsive-sm">

                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include(root.'master/footer.php'); ?>

<script>
$(document).ready(function() {

    function load_pag(page) {
        var entryvalue = $("[name='hid']").val();
        var search = $("[name='ser']").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'ear/earstudent_action.php' ?>",
            data: {
                action: 'show',
                page_no: page,
                entryvalue: entryvalue,
                search: search
            },
            success: function(data) {
                $("#show_table").html(data);

            }
        });
    }
    load_pag();

    $(document).on('click', '.page-link', function() {
        var pageid = $(this).data('page_number');
        load_pag(pageid);
    });

    $(document).on("change", "#entry", function() {
        var entryvalue = $(this).val();
        $("[name='hid']").val(entryvalue);
        load_pag();
    });


    $(document).on("keyup", "#searching", function() {
        var serdata = $(this).val();
        $("[name='ser']").val(serdata);
        load_pag();
    });

    $(document).on("click", "#btngograde", function(e) {
        e.preventDefault();
        var aid = $("#aid").val();
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'ear/earstudent_action.php' ?>",
            data: {
                action: 'gograde',
                aid: aid
            },
            success: function(data) {
                loaction.href = "<?=roothtml.'ear/earstudent.php'?>";
            }
        });
    });

    $(document).on("click", "#btnreport", function(e) {
        e.preventDefault();
        var earid = $(this).data("earid");
        var sid = $(this).data("sid");
        var sname = $(this).data("sname");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'ear/earstudent_action.php' ?>",
            data: {
                action: 'go_detail',
                earid: earid,
                sid: sid,
                sname: sname
            },
            success: function(data) {
                location.href = "<?php echo roothtml.'ear/studentdetail.php' ?>";
            }
        });
    });

    $(document).on("click", "#btnmonthly", function(e) {
        e.preventDefault();
        var earid = $(this).data("earid");
        var sid = $(this).data("sid");
        var sname = $(this).data("sname");
        $.ajax({
            type: "post",
            url: "<?php echo roothtml.'ear/earstudent_action.php' ?>",
            data: {
                action: 'go_detail',
                earid: earid,
                sid: sid,
                sname: sname
            },
            success: function(data) {
                location.href = "<?php echo roothtml.'ear/studentmonthly.php' ?>";
            }
        });
    });




});
</script>