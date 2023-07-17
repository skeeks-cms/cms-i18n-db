<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 28.08.2015
 */

use yii\db\Migration;

class m230701_093837_alter_table__source_message extends Migration
{
    public function safeUp()
    {
        $tableName = "source_message";
        $this->execute("ALTER TABLE `source_message` CHANGE `message` `message` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");
    }

    public function safeDown()
    {
        echo "m200717_132301__alter_table__shop_site cannot be reverted.\n";
        return false;
    }
}