<table class="table table-bordered table-striped">
    <thead>
        <tr><th>Value</th><th>When</th></tr>
    </thead>

    <tbody>
        <?php foreach($data as $value): ?>
            <tr><td><?= $value[1] ?></td><td><?= $value[0] ?></td></tr>
        <?php endforeach; ?>
    </tbody>
</table>