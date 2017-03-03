<?php
namespace app\components;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

class SublinkWidget extends Widget
{
    public $html;

    public $type;

    public $status;

    public $id;

    public $revision;

    public function init()
    {
        parent::init();
        if ($this->type === 'quote') {
            $this->html = $this->renderQuoteSublink();
        }
    }

    public function run()
    {
        return $this->html;
    }

    protected function renderQuoteSublink()
    {
        if (!$this->status) {
            return ''; // render no buttons if status is false
        }

        $html = '<div class="btn-group">';
        $html .= Html::a(\Yii::t('app','Edit Quote'), Url::toRoute(['quotes/update', 'id' => $this->id]), ['class'=> 'btn btn-default']);
        $html .= $this->beginDropdown();
        $html .= $this->addSublink(Html::a(\Yii::t('app','Edit Current Revision'), Url::toRoute(['quotes/update', 'id' => $this->id, 'revision' => $this->revision])));
        $html .= $this->endDropdown();
        $html .= '</div>';
        $html .= Html::a(\Yii::t('app','Clone'), Url::toRoute(['quotes/clone', 'id' => $this->id]), ['class'=> 'btn btn-default']);
        $html .= Html::a(\Yii::t('app','Email Quote'), Url::toRoute(['quotes/email', 'id' => $this->id]), ['class'=> 'btn btn-default']);

        // Only if Job is not set!
        $html .= '<div class="btn-group">';
        $html .= Html::a(\Yii::t('app','Convert to Job'), Url::toRoute(['quotes/convert-to-job', 'id' => $this->id]), ['class'=> 'btn btn-default']);
        $html .= $this->beginDropdown();
        $html .= $this->addSublink(Html::a(\Yii::t('app','Add to Pending'), Url::toRoute(['quotes/add-to-pending', 'id' => $this->id])));
        $html .= $this->endDropdown();
        $html .= '</div>';

        $html .= Html::a(\Yii::t('app','Print'), Url::toRoute(['quotes/print', 'id' => $this->id]), ['class'=> 'btn btn-default']);
        $html .= Html::a(\Yii::t('app','Delete'), Url::toRoute(['quotes/delete', 'id' => $this->id]), [
            'class'=> 'btn btn-danger',
            'data' => [
                'confirm' => \Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ]]);
        $html .= '</div>';

        return $html;
    }

    /**
     * Returns string to add the down arrow caret for a button group
     *
     * @return string
     */
    private function beginDropdown()
    {
        return '<button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"></span>
                </button>
                <ul class="dropdown-menu">';
    }

    private function addSublink($html)
    {
        return '<li>'.$html.'</li>';
    }

    private function endDropdown()
    {
        return '</ul>';
    }
}
/**

<?= Html::submitButton(Yii::t('app', 'Print'), ['class' => 'btn btn-default']);?>
<?= Html::submitButton(Yii::t('app', 'Delete'), ['class' => 'btn btn-danger']);?>
<?php } ?>
/**
* <?php
if (!$quote->isNewRecord) { ?>
    <div class="btn-group">
        <button type="button" class="btn btn-default"><?= Yii::t('app','Edit Quote')?></button>
        <button type="button" class="btn  btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#"><?= Yii::t('app','Edit Current Revision')?></a></li>
        </ul>
    </div>
    <?= Html::submitButton(Yii::t('app', 'Clone'), ['class' => 'btn btn-default']);?>
    <?= Html::submitButton(Yii::t('app', 'Email Quote'), ['class' => 'btn btn-default']);?>
    <div class="btn-group">
        <button type="button" class="btn btn-default"><?= Yii::t('app','Convert to Job')?></button>
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="caret"></span>
            <span class="sr-only"></span>
        </button>
        <ul class="dropdown-menu">
            <li><a href="#"><?= Yii::t('app','Add to Pending')?></a></li>
        </ul>
    </div>
    <?= Html::submitButton(Yii::t('app', 'Print'), ['class' => 'btn btn-default']);?>
    <?= Html::submitButton(Yii::t('app', 'Delete'), ['class' => 'btn btn-danger']);?>
<?php } ?>
*/