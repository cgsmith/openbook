<?php

use yii\db\Migration;

class m170301_020618_job_id_index_timecards extends Migration
{
    public function up()
    {
        $this->createIndex('job_id_index', 'timecards', 'job_id');
    }

    public function down()
    {
        $this->dropIndex('job_id_index', 'timecards');
    }

}
