<!DOCTYPE html>
<?php
    session_start();
    if(!$_SESSION['Logged_In'])
    {
        header('Location:login.php');
        exit;
    }
    include ("config.php");
    // session_destroy();
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title>Unilag Counselling Unit</title>
    <!--Core CSS -->
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="js/jvector-map/jquery-jvectormap-1.2.2.css" rel="stylesheet">
    <link href="css/clndr.css" rel="stylesheet">
    <!--clock css-->
    <link href="js/css3clock/css/style.css" rel="stylesheet">
    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="js/morris-chart/morris.css">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet"/>
    <!--external css-->
    <link rel="stylesheet" type="text/css" href="js/gritter/css/jquery.gritter.css" />
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->


</head>
<body>
<script src="/GCSMS/html/Highcharts-6.0.7/highcharts.js"></script>
<script src="/GCSMS/html/Highcharts-6.0.7/data.js"></script>
<script src="/GCSMS/html/Highcharts-6.0.7/drilldown.js"></script>


<?php 
$currentPage ='G&CSMS-Dasboard';
include('header.php');
include('sidebarnav.php');
?>

         
<section id="main-content">
    <section class="wrapper">

        <div class="col-lg-6">
            <div class="mini-stat clearfix tar">
                <span class="mini-stat-icon"  style="background-color: gold;">
                    <i class="fa  fa-calendar"></i>
                </span>
                <div class="mini-stat-info"> 
                    <span class="fontColor">                             
                        <?php
                        /* check connection */
                        if (mysqli_connect_errno()) {
                            printf("Connect failed: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($result = mysqli_query($db, "select ActiveAcadYear_Batch_YEAR from active_academic_year where ActiveAcadYear_IS_ACTIVE = 1 limit 1")) {
                            /* determine number of rows result set */
                            $row = mysqli_fetch_assoc($result);
                            $row_result = $row["ActiveAcadYear_Batch_YEAR"];
                            printf("
                                    <span>%s</span>
                                    </div> ", $row_result); 
                            /* close result set */
                            mysqli_free_result($result);
                        }
                        /* close connection */
                        // mysqli_close($db);
                        ?>                             
                    </span> 
                    <label class="fontColor">Current Academic Year</label> 
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mini-stat clearfix tar">
                <span class="mini-stat-icon"  style="background-color: gold;">
                    <i class="fa  fa-bookmark"></i>
                </span>
                <div class="mini-stat-info"> 
                    <span class="fontColor">                            
                        <?php
                        /* check connection */
                        if (mysqli_connect_errno()) {
                            printf("Connect failed: %s\n", mysqli_connect_error());
                            exit();
                        }
                        if ($result = mysqli_query($db, "select ActiveSemester_SEMESTRAL_NAME from active_semester where ActiveSemester_IS_ACTIVE = 1 limit 1")) {
                            /* determine number of rows result set */
                            $row = mysqli_fetch_assoc($result);
                            $row_result = $row["ActiveSemester_SEMESTRAL_NAME"];
                            printf("
                                    <span>%s</span>
                                    </div> ", $row_result); 
                            /* close result set */
                            mysqli_free_result($result);
                        }
                        /* close connection */
                        // mysqli_close($db);
                        ?>
                        </span> 
                        <label class="fontColor">Current Semester</label> 
                    </div>
            </div>
        </div>

                
        <!--earning graph start-->
            <div class="col-md-3">                
                <?php
                /* check connection */
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                if ($result = mysqli_query($db, "select * from `student_profiling` WHERE STUD_STATUS = 'Regular' or STUD_STATUS = 'Irregular'")) {
                    /* determine number of rows result set */
                    $row_cnt = mysqli_num_rows($result);
                    printf("<section class='panel'> 
                    <div class='panel-body'>
                            <div class='leftMargin'>
                                <span class='mini-stat-icon' style='background-color: #96b60b;'>
                                    <i class='fa fa-smile-o'></i>
                                </span>
                            </div>
                            <div class='mini-stat-info'>
                                <br><br><br><br>
                                <span class='alignment'>%d</span>
                                <br>
                                <p class='alignment'>Students on Record</p>
                            </div>
                        </div>
                    </section>
                ", $row_cnt); 
                    /* close result set */
                    mysqli_free_result($result);
                }
                /* close connection */
                // mysqli_close($db);
                ?>  
            </div>

            <div class="col-md-3">
                <?php
                /* check connection */
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                if ($result = mysqli_query($db, "select * from t_stud_visit")) {
                    /* determine number of rows result set */
                    $row_cnt = mysqli_num_rows($result);
                    printf("
                    <section class='panel'> 
                    <div class='panel-body'>
                            <div class='leftMargin'>
                                <span class='mini-stat-icon orange'>
                                    <i class='fa fa-tags'></i>
                                </span>
                            </div>
                            <div class='mini-stat-info'>
                                <br><br><br><br>
                                <span class='alignment'>%d</span>
                                <br>
                                <p class='alignment'>Number of Visits<p>
                            </div>
                        </div>
                    </section>
                ", $row_cnt); 
                    /* close result set */
                    mysqli_free_result($result);
                }
                /* close connection */
                // mysqli_close($db);
                ?>
            </div>

            <div class="col-md-3">
                <?php
                /* check connection */
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                if ($result = mysqli_query($db, "SELECT * FROM `t_counseling`")) {
                    /* determine number of rows result set */
                    $row_cnt = mysqli_num_rows($result);
                    printf(" 
                    <section class='panel'> 
                    <div class='panel-body' >
                            <div class='leftMargin'>
                                <span class='mini-stat-icon pink'>
                                    <i class='fa fa-user'></i>
                                </span>
                            </div>
                            <div class='mini-stat-info'>
                                <br><br><br><br>
                                <span class='alignment'>%d</span>
                                <br>
                                <p class='alignment'>Individual Counseling</p>
                            </div>
                        </div>
                    </section>
                ", $row_cnt); 
                    /* close result set */
                    mysqli_free_result($result);
                }
                /* close connection */
                // mysqli_close($db);
                ?>
            </div>

            <div class="col-md-3">
                <?php
                /* check connection */
                if (mysqli_connect_errno()) {
                    printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                if ($result = mysqli_query($db, "SELECT * FROM `t_counseling`")) {
                    /* determine number of rows result set */
                    $row_cnt = mysqli_num_rows($result);
                    printf(" 
                    <section class='panel'> 
                    <div class='panel-body' >
                            <div class='leftMargin'>
                                <span class='mini-stat-icon' style='background-color: #eb7bcd;'>
                                    <i class='fa fa-users'></i>
                                </span>
                            </div>
                            <div class='mini-stat-info'>
                                <br><br><br><br>
                                <span class='alignment'>%d</span>
                                <br><p class='alignment'>Group Counseling</p>
                            </div>
                        </div>
                    </section>
                ", $row_cnt); 
                    /* close result set */
                    mysqli_free_result($result);
                }
                /* close connection */
                // mysqli_close($db);
                ?>
            </div>


        <center>
            <div class="col-md-12" >
                <div class="event-calendar clearfix">
                    <div class="col-lg-7 calendar-block">
                        <div class="cal1 ">
                        </div>
                    </div>
                    <div class="col-lg-5 event-list-block">
                        <div class="cal-day">
                            <span>Today</span>
                            <?php echo date('D')?>
                        </div>
                        <ul class="event-list">

                        </ul>
                    </div>
                </div>
            </div>
        </center>
    </section>

<div class="col-md-12">
<section class="panel">

<div class="panel-body">
    <div class="row">
        <div class="col-md-6">
            <div id="case-chart" class="col-md-6">
                <?php
                $qcaseall = "select count(Couns_APPROACH) as Case_all from t_couns_approach;";
                $result = mysqli_query($db, $qcaseall);
                while($row = mysqli_fetch_array($result))
                {
                   $Caseall = $row["Case_all"];
                }
                $qcaseBehavior = "select count(Couns_APPROACH) as Behavior from t_couns_approach where Couns_APPROACH = 'Behavior Theraphy'";
                $result = mysqli_query($db, $qcaseBehavior);
                while($row = mysqli_fetch_array($result))
                {
                   $CaseBehavior = $row["Behavior"];
                }
                $qcaseCognitive = "select count(Couns_APPROACH) as Cognitive from t_couns_approach where Couns_APPROACH = 'Cognitive Theraphy'";
                $result = mysqli_query($db, $qcaseCognitive);
                while($row = mysqli_fetch_array($result))
                {
                   $CaseCognitive = $row["Cognitive"];
                }
                $qcaseEducational = "select count(Couns_APPROACH) as Educational from t_couns_approach where Couns_APPROACH = 'Educational Theraphy'";
                $result = mysqli_query($db, $qcaseEducational);
                while($row = mysqli_fetch_array($result))
                {
                   $CaseEducational = $row["Educational"];
                }
                $qcaseHolistic = "select count(Couns_APPROACH) as Holistic from t_couns_approach where Couns_APPROACH = 'Holistic Theraphy'";
                $result = mysqli_query($db, $qcaseHolistic);
                while($row = mysqli_fetch_array($result))
                {
                   $CaseHolistic = $row["Holistic"];
                }
                $qcaseMentalHealth = "select count(Couns_APPROACH) as Mental_Health_Counseling from t_couns_approach where Couns_APPROACH = 'Mental Health Counseling'";
                $result = mysqli_query($db, $qcaseMentalHealth);
                while($row = mysqli_fetch_array($result))
                {
                   $CaseMentalHealth = $row["Mental_Health_Counseling"];
                }
                ?>
            </div>
            <script type="text/javascript">
                        // Create the chart
            Highcharts.chart('case-chart',{
                chart: {
                    type: 'column',
                    width: 300
                },
                title: {
                    text: 'Counseling Cases'
                },
                subtitle: {
                    text: ''
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Overall case'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>Cases<br/>'
                },
                series: [{
                    name: 'CasePUPQC',
                    colorByPoint: true,
                    data: [{
                        name: 'Cases PUPQC',
                        y: <?php echo  $Caseall ;?>,
                        drilldown: 'PUPQC'
                
                    }]
                }],
                drilldown: {
                    series: [{
                        name: 'PUPQC',
                        id: 'PUPQC',
                        data: [
                            [
                                'Behavior Therapy',
                                <?php echo $CaseBehavior; ?>
                            ],
                            [
                                'Educational Counseling',
                                <?php echo $CaseEducational; ?>
                            ],
                            [
                                'Holistic Therapy',
                                <?php echo $CaseHolistic; ?>
                            ],
                            [
                                'Mental Health Counseling',
                                <?php echo $CaseMentalHealth; ?>
                            ],
                            [
                                'Cognitive Counseling',
                                <?php echo $CaseCognitive; ?>
                            ]
                            
                        ]
                    
                    }]
                }
            });
            </script>
        </div>
    <!--mini statistics end-->
        <div class="col-md-6">
            <div id="case-chart" class="col-md-6" style="padding:0px 70px">
                <?php
                $qvisitall = "select count(Visit_PURPOSE) as visitall from t_stud_visit";
                $result = mysqli_query($db, $qvisitall);
                while($row = mysqli_fetch_array($result))
                {
                   $visitall = $row["visitall"];
                }
                $qvisitCoC = "select count(Visit_PURPOSE) as CoC from t_stud_visit where Visit_PURPOSE = 'CoC'";
                $result = mysqli_query($db, $qvisitCoC);
                while($row = mysqli_fetch_array($result))
                {
                   $visitCoC = $row["CoC"];
                }
                $qvisitExcuse  = "select count(Visit_PURPOSE) as Excuse from t_stud_visit where Visit_PURPOSE = 'Excuse Letter'";
                $result = mysqli_query($db, $qvisitExcuse);
                while($row = mysqli_fetch_array($result))
                {
                   $visitExcuse = $row["Excuse"];
                }
                $qvisitClearance  = "select count(Visit_PURPOSE) as Clearance from t_stud_visit where Visit_PURPOSE = 'Signing of Clearance'";
                $result = mysqli_query($db, $qvisitClearance);
                while($row = mysqli_fetch_array($result))
                {
                   $visitClearance = $row["Clearance"];
                }
                ?>
                <div id="visit-chart"></div>

                <script type="text/javascript">
                    // Create the chart
                    Highcharts.chart('visit-chart',{
                        chart: {
                            type: 'column',
                            width: 300
                        },
                        title: {
                            text: 'Visits'
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Overall case'
                            }
                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y}'
                                }
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b>Cases<br/>'
                        },
                        series: [{
                            name: 'CasePUPQC',
                            colorByPoint: true,
                            data: [{
                                name: 'Total Visits',
                                y: <?php echo  $visitall ;?>,
                                drilldown: 'QCVisits'
                                
                            }]
                        }],
                        drilldown: {
                            series: [{
                                name: 'QCVisits',
                                id: 'QCVisits',
                                data: [
                                    [
                                        'C.O.C',
                                        <?php echo $visitCoC; ?>
                                    ],
                                    [
                                        'Excuse',
                                        <?php echo $visitExcuse; ?>
                                    ],
                                    [
                                        'Clearance',
                                        <?php echo $visitClearance; ?>
                                    ]
                                    
                                    
                                ]
                            
                            }]
                        }
                        
                    });
                </script>
            </div>
        </div>
    </div>
<!--right sidebar end-->
</section>
 

<!-- Placed js at the end of the document so the pages load faster -->
<!--Core js-->
<?php include('footer.php'); ?>

<!--script for this page-->
<!--script for this page-->
<!--Core js-->
<script src="js/jquery.js"></script>


<script>
    $(document).ready(function(){

        function load_unseen_notification(view = '')
        {
            $.ajax({
                url:"NotifLoad.php",
                method:"POST",
                data:{view:view},
                dataType:"json",
                success:function(data)
                {
                    $('.dropdown-menu').html(data.Notification);

                    if(data.NotificationCount > 0)
                    {
                        $('.count').html(data.NotificationCount);
                    }
                }
            });
        }

        load_unseen_notification();

        $(document).on('click','.dropdown-toggle', function(){
        $('.count').html('');
        load_unseen_notification('read');
        });

        setInterval(function(){
            load_unseen_notification();  
        }, 5000);
        
    });

</script>


<!-- <script src="js/jquery-1.8.3.min.js"></script> -->
<!-- <script src="bs3/js/bootstrap.min.js"></script> -->
<script src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!-- Easy Pie Chart -->
<!-- <script src="js/easypiechart/jquery.easypiechart.js"></script>  -->
<!--Sparkline Chart-->
<!-- <script src="js/sparkline/jquery.sparkline.js"></script> -->
<!--jQuery Flot Chart-->
<!-- <script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script> -->
<script src="js/calendar/clndr.js"></script>
<script src="js/calendar/moment-2.2.1.js"></script>
<script src="js/evnt.calendar.init.js"></script>
<!--common script init for all pages-->
<!-- <script src="js/scripts.js"></script> -->
<script src="js/gritter.js" type="text/javascript"></script>

</body>
</html>