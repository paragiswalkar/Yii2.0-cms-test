<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $title
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Subject[] $subjects
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    public function behaviors() {
        parent::behaviors();

        return [
          'timestamp' => [
            'class' => TimestampBehavior::className(),
            'attributes' => [
                \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at']
            ],
            'value' => date('Y-m-d H:i:s'),
          ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','status'], 'required'],
            [['status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Subjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubjects()
    {
        return $this->hasMany(Subject::className(), ['course_id' => 'id']);
    }
}
