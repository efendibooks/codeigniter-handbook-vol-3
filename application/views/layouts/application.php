<!doctype html>
<html>
<head>
    <title>CodeIgniter Handbook Vol. 3 Stats Tracker</title>

    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>stylesheets/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>stylesheets/style.css">

    <script type="text/javascript" src="<?= base_url() ?>javascripts/jquery-1.9.1.min.js"></script>
    <script type="text/javascript">
        var TrackerApp = {
            trackersUrl: '<?= site_url('trackers') ?>'
        };

        $(function()
        {
            /**
             * When the user selects from the dropdown list, redirect us to
             * the individual tracker show page
             */
            $('#trackerSelect').change(function()
            {
                if ($(this).val())
                {
                    window.location.href = TrackerApp.trackersUrl + '/show/' + $(this).val();
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <header class="row">
            <div class="span6">
                <h1>Stats Tracker</h1>
            </div>

            <div class="span4 offset2">
                <?= form_dropdown('', 
                                  array('' => 'Select Tracker...') + $dropdown,
                                  (isset($tracker) ? $tracker->id() : ''),
                                  'id="trackerSelect"') ?>

                <span class="addTrackerButton">
                    <a href="<?= site_url('trackers/add') ?>"><img src="<?= base_url() ?>images/add.png" alt="Add Tracker"></a>
                </span>
            </div>
        </header>

        <div class="row">
            <?= $yield ?>
        </div>
    </div>
</body>
</html>