<?php

use yii\db\Migration;

class m170308_051706_add_columns_company extends Migration
{
    public function safeUp()
    {
		$this->addColumn('company','payroll_emails','string');
		$this->addColumn('company','vacation_reminder_emails','string');
		$this->addColumn('company','smtp_user','string');
		$this->addColumn('company','smtp_password','string');
		$this->addColumn('company','smtp_from','string');
		$this->addColumn('company','smtp_bcc','string');
		$this->addColumn('company','smtp_port','string');
		$this->addColumn('company','smtp_server','string');
		$this->addColumn('company','smtp_testing','int');
    }

    public function safeDown()
    {
        $this->dropColumn('company','payroll_emails');
        $this->dropColumn('company','vacation_reminder_emails');
        $this->dropColumn('company','smtp_user');
        $this->dropColumn('company','smtp_password');
        $this->dropColumn('company','smtp_from');
        $this->dropColumn('company','smtp_bcc');
        $this->dropColumn('company','smtp_port');
        $this->dropColumn('company','smtp_server');
        $this->dropColumn('company','smtp_testing');
    }
}
