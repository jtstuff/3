<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210323_055646_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'date_create' => $this->date()->notNull(),
            'date_update' => $this->date()->notNull(),
            'status' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'short_content' => $this->text()->notNull(),
            'rating' => $this->integer()->notNull(),
        ]);

        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'id_parent' => $this->integer()->notNull(),
            'slug' => $this->string()->notNull(),
            'status' => $this->string()->notNull(),
             ]);

             $this->createTable('{{%tag}}', [
                'id' => $this->primaryKey(),
                'title' => $this->string()->notNull(),
                'slug' => $this->string()->notNull(),
                 ]);

                 $this->createTable('{{%tag_assign}}', [
                    'id' => $this->primaryKey(),
                    'tag_id' => $this->string()->notNull(),
                    'article_id' => $this->string()->notNull(),
                     ]);

                     
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%category}}');
        $this->dropTable('{{%tag}}');
        $this->dropTable('{{%tag_assign}}');
        
    }
}
