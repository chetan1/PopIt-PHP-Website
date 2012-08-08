<?php $this->pageTitle = Yii::app()->name; ?>
<div class="row-fluid" id="home-main">
    <div class="span10">
        <div class="hero-unit">
            <h2>You searched for "<?= $query ?>"</h2><br />
            <div id="search-results">
                <?php foreach($result as $r): ?>
                    <li>
                        <a href="<?= $this->createAbsoluteUrl('site/person', array('id' => $r['_id'], 'name' => $r['name'])) ?>">
                            <?= $r['name'] ?>
                        </a>
                    </li>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>