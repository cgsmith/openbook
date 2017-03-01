<?php

use yii\db\Migration;

class m170301_020611_job_id_index_quotepricing extends Migration
{
    public function up()
    {
        $this->createIndex('job_id_index', 'quotepricing', 'job_id');
    }

    public function down()
    {
        $this->dropIndex('job_id_index', 'quotepricing');
    }

}
