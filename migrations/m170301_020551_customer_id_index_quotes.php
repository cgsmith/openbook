<?php

use yii\db\Migration;

class m170301_020551_customer_id_index_quotes extends Migration
{
    public function up()
    {
        $this->createIndex('customer_id_index', 'quotes', 'customer_id');

    }

    public function down()
    {
        $this->dropIndex('customer_id_index', 'quotes');
    }

}
