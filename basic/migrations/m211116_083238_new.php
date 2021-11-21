<?php

use yii\db\Migration;

/**
 * Class m211116_083238_new
 */
class m211116_083238_new extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%subcategory}}', [
            'id' => $this->primaryKey(),
            'subcategory_id' => $this->date()->notNull(),
            'category_id' => $this->date()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
               
        $this->dropTable('{{%subcategory}}');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211116_083238_new cannot be reverted.\n";

        return false;
    }
    */
}
