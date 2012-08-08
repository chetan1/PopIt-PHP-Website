<?php $this->pageTitle = Yii::app()->name; ?>
<div class="row-fluid" id="home-main">
    <div class="span10">
        <div class="hero-unit">
            <h2>You searched for "<?= $query ?>"</h2><br />
            <div id="search-results">
                <?php $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$dataProvider,
                        'itemView'=>'_searchListView',
                        'template'=>'{summary}{items}<div class="clear"></div><br />{pager}',
                        'emptyText'=>'<br /><div>No results found.</div>',
                        'ajaxUpdate'=>true,
                )); ?>
            </div>
        </div>
    </div>
</div>