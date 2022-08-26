<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "subject".
 *
 * @property int $id
 * @property string $name
 * @property int $course_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Course $course
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subject';
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
            [['name', 'course_id'], 'required'],
            [['course_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'course_id' => 'Course ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    public function getSubjectList($sub_id) {
        $subjectlist = self::find()
                        ->select(['id','name'])
                        ->where(['course_id' => $sub_id])
                        ->asArray()
                        ->all();

        return $subjectlist;                
    }
}
