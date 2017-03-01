<?php

use yii\db\Migration;

class m170301_020600_status_index_jobs extends Migration
{
    public function up()
    {
        $this->createIndex('status_index', 'jobs', 'status');
    }

    public function down()
    {
        $this->dropIndex('status_index', 'jobs');
    }

}
