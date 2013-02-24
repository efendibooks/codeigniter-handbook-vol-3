<div id="chart"></div>

<table class="table table-bordered table-striped">
    <thead>
        <tr><th>IP Address</th><th>When</th></tr>
    </thead>

    <tbody>
        <?php foreach($data as $value): ?>
            <tr><td><?= $value[1] ?></td><td><?= $value[0] ?></td></tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load('visualization', '1.0', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);

    function drawChart()
    {
        var data = new google.visualization.arrayToDataTable([
            <?= $tracker->dataTableHeader() ?>
            <?= $tracker->dataTableData() ?>
        ]);

        // Set chart options
        var options = {
            'width':940,
            'height':280,
            'chartArea':{ 'left':20, 'width':920 }
        };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart'));
        chart.draw(data, options);
    }
</script>