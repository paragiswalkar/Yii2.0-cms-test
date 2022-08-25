<?php

use yii\db\Migration;

/**
 * Class m220825_112635_add_column_subject_id_in_students_table
 */
class m220825_112635_add_column_subject_id_in_students_table extends Migration
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

        $this->addColumn('{{%students}}', 'subject_id', $this->integer()->notnull());

        $this->addForeignKey(
            'fk-student-subject-id',
            '{{%students}}',
            'subject_id',
            '{{%subject}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%students}}', 'subject_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220825_112635_add_column_subject_id_in_students_table cannot be reverted.\n";

        return false;
    }
    */
}
