<?php $this->pageTitle = Yii::app()->name; ?>
<div class="row-fluid" id="home-main">
    <div class="span8">
        <div class="hero-unit" id="person-profile">
            <h1>
                <?= $person->name ?> <span class="small"><i>(<?= $person->age ?>, <?= $person->genderText ?>)</i></small>
                    <div class="shr_classic shareaholic-show-on-load" style="float:right;"></div>
            </h1>
            <h2><?= $person->house?> - <i>
                <?= $person->nature ?>
                <? if($person->constituency != ''): ?>
                    from 
                    <a href="<?=  $this->createAbsoluteUrl('site/search', array('q' => $person->constituency)) ?>">
                        <?= $person->constituency ?>
                    </a>
                <? endif; ?>
            </i></h2>
            <br />
            <div class="profile-section">
                <div class="profile-section-title">
                    Education
                </div>
                <div class="profile-section-content">
                    <a href="<?=  $this->createAbsoluteUrl('site/search', array('q' => $person->education)) ?>"><?= $person->education ?></a>, 
                    <?= $person->educationDetails ?>
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-section-title">
                    Political Details
                </div>
                <div class="profile-section-content">
                    <b>Party</b>:
                    <a href="<?=  $this->createAbsoluteUrl('site/search', array('q' => $person->party)) ?>">
                        <?= $person->party ?>
                    </a><br />
                    <b>State</b>:
                    <a href="<?=  $this->createAbsoluteUrl('site/search', array('q' => $person->state)) ?>">
                        <?= $person->state ?>
                    </a><br />
                    <b>Term</b>: <?= $person->termStart ?> - <?= $person->termEnd ?><br />
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-section-title">
                    Statistics
                </div>
                <div class="profile-section-content">
                    <b>Bills</b>: <?= $person->bills ?><br />
                    <b>Debates</b>: <?= $person->debates ?><br />
                    <b>Questions</b>: <?= $person->questions ?><br />
                    <b>Attendance</b>: <?= $person->attendance ?>%<br />
                </div>
            </div>

            <div class="profile-section">
                <div class="profile-section-title">
                    Notes
                </div>
                <div class="profile-section-content">
                    <?= $person->notes ?>
                </div>
            </div>
            <div class="profile-section">
                <div class="profile-section-title">
                    Related links
                </div>
                <div class="profile-section-content">
                    <a href="<?= $person->PRSLink ?>" target="_blank">PRS INDIA</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Shareaholic Classic Bookmarks HTML -->
<!-- Start Shareaholic Classic Bookmarks settings -->
<script type="text/javascript">
var SHRCB_Settings = {"shr_classic":{"size":16,"link":"","service":"5,7,313,309,78,304,88","apikey":"2fc518bd8c0bb3cf45bdade11877971c1","shortener":"bitly","shortener_key":"","designer_toolTips":true,"twitter_template":"${title} - ${short_link} via @Shareaholic"}};
var SHRCB_Globals = {"perfoption":"1"};
</script>
<!-- End Shareaholic Classic Bookmarks settings -->
<!-- Start Shareaholic Classic Bookmarks script -->
<script type="text/javascript">
(function() {
var sb = document.createElement("script"); sb.type = "text/javascript";sb.async = true;
sb.src = ("https:" == document.location.protocol ? "https://dtym7iokkjlif.cloudfront.net" : "http://cdn.shareaholic.com") + "/media/js/jquery.shareaholic-publishers-cb.min.js";
var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(sb, s);
})();
</script>
<!-- End Shareaholic Classic Bookmarks script -->
