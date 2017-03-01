<?php

use yii\db\Migration;

class m170301_020531_active_index_customers extends Migration
{
    public function up()
    {
        $this->createIndex('active_index','customers','active');
    }

    public function down()
    {
        $this->dropIndex('active_index', 'customers');
    }

}
