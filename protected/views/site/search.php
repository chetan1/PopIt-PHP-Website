<?php $this->pageTitle = Yii::app()->name; ?>
<div class="row-fluid" id="home-main">
    <div class="span10">
        <div class="hero-unit">
            <h2>You searched for "<?= $query ?>"</h2><br />
            <div id="search-results">
                <? if(count($result) > 0): ?>
                    <?php foreach($result as $r): ?>
                        <li>
                            <a href="<?= $this->createAbsoluteUrl('site/person', array('id' => $r['_id'], 'name' => $r['name'])) ?>">
                                <?= $r['name'] ?>
                            </a>
                        </li>
                    <? endforeach; ?>
                <? else: ?>
                    <h3>No results for your search.</h3>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>