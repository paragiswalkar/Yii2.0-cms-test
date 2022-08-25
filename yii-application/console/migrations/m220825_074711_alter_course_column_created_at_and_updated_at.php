<?php

use yii\db\Migration;

/**
 * Class m220825_074711_alter_course_column_created_at_and_updated_at
 */
class m220825_074711_alter_course_column_created_at_and_updated_at extends Migration
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

        $this->alterColumn('{{%course}}', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('{{%course}}', 'updated_at', $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220825_074711_alter_course_column_created_at_and_updated_at cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220825_074711_alter_course_column_created_at_and_updated_at cannot be reverted.\n";

        return false;
    }
    */
}
