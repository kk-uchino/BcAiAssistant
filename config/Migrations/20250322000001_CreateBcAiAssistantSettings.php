<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBcAiAssistantSettings extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('bc_ai_assistant_settings');
        $table
            ->addColumn('name', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => false,
            ])
            ->addColumn('value', 'text', [
                'default' => null,
                'null' => false,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('modified', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->addIndex('name', ['unique' => true])
            ->create();
    }
}
