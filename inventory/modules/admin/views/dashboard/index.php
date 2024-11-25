<?php
$this->title = 'Inventory Management Dashboard';
?>
<!-- Dashboard Tiles -->
<div class="row mb10">
    <div class="col-sm-6 col-md-3">
        <div class="panel bg-alert light of-h mb10">
            <div class="pn pl20 p5">
                <div class="icon-bg">
                    <i class="fa fa-comments-o"></i>
                </div>
                <h2 class="mt15 lh15">
                    <b><?=$productsCount?></b>
                </h2>
                <h5 class="text-muted">Total Numbers of Products</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="panel bg-info light of-h mb10">
            <div class="pn pl20 p5">
                <div class="icon-bg">
                    <i class="fa fa-twitter"></i>
                </div>
                <h2 class="mt15 lh15">
                    <b>$<?=$averageItemPrice?></b>
                </h2>
                <h5 class="text-muted">Average item price</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="panel bg-danger light of-h mb10">
            <div class="pn pl20 p5">
                <div class="icon-bg">
                    <i class="fa fa-bar-chart-o"></i>
                </div>
                <h2 class="mt15 lh15">
                    <b><?=$usersCount?></b>
                </h2>
                <h5 class="text-muted">Regular Users count</h5>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-3">
        <div class="panel bg-warning light of-h mb10">
            <div class="pn pl20 p5">
                <div class="icon-bg">
                    <i class="fa fa-envelope"></i>
                </div>
                <h2 class="mt15 lh15">
                    <b><?=$typesCount?></b>
                </h2>
                <h5 class="text-muted">Inventory Types Count</h5>
            </div>
        </div>
    </div>
</div>

<!-- Admin-panels -->
<div class="admin-panels fade-onload">
    <div class="row">
        <!-- Three Pane Widget -->
        <div class="col-md-12 admin-grid">
            <!-- Pie Chart -->
            <div class="panel" id="p10">
                <div class="panel-heading">
                    <span class="panel-title">Types Chart</span>
                </div>
                <div class="panel-body pn">
                    <div id="high-pie"></div>
                </div>
            </div>

        </div>
        <!-- end: .col-md-12.admin-grid -->
    </div>
</div>
<?php
$this->registerJsFile(
    '@web/js/plugins/highcharts/highcharts.js',
    ['depends' => [\app\assets\AdminAsset::class]]
);

$this->registerJs("
$('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');
// Define chart color patterns
var highColors = [bgWarning, bgPrimary, bgInfo, bgAlert,
    bgDanger, bgSuccess, bgSystem, bgDark
];
$('#high-pie').highcharts({
                        credits: false,
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: null
                        },
                        tooltip: {
                            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                center: ['30%', '50%'],
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: false
                                },
                                showInLegend: true
                            }
                        },
                        colors: highColors,
                        legend: {
                            x: 90,
                            floating: true,
                            verticalAlign: \"middle\",
                            layout: \"vertical\",
                            itemMarginTop: 10
                        },
                        series: [{
                            type: 'pie',
                            name: 'Browser share',
                            data: [".$typesPercentage."]
                        }]
                    });"
);
?>