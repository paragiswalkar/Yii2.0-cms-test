<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "students".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property int|null $mobile
 * @property string|null $email
 * @property string|null $address
 * @property int $course_id
 * @property string|null $avtar
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $subject_id
 *
 * @property Course $course
 * @property Subject $subject
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'students';
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
            [['firstname', 'lastname', 'course_id', 'subject_id'], 'required'],
            [['mobile', 'course_id', 'status', 'subject_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['firstname', 'lastname', 'email', 'address', 'avtar'], 'string', 'max' => 255],
            [['mobile'], 'unique'],
            [['email'], 'unique'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'First Name',
            'lastname' => 'Last Name',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'address' => 'Address',
            'course_id' => 'Course',
            'avtar' => 'Avtar',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'subject_id' => 'Subject',
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

    /**
     * Gets query for [[Subject]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
}
