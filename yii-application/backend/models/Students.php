<?php

namespace app\models;

use Yii;

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
 *
 * @property Course $course
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'course_id', 'created_at', 'updated_at'], 'required'],
            [['mobile', 'course_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['firstname', 'lastname', 'email', 'address', 'avtar'], 'string', 'max' => 255],
            [['mobile'], 'unique'],
            [['email'], 'unique'],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'address' => 'Address',
            'course_id' => 'Course ID',
            'avtar' => 'Avtar',
            'status' => 'Status',
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
}
