<?= $this->BcAdminForm->create(null, ['type' => 'get', 'url' => ['action' => 'index'], 'novalidate' => true]) ?>
<p class="bca-search__input-list">
  <span class="bca-search__input-item">
    <?= $this->BcAdminForm->label('user_id', 'ユーザー', ['class' => 'bca-search__input-item-label']) ?>
    <?= $this->BcAdminForm->control('user_id', ['type' => 'select', 'options' => $userList, 'empty' => '指定なし']) ?>
  </span>
  <span class="bca-search__input-item">
    <?= $this->BcAdminForm->label('created_start', '生成日', ['class' => 'bca-search__input-item-label']) ?>
    <?= $this->BcAdminForm->control('created_start', ['type' => 'datePicker']) ?>
    <span class="bca-datetimepicker__delimiter">～</span>
    <?= $this->BcAdminForm->control('created_end', ['type' => 'datePicker']) ?>
  </span>
</p>
<div class="button bca-search__btns">
  <div class="bca-search__btns-item">
    <?= $this->BcAdminForm->button(__d('baser_core', '検索'), ['id' => 'BtnSearchSubmit', 'class' => 'bca-btn bca-loading', 'data-bca-btn-type' => 'search']) ?>
  </div>
  <div class="bca-search__btns-item">
    <?= $this->BcAdminForm->button(__d('baser_core', 'クリア'), ['id' => 'BtnSearchClear', 'class' => 'bca-btn', 'data-bca-btn-type' => 'clear']) ?>
  </div>
</div>
<?= $this->Form->end() ?>
