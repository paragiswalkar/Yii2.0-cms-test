<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="students-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'firstname',
            'lastname',
            'mobile',
            'email:email',
            'address',
            [
                'attribute'=>'course_id',
                'value'=> $model->course->title,
            ],
            [
                'attribute'=>'subject_id',
                'value'=> $model->subject->name,
            ],
            [
                'attribute'=>'avtar',
                'value'=>'/'.$model->avtar,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            'status',
            'created_at',
        ],
    ]) ?>

</div>
