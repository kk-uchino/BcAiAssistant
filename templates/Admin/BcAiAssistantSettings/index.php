<?php
$this->BcAdmin->setTitle('設定');
?>

<?= $this->BcAdminForm->create($setting, ['novalidate' => true]) ?>

<div class="section">
  <table class="bca-form-table">
    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('openai_api_key', 'OpenAI API Key') ?>
        <span class="bca-label" data-bca-label-type="required"><?= __d('baser_core', '必須') ?></span>
      </th>
      <td class="bca-form-table__input">
        <?= $this->BcAdminForm->control('openai_api_key', ['type' => 'text', 'size' => 60, 'maxlength' => 255]) ?>
        <?= $this->BcAdminForm->error('openai_api_key') ?>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('site_tokens_limit', '1ヶ間のトークン制限 サイト全体') ?>
      </th>
      <td class="bca-form-table__input">
        <?= $this->BcAdminForm->control('site_tokens_limit', ['type' => 'number', 'size' => 20, 'maxlength' => 255]) ?>
        <?= $this->BcAdminForm->error('site_tokens_limit') ?>
        <div>
          <small>未入力の場合は制限しない</small>
        </div>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('user_tokens_limit', ' 1ヶ月間のトークン制限 ユーザー別') ?>
      </th>
      <td class="bca-form-table__input">
        <?= $this->BcAdminForm->control('user_tokens_limit', ['type' => 'number', 'size' => 20, 'maxlength' => 255]) ?>
        <?= $this->BcAdminForm->error('user_tokens_limit') ?>
        <div>
          <small>未入力の場合は制限しない</small>
        </div>
      </td>
    </tr>
    <tr>
      <th class="bca-form-table__label">
        <?= $this->BcAdminForm->label('generate_body_instructions', '本文生成 指示') ?>
      </th>
      <td class="bca-form-table__input">
        <?= $this->BcAdminForm->control('generate_body_instructions', ['type' => 'textarea', 'cols' => 60, 'rows' => 12]) ?>
        <?= $this->BcAdminForm->error('generate_body_instructions') ?>
        <div>
          <small>ユーザーが入力したプロンプトよりも優先したい指示を設定できます。</small>
        </div>
      </td>
    </tr>
  </table>
</div>

<div class="bca-actions">
  <div class="bca-actions__main">
    <?= $this->BcAdminForm->button(
      __d('baser_core', '保存'),
      [
        'div' => false,
        'class' => 'bca-btn',
        'data-bca-btn-type' => 'save',
        'data-bca-btn-size' => 'lg',
        'data-bca-btn-width' => 'lg',
      ]
    ) ?>
  </div>
</div>

<?= $this->BcAdminForm->end() ?>