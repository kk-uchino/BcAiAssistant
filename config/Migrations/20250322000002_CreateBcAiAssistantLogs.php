<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateBcAiAssistantLogs extends AbstractMigration
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
        $table = $this->table('bc_ai_assistant_logs');
        $table
            ->addColumn('user_id', 'integer', [
                'limit' => 11,
                'default' => null,
                'null' => false,
            ])
            ->addColumn('response_id', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => true,
            ])
            ->addColumn('previous_response_id', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => true,
            ])
            ->addColumn('model', 'string', [
                'limit' => 255,
                'default' => null,
                'null' => true,
            ])
            ->addColumn('request', 'text', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('response', 'text', [
                'default' => null,
                'null' => true,
            ])
            ->addColumn('input_tokens', 'integer', [
                'limit' => 11,
                'default' => null,
                'null' => true,
            ])
            ->addColumn('output_tokens', 'integer', [
                'limit' => 11,
                'default' => null,
                'null' => true,
            ])
            ->addColumn('total_tokens', 'integer', [
                'limit' => 11,
                'default' => null,
                'null' => true,
            ])
            ->addColumn('created', 'datetime', [
                'default' => null,
                'null' => true,
            ])
            ->create();
    }
}
