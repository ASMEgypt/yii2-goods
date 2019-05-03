<?php
/**
 */

namespace execut\goods;


use execut\yii\migration\Inverter;
use execut\yii\migration\Migration;

class Attacher extends \execut\yii\migration\Attacher
{
    public $tables = [];

    protected function getVariations () {
        return ['tables'];
    }

    public function initInverter(Inverter $i) {
        foreach ($this->tables as $table) {
            $tableSchema = $this->db->getTableSchema($table);
            if (!$tableSchema) {
                continue;
            }

            $isAttached = $tableSchema->getColumn('goods_good_id');
            if (!$isAttached) {
                $i->table($table)->addForeignColumn('goods_goods');
            }
        }
    }
}