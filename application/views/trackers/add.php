<h2 id="trackerName">Add Tracker</h2>

<div class="span12">
    
    <?= form_open('trackers/add') ?>

        <?php if(isset($validation_errors)): ?>
            <div class="alert alert-error" id="validationErrors"><?= $validation_errors ?></div>
        <?php endif; ?>

        <p>
            <?= form_label('Type', 'tracker[type]') ?>
            <?= form_dropdown('tracker[type]', array(Tracker_model::TABLE => 'Table',
                                                     Tracker_model::VISITS => 'Visits'),
                                               $trackerData['type']) ?>
        </p>

        <p>
            <?= form_label('Display Name', 'tracker[name]') ?>
            <?= form_input('tracker[name]', $trackerData['name']) ?>
        </p>

        <p>
            <?= form_label('ID', 'tracker[id]') ?>
            <?= form_input('tracker[id]', $trackerData['id']) ?>
        </p>

        <p>
            <?= form_submit('', 'Add Tracker', 'class="btn btn-primary"') ?>
        </p>

    <?= form_close() ?>

</div>

<script type="text/javascript">
    $(function()
    {
        $('input[name="tracker[name]"]').keyup(function()
        {
            $('input[name="tracker[id]"]').val(
                $(this).val()
                       .toLowerCase()
                       .replace(/ /g,'-')
                       .replace(/[^\w-]+/g,'')
            );
        });
    });
</script>