<?php

use yii\db\Migration;

/**
 * Class m220825_053115_create_table_students
 */
class m220825_053115_create_table_students extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%students}}', [
            'id' => $this->primaryKey(),
            'firstname' => $this->string()->notnull(),
            'lastname' => $this->string()->notnull(),
            'mobile' => $this->bigInteger()->null()->unique(),
            'email' => $this->string()->null()->unique(),
            'address' => $this->string()->null(),
            'course_id' => $this->integer()->notnull(),
            'avtar' => $this->string()->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-student-course-id',
            '{{%students}}',
            'course_id',
            '{{%course}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%students}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220825_053115_create_table_students cannot be reverted.\n";

        return false;
    }
    */
}
