<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Focus Test</title>
  <?= css([
    'assets/index.css',
    '@auto'
  ]) ?>
</head>
<body>
  <h1>Focus Tests</h1>
  <div class="file">
    <div class="original">
      <dl class="info">
        <dt>Kirby</dt>
        <dd><?= Kirby::version() ?></dd>
        <dt>Focus</dt>
        <dd><?= \Flokosiol\Focus::version() ?></dd>
      </dl>
    </div>
  </div>
  <?php foreach ($page->images()->sortBy('sort','asc') as $image): ?>
    <div class="file">
      <div class="original">
        <h2>Original</h2>
        <div class="focus-wrapper">
          <?= $image ?>
          <div class="focus" style="left: <?= $image->focusPercentageX() ?>%; top: <?= $image->focusPercentageY() ?>%"></div>
        </div>
        <dl class="info">
          <dt>Extension</dt>
          <dd><?= $image->extension() ?></dd>
          <dt>Percentage X</dt>
          <dd><?= $image->focusPercentageX() ?></dd>
          <dt>Percentage Y</dt>
          <dd><?= $image->focusPercentageY() ?></dd>
          <dt>X</dt>
          <dd><?= $image->focusX() ?></dd>
          <dt>Y</dt>
          <dd><?= $image->focusY() ?></dd>
        </dl>
      </div>
      <div class="crops">
        <h2>Crops</h2>
        <?= $image->focusCrop(200,200) ?>
        <?= $image->focusCrop(300,200) ?>
        <?= $image->focusCrop(100,200) ?>

        <?php
          $mods = [
            'format' => 'webp',
            'grayscale' => 'true',
            'blur' => '50',
          ];
        ?>
        <?php foreach ($mods as $option => $value): ?>
          <div class="mod">
            <?php $img = $image->focusCrop(200,200,[$option => $value]) ?>
            <?= $img ?>
            <dl class="info">
              <dt><?= ucfirst($option) ?></dt>
              <dd><?= $value ?></dd>
              <dt>Path</dt>
              <dd><?= $img->url() ?></dd>
            </dl>
          </div>
        <?php endforeach ?>

        <div class="mod">
          <img
            src="<?= $image->focusCrop(200, 200)->url() ?>"
            srcset="<?=
              $image->focusSrcset([
                '800w' => [
                  'width' => 800,
                  'height' => 800,
                ],
                '1400w' => [
                  'width' => 1400,
                  'height' => 1400,
                ]
              ]);
            ?>"
            width="200"
            height="200"
          >
          <dl class="info">
            <dt>FocusSrcset</dt>
            <dd>800w / 1400w</dd>
          </dl>
        </div>

      </div>
    </div>
  <?php endforeach ?>
</body>
</html>
