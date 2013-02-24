<h2 id="trackerName"><?= $tracker->name() ?></h2>

<div class="span12" id="trackerDisplay">
    <?php if(!$tracker->values()): ?>
        <p>There's no data in this tracker. Please use the API to insert some data.</p>
    <?php else: ?>
        <?= $tracker->display() ?>
    <?php endif; ?>
</div>