<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%subject}}`.
 */
class m220824_185251_create_subject_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subject}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'course_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk-course-id',
            '{{%subject}}',
            'course_id',
            '{{%course}}',
            'id',
            'CASCADE'
        );

        // creates index for column `author_id`
        $this->createIndex(
            'idx-subject-course_id',
            '{{%subject}}',
            'course_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%subject}}');
    }
}
