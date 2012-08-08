<?php $this->pageTitle = Yii::app()->name; ?>
<div class="row-fluid" id="home-main">
    <div class="span8">
        <div class="hero-unit">
            <h1>Find YOUR MP!</h1><br />
            <h2>Search by name, state, party or education:</h2><br />
            <form action="<?=  $this->createAbsoluteUrl('site/search') ?>" id="search-form">
                <p>
                    <?php $this->widget('CAutoComplete', array(
                            'name'=>'q',
                            'id'=>'input-box',
                            'attribute'=>'search',
                            'url'=> $this->createAbsoluteUrl('site/suggestions'),
                            'value'=>'Type something...',
                            'minChars'=>2,
                            'scroll'=>false,
                            'resultsClass'=>'searchAutoComplete ac_results',
                            'htmlOptions'=> array('class'=>"input-xxlarge searchClickClear"),
                            'methodChain'=>'.result(function(){$("form#search-form").submit();})'
                    )); ?>
                </p>
                <p><input type="submit" class="btn btn-large btn-inverse" value="Find!"></p>
            </form>
        </div>
    </div>
</div>