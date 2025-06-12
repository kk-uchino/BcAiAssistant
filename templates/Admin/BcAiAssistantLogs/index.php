<?php
$this->BcAdmin->setTitle('生成ログ一覧');
$this->BcAdmin->setSearch('bc_ai_assistant_logs_index');

$this->BcListTable->setColumnNumber(6);
?>

<div class="section">
  <p>合計トークン：<strong><?= $totalTokens ?></strong></p>
</div>

<div class="bca-data-list__top">
  <div class="bca-data-list__sub">
    <?php $this->BcBaser->element('pagination') ?>
  </div>
</div>

<table class="list-table bca-table-listup" id="ListTable">
  <thead class="bca-table-listup__thead">
    <tr>
      <th class="bca-table-listup__thead-th">No</th>
      <th class="bca-table-listup__thead-th">生成日時</th>
      <th class="bca-table-listup__thead-th">ユーザー名</th>
      <th class="bca-table-listup__thead-th">input_tokens</th>
      <th class="bca-table-listup__thead-th">output_tokens</th>
      <th class="bca-table-listup__thead-th">total_tokens</th>
    </tr>
  </thead>
  <tbody>
    <?php if ($logs->count()): ?>
      <?php foreach ($logs as $log): ?>
        <tr>
          <td class="bca-table-listup__tbody-td"><?= h($log->id) ?></td>
          <td class="bca-table-listup__tbody-td"><?= h($log->created) ?></td>
          <td class="bca-table-listup__tbody-td"><?= h($userList[$log->user->id]) ?></td>
          <td class="bca-table-listup__tbody-td"><?= h($log->input_tokens) ?></td>
          <td class="bca-table-listup__tbody-td"><?= h($log->output_tokens) ?></td>
          <td class="bca-table-listup__tbody-td"><?= h($log->total_tokens) ?></td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="<?= $this->BcListTable->getColumnNumber() ?>">
          <p class="no-data"><?= __d('baser_core', 'データが見つかりませんでした。') ?></p>
        </td>
      </tr>
    <?php endif ?>
  </tbody>
</table>

<div class="bca-data-list__bottom">
  <div class="bca-data-list__sub">
    <?php $this->BcBaser->element('pagination') ?>
    <?php $this->BcBaser->element('list_num') ?>
  </div>
</div>