<?php
use Kirby\Toolkit\Str;

$orderPage = new OrderPage([
  'slug' => Str::random(16),
  'template' => 'order',
]);
?>
<?php if ($field = $orderPage->blueprint()->fields()[$fieldId] ?? false):
  $required = isset($field['required']);
  $class = isset($class) ? $class : '';
  $class .= $required ? ' is-required' : '';
?>
<p class="field <?= $class ?>">
    <label for="<?= strtolower($fieldId) ?>">
        <?= $label ?? $field['label'] ?>
    </label>
    <?php if ($field['type'] == "select"): ?>
        <select name="<?= strtolower($fieldId) ?>" id="<?= strtolower($fieldId) ?>">
            <?php foreach ($field['options'] as $key=>$option): ?>
            <option value="<?= $key ?>" <?php if ($key== $field['default']): ?> selected<?php endif; ?>><?= $option ?></option>
            <?php endforeach; ?>
        </select>
    <?php else: ?>
        <input type="<?= $field['type'] ?>" name="<?= strtolower($fieldId) ?>" id="<?= strtolower($fieldId) ?>" <?= $required ? 'required' : '' ?> <?= isset($autocomplete) ? 'autocomplete="'.$autocomplete.'"' : '' ?>>
    <?php endif; ?>
    <?php if(isset($help)): ?>
        <small><?= $help ?></small>
    <?php endif; ?>
</p>
<?php endif; ?>
