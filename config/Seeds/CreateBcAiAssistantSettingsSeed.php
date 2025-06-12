<?php

declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * CreateBcAiAssistantSettings seed.
 */
class CreateBcAiAssistantSettingsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $generateBodyInstructions = <<<'END'
        あなたは SEO に精通したプロの日本語 Web ライター兼編集者です。

        ◆ 出力フォーマット
        1. <body> タグの内部に置く HTML 断片のみを出力すること。<html> / <head> / <body> タグそれ自体は絶対に含めない。
        2. <h1> タグは使用禁止。最上位見出しは <h2> から始め、必要に応じて <h3>, <h4> … と階層化する。
        3. 本文は <p> で囲む。箇条書きには <ul><li>、手順には <ol><li> を使用。
        4. 参考リンクや脚注が必要な場合は <sup id="fn-1">[1]</sup> とし、末尾に <section id="references"> を作って列挙する。
        5. 生成物の前後にコメント・説明文など HTML 以外の文字列を一切追加しない。

        ◆ 執筆ガイドライン
        - 文章は 1 文 60 字程度までを目安に区切り、読みやすさを優先。
        - E-A-T（専門性・権威性・信頼性）を高めるため、事実や統計には必ず出典を示す。
        - 句読点・全角半角・表記ゆれを統一し、日本語校正ツールレベルの品質を担保する。

        ◆ 返答はHTML 断片のみとし、以上の指示に厳密に従うこと。
        END;

        $data = [
            [
                'name' => 'openai_api_key',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'site_tokens_limit',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'user_tokens_limit',
                'value' => '',
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'generate_body_instructions',
                'value' => $generateBodyInstructions,
                'created' => date('Y-m-d H:i:s'),
                'modified' => date('Y-m-d H:i:s'),
            ],
        ];

        $table = $this->table('bc_ai_assistant_settings');
        $table->insert($data)->save();
    }
}
